<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Pages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class PagesDataTable extends DataTable
{   
    use DataTableTrait;

    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return datatables($this->query())
                    ->editColumn('status', function ($row) {
                        $status='<label class="badge badge-success">Active</label> ';
                        if($row->status=='0')
                        {
                            $status='<label class="badge badge-danger">De-active</label> ';
                        }
                        return $status;
                    })
                    ->addColumn('action', 'admin.pages.datatables-actions')
                    ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
   public function query()
    {
   
        return $this->applyScopes(Pages::query());
    }

    public function html()
    {
        return $this->builder()
                    ->columns([
                        'id'              =>  [ 'title' => 'Id'],
                        'page_title'      =>  [ 'title' => 'Page'],
                        'status'          =>  [ 'title' => 'Status'],
                    ])
                    ->ajax('')
                    ->addAction(['title' => 'Actions','width' => '100px', 'printable' => false])
                    ->parameters($this->getBuilderParameters());
    }

    protected function filename()
    {
        return 'pages' . time();
    }
}
