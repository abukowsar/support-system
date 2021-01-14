<?php
namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Knowledge;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class KnowledgeDataTable extends DataTable
{
    use DataTableTrait;

    public function dataTable()
    {
        return datatables($this->query())

            ->editColumn('status', function($row) {
                if($row->status == '0')
                    $status = '<span class="badge  badge-danger">'._t(__('message.deactive')).'</span>';
                    else
                        $status = '<span class="badge  badge-success">'._t(__('message.active')).'</span>';

                return $status;
            })
            ->editColumn('title',function ($row){
                $title = stringLong($row->title,'title','40');
                return $title;
            })
            ->addColumn('action', 'admin.knowledge.datatables-actions')

            ->rawColumns([ 'status', 'action']);
    }

    public function query()
    {

        return $this->applyScopes(Knowledge::query());
    }

    public function html()
    {
        return $this->builder()
                    ->columns([
                        'id'              =>  [ 'title' => 'Id'],
                        'title'           =>  [ 'title' => 'Title'],
                        'status'          =>  [ 'title' => 'Status'],

                    ])
                    ->ajax('')
                    ->addAction(['title' => 'Actions','width' => '100px', 'printable' => false])
                    ->parameters($this->getBuilderParameters());
    }

    protected function filename()
    {
        return 'knowledge' . time();
    }
}
