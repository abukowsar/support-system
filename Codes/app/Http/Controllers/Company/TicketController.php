<?php

namespace App\Http\Controllers\Company;

use App\DataTables\EmployeeDataTable;
use App\Traits\CommentsTrait;
use Auth;
use App\DataTables\Scopes\RequestTicket;
use App\DataTables\Scopes\MyTicket;
use App\DataTables\Scopes\RequestTypeTicket;
use App\DataTables\Scopes\UnassignedTicket;
use App\DataTables\Scopes\UpdatedTicket;
use App\DataTables\TicketDataTable;
use App\Http\Controllers\Controller;
use App\MailMailable;
use App\DepartmentLeader;
use App\Ticket;
use App\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Notifications\CommonNotification;
use App\TicketTags;

class TicketController extends Controller
{
    use CommentsTrait;
    /**
     * Display a listing of the resource.
     *
     * @param EmployeeDataTable $dataTable
     * @return Response
     */
    public function index(TicketDataTable $dataTable, $ticketType)
    {
        $assets=['datatable'];
        $pageTitle= __('message.lists',['name' => __('message.tickets')]);

        $dataTable->addScope(new RequestTypeTicket);

        if(Auth::user()->hasRole('user')){
            $button='<a href="'.route("support.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus"></i> '.__('message.submit_a_ticket').'</a>';
        }

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }


    public function edit($id, Request $request)
    {
        $pageTitle = _t(__('message.ticket'));
        
        $ticket = Ticket::MyTickets()->with('comments')->findorfail($request->id);

        $assets = ['simditor'];

        Activity::inLog('ticket.last.activity')->forSubject($ticket)->causedBy(auth()->user())->delete();

        activity('ticket.last.activity')->performedOn($ticket)->log('Ticket list has been viewed.');

        return view('company.tickets.view', compact('pageTitle','ticket','assets'));

    }

    /*
     * Ticket Actions[solve,close,transfer,assign,approve,delete,reopen,restore] functionality
     * */
    public function action(Request $request)
    {
        $ticket = Ticket::withTrashed()->findorfail($request->id);
        $ticket->updated_at = date('Y-m-d H:i:s');
        $ticket->save();
        $message = _t(__('message.supportTickets.action_message'));

        if($request->type == 'approve') {
            $ticket->update(['assigned_id' => auth()->user()->id]);
            $commentData['comment'] = _t(__('message.commentTickets.approved_message'));
            $commentData['type'] = 1;
            $message = _t(__('message.supportTickets.approved_message'));
        }

        if($request->type == 'transfer') {

            $ticket->assigned()->delete();

            $assign_employee = NULL;

            if (isset($request->leader_id)){
                $assign_employee = $request->leader_id;
            }else{
                $assign_employee = DepartmentLeader::where('department_id',$request->department_id)->value('leader_id');
            }

            if($assign_employee==null && $assign_employee==''){

                $message = _t(__('message.supportTickets.department_dont_have_employee'));

                if($request->ajax()) {
                    return response()->json([
                        'status' => true,
                        'message' => $message
                    ]);
                }
            }

            $ticket->update(['department_id' => $request->department_id, 'assigned_id' => $assign_employee]);

            $assign_employees = [
                'ticket_id'   => $ticket->id,
                'assigned_to' => $assign_employee,
                'assigned_by' => \Auth::id(),
            ];
            if($request->priority){
                $ticket->fill(['priority'=>$request->priority])->save();
            }
            if($assign_employee != null)
                $ticket->assigned()->insert($assign_employees);

            $commentData['comment'] = _t(__('message.commentTickets.transfer_success_message', ['department' => $ticket->departments->department_name]));
            $commentData['type'] = 1;
            $message = _t(__('message.supportTickets.transfer_success_message', ['department' => $ticket->departments->department_name]));

            $data= array(
                'template_type' =>'new_ticket_request',
                'data'=>$ticket->departments->departmentLeader,
                'ticket'=>$ticket
            );

            sendEmailNotification($data);
        }


        if($request->type == 'assign_employee') {
            $ticket->update(['timestamps' => true]);

            $ticket->assigned()->delete();

            $data = [
                'ticket'    => $ticket->subject,
                'name'      => Auth::user()->name,
                'url'       => route('support.ticket.edit',['id'=>$ticket->id]),
                'regards'   => ENV('APP_NAME'),
            ];

            if($request->assign_employees != null) {

                foreach($request->assign_employees as $assign_employee) {

                    $assign_employees= [
                        'ticket_id'   => $ticket->id,
                        'assigned_to' => $assign_employee,
                        'assigned_by' => \Auth::id(),
                    ];

                    $employee=Employee::find($assign_employee);

                    $data= array(
                        'template_type'    =>'assign_ticket',
                        'assign_employee' =>$employee,
                        'ticket'=>$ticket
                    );

                    sendEmailNotification($data);

                    $ticket->assigned()->insert($assign_employees);

                }
            }

            $commentData['type'] = 1;

            $commentData['comment'] = _t(__('message.commentTickets.assigned_employee_message'));

            $message = _t(__('message.supportTickets.assigned_employee_message'));
        }

        /*if($request->type == 'delete') {
            $ticket->delete();
            $message = _t(__('message.supportTickets.trashed_success_message'));
        }*/

        if($request->type == 'solve') {
            $ticket->update(['status' => 'solved']);
            $commentData['comment'] = _t(__('message.commentTickets.solved_success_message'));
            $commentData['type'] = 2;
            $message = _t(__('message.supportTickets.solved_success_message'));

            /*----------------notification------------------------*/

            $data= array(
                'template_type' =>'solve_ticket',
                'ticket'=>$ticket,
            );

            sendEmailNotification($data);

            /*----------------Closed notification------------------------*/
        }


        if($request->type == 'closed') {
            $ticket->update(['status' => 'closed']);
            $commentData['type'] = 3;
            $commentData['comment'] = _t(__('message.commentTickets.closed_success_message'));
            $message = _t(__('message.supportTickets.closed_success_message'));


            $data= array(
                'template_type' =>'closed_ticket',
                'data' => $ticket->assigned,
                'ticket'=>$ticket
            );

            sendEmailNotification($data);
        }

        if($request->type == 'reopen') {
            $ticket->update(['status' => 'open']);
            $commentData['type'] = 2;
            $commentData['comment'] = _t(__('message.commentTickets.reopen_success_message'));

            /*----------------notification------------------------*/

            $data= array(
                'template_type' =>'reopen_ticket',
                'data' => $ticket->assigned,
                'ticket'=>$ticket
            );

            sendEmailNotification($data);

            /*----------------Closed notification------------------------*/

            $message = _t(__('message.supportTickets.reopen_success_message'));
        }

        if($request->type == 'delete') {
            $ticket->delete();
            $commentData['comment'] = _t(__('message.commentTickets.trashed_success_message'));
            $commentData['type'] = 3;
            $message = _t(__('message.supportTickets.trashed_success_message'));
        }

        if($request->type == 'restore') {
            $ticket->restore();
            $commentData['comment'] = _t(__('message.commentTickets.restored_success_message'));
            $commentData['type'] = 2;
            $message = _t(__('message.supportTickets.restored_success_message'));
        }

        $commentData['ticket_id'] = $request->id;
        // $this->saveComment($commentData);

        if($request->ajax()) {
            return response()->json([
                'status' => true,
                'datatable_reload' => true,
                'message' => $message
            ]);
        }

        return redirect()->back()->withSuccess($message);
    }

    public function transferForm($id)
    {
        $ticket = Ticket::with('departments')->findorfail($id);

        return response()->json([
            'status'     => true,
            'page_title' => _t(__('message.transfers.title')),
            'data'       => view('company.tickets._transfer_form', compact('ticket'))->render()
        ]);
    }

    public function addCategory($id)
    {
        $categories = TicketTags::where('ticket_id',$id)->get();

        return response()->json([
            'status'     => true,
            'page_title' => _t(__('message.change_category',['name' => __('message.category')])),
            'data'       => view('company.tickets.add-category', compact('categories','id'))->render()
        ]);
    }


    public function ticketCategoryAdd(Request $request)
    {
        $data=$request->all();

        if($request->category_id == null){

            return response()->json([
                'status' => true,
                'message' => 'select category first.'
            ]);

        }

        TicketTags::where('ticket_id',$request->ticket_id)->delete();

        foreach ($request->category_id as $category) {

            $temp=array('ticket_id' => $request->ticket_id,'category_id'=>$category );

            TicketTags::insert($temp);
        }

        if($request->ajax()) {
            return response()->json([
                'status' => true,
                'datatable_reload' => true,
                'message' => 'Ticket added category successfully.'
            ]);
        }
    }

    public function assignEmployeeForm($id)
    {
        $ticket = Ticket::with('assigned')->findorfail($id);

        return response()->json([
            'status'     => true,
            'page_title' => _t(__('message.assign_employee')),
            'data'       => view('company.tickets._assign_employee', compact('ticket'))->render()
        ]);
    }
}
