<?php
namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Faq;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class FaqDataTable extends DataTable
{   
    use DataTableTrait;
    public function dataTable()
    {
        return datatables($this->query())

                ->editColumn('status', function($row) {
                    if($row->status == '0')
                        $status = '<span class="badge  badge-danger">De-active</span>';
                        else
                            $status = '<span class="badge  badge-success">Active</span>';

                    return $status;
                })
                
                ->addColumn('action', 'admin.faq.datatables-actions')

            ->rawColumns([ 'status', 'action']); 
    }

    public function query()
    {
   
        return $this->applyScopes(Faq::query());
    }

    public function html()
    {
        return $this->builder()
                    ->columns([
                        'id'              =>  [ 'title' => 'Id'],
                        'question'        =>  [ 'title' => 'Question'],
                        'status'          =>  [ 'title' => 'Status'],
                    ])
                    ->ajax('')
                    ->addAction(['title' => 'Actions','width' => '100px', 'printable' => false])
                    ->parameters($this->getBuilderParameters());
    }

    protected function filename()
    {
        return 'Faqs' . time();
    }
}
