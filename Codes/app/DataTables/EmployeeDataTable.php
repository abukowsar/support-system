<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
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
            ->editColumn('department_id',function ($query){
                return $query->department->department_name;
            })
            ->editColumn('action', 'company.employees.action')
            ->rawColumns(['action']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return Builder|\Illuminate\Database\Query\Builder|Collection
     */
    public function query()
    {
        $data = Employee::query()->with('department');
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
            'name',
            'department_id',
            'email',
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User-' . time();
    }
}
