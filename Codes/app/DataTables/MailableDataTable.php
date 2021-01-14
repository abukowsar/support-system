<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\MailMailable;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class MailableDataTable extends DataTable
{
    use DataTableTrait;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($this->query())
            ->editColumn('label',function ($row){
                return '<a href="'.route('mail.mailable.edit',$row->id).'">'.$row->defaultMailTemplateMap->subject.'</a>';
            })
            ->editColumn('type',function ($query){
                return $query->staticData->label ?? '';
            })
            ->editColumn('status',function ($query){
                return defaultStatus($query->status);
            })
            ->addColumn('action', 'admin.mail.mailable.datatable_action')

            ->rawColumns(['label','status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $mail = MailMailable::query()->with('defaultMailTemplateMap');
        return $this->applyScopes($mail);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'label',
            'type',
            'status'
        ];
    }

 

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Mailable_' . date('YmdHis');
    }
}
