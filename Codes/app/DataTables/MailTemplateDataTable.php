<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\MailMailable;
use App\MailTemplate;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class MailTemplateDataTable extends DataTable
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
        return datatables()->eloquent($query)
            ->editColumn('label',function ($query){
                return '<a href="'.route('mail.template.edit',$query->id).'">'.$query->label.'</a>';
            })
            ->editColumn('status',function ($query){
                return defaultStatus($query->status);
            })
            ->addColumn('action', 'admin.mail.template.datatable_action')
            ->rawColumns(['action','label','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $mail = MailTemplate::query();
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
        return 'MailTemplate_' . date('YmdHis');
    }
}
