<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class LeaderDataTable extends DataTable
{
    use DataTableTrait;
    /**
     * Build DataTable class.
     *
     * @return
     */
    public function dataTable($query)
    {
        return datatables()->eloquent($query)

            ->editColumn('status', function($row) {
                if($row->status == '0')
                        $status = '<span class="badge  badge-danger">De-active</span>';
                    else
                        $status = '<span class="badge  badge-success">Active</span>';

                return $status;
            })

            ->editColumn('action', 'admin.departments.action')
            ->rawColumns(['action','user.name','status']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return Builder|\Illuminate\Database\Query\Builder|Collection
     */
    public function query()
    {
        $data = Department::query()->with('user');
        return $this->applyScopes($data);
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
            'department_name',
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
        return 'Department-' . time();
    }
}
