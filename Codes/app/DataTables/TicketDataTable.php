<?php

namespace App\DataTables;

use App\Ticket;
use App\Traits\DataTableTrait;
use Yajra\DataTables\Services\DataTable;

class TicketDataTable extends DataTable
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
            ->editColumn('subject', function ($row) {
                $rowLabel = '<span class="badge badge-info">L</span>';

                $newLabel = '';
                $new = false;

                switch ($row->priority) {
                    case 'emergency':
                        $rowLabel = '<span class="badge badge-danger">E</span>';
                        break;
                    case 'high':
                        $rowLabel = '<span class="badge badge-warning">H</span>';
                        break;
                    case 'normal':
                        $rowLabel = '<span class="badge badge-info">N</span>';
                        break;
                }

                if(isset($row->activity)){
                    if ($row->assigned_id == null){
                        if($row->activity->created_at <= $row->updated_at){
                            $new = true;
                        }
                    }

                    if ($row->status == 'open'){
                        if(strtotime($row->activity->created_at) <= strtotime($row->updated_at)){
                            $new = true;
                        }
                    }
                    if ($row->status == 'solved'){
                        if(strtotime($row->activity->created_at) <= strtotime($row->updated_at)){
                            $new = true;
                        }
                    }
                }else{
                    if ($row->status == 'open'){
                        $new = true;
                    }

                    if ($row->status == 'solved'){
                        $new = true;
                    }

                    if ($row->assigned_id == null){
                        $new = true;
                    }
                }

                if ($new){
                    $newLabel = '<label class="badge badge-dark bg-dark text-white mb-0  ml-2"><b>New</b></label>';
                }

                $rowHtml = '<a href="'.route('support.ticket.edit', $row->id).'" class="fs-15">'.
                    $rowLabel.' <b>#'.$row->id.'</b> '.stringLong($row->subject, 'title').$newLabel.'</a>';

                $rowHtml .= '<br>Asked Question <b>'.$row->created_at->diffForHumans().'</b>, '.
                    '<b>'.$row->comments_count.'</b> Comments';
                return $rowHtml;
            })
            ->editColumn('department_id', function ($row) {
                return optional($row->departments)->department_name;
            })
            ->editColumn('user_id', function ($row) {
                return optional($row->users)->name;
            })
            ->editColumn('assigned_id', function ($row) {

                if (count($row->assigned)){
                    $row->assigned->each(function($assign_employee) use(&$employees) {
                        $employees .= $assign_employee->employee->name.', ';
                    });
                }else{
                    $employees = 'Not Assigned';
                }

                return rtrim($employees,', ');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->diffForHumans();
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->editColumn('action', 'company.tickets.action')
            ->rawColumns(['subject', 'action']);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Ticket::with(['activity','departments', 'users', 'assigned' => function($query) {
            $query->with('employee');
        }])->withCount(['comments'])->orderBy('created_at','DESC');
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
            'subject',
            'department_id',
            'user_id',
            'assigned_id'
        ];
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                'subject'       => ['title' => 'Thread'],
                'user_id'       => ['title' => 'Requester','visible'=>auth()->user()->hasRole('admin')?true:false],
                'created_at'    => ['title' => 'Create Date'],
                'updated_at'    => ['title' => 'Updated Date'],
                'department_id' => ['title' => 'Department','visible'=>!ENV('IS_GOLDENMACE')?true:false],
                'assigned_id'   => ['title' => 'Assigned'],
            ])
            ->ajax('')
            ->addAction(['title' => 'Actions','width' => '100px', 'printable' => false])
            ->parameters($this->getBuilderParameters());
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ticket-' . time();
    }
}
