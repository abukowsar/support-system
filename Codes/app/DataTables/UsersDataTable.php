<?php

namespace App\DataTables;

use App\Traits\DataTableTrait;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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

            ->editColumn('banned', function($row) {

                if($row->banned == 0)
                        $status = '<a href="javascript:void(0)" class=" ajax-datatable-call cursor" data-href-url="'.route('users.status',['type'=>'banned','id'=>$row->id,'status'=>1]).'"><span class="badge badge-success">'._t(__('message.bane')).'</span></a>';
                    else
                        $status = '<a href="javascript:void(0)" class="ajax-datatable-call cursor" data-href-url="'.route('users.status',['type'=>'banned','id'=>$row->id,'status'=>0]).'"><span class="badge badge-danger">'._t(__('message.baned')).'</span></a>';

                return $status;
            })

            ->editColumn('email_verified_at', function($row) {
                if($row->email_verified_at == null)
                    $status = '<span class="badge  badge-warning">Verification Pending</span>';
                    else
                        $status = '<span class="badge  badge-success">Verified</span>';

                return $status;
            })
            
            ->editColumn('action', 'admin.users.action')
            ->rawColumns(['action','banned','email_verified_at']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return Builder|\Illuminate\Database\Query\Builder|Collection
     */
    public function query()
    {
        $data = User::query();
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
            'email',
            'banned'=>['title'=>'Status'],
            'email_verified_at'=>['title'=>'Email Verified'],
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
