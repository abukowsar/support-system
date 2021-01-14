<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\User;
use App\Employee;
use App\Ticket;
use App\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UsersDataTable $dataTable
     * @return Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $assets=['datatable'];
        $pageTitle= __('message.lists',['name' => __('message.user')]);
        $button='<a href="'.route("users.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '.__('message.add',['name' => __('message.user')]).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    /*Admin dashboard*/
    public function dashboard(Request $request)
    {
        $dashboard = [
                    'count_ticket'          => Ticket::myTickets()->count(),
                    'count_open_ticket'     => Ticket::myTickets()->where('status','open')->count(),
                    'count_closed_ticket'   => Ticket::myTickets()->where('status','closed')->count(),
                    'count_solved_ticket'   => Ticket::myTickets()->where('status','solved')->count()
                ];

                $tickets       = Ticket::getTicketDate('open');
                $solvedTicket  = Ticket::getTicketDate('solved');
                $closedTicket  = Ticket::getTicketDate('closed');

                $countData=[];

                $countData['list']=[];

                for($i = 1; $i <= 12; $i++ ){

                    $listData = 0;

                    foreach($tickets as $ticket){

                        if((int)$ticket['date'] == $i){
                            $countData['list'][] = (int)$ticket['total'];
                            $listData++;
                        }
                    }

                    if($listData == 0){
                        $countData['list'][] = 0 ;
                    }

                    $jobData = 0;

                    foreach($solvedTicket as $solved){

                        if((int)$solved['date'] == $i){
                            $countData['solved'][] = (int)$solved['total'];
                            $jobData++;
                        }
                    }

                    if($jobData == 0){
                        $countData['solved'][] = 0;
                    }

                    $closedTicketData = 0;

                    foreach($closedTicket as $closed){
                        if((int)$closed['date'] == $i){
                            $countData['closed'][] = (int)$closed['total'];
                            $closedTicketData++;
                        }
                    }

                    if($closedTicketData == 0){
                        $countData['closed'][] = 0;
                    }
                }


                $maxTick            = max(max($countData['list']),max($countData['solved']),max($countData['closed']));
                $dataLimit          = array('limit' => 10);
                $ticketListings     = Ticket::myTickets()->with(['departments', 'users',
                    'assigned' => function($query) {
                        $query->with('employee');
                    }])->withCount(['comments'])->take(10)->orderBy('created_at', 'DESC')->get();

                $assets=['chart'];

                return view('dashboard',compact('dashboard','countData','maxTick', 'ticketListings' ,'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        purifyInputData($request);
        // Save user data...
        $request['password'] = bcrypt($request->password);
        $request['email_verified_at'] = date('Y-m-d h:i:s');
        $user = User::create($request->all());

        $user->assignRole('user');

        // Save user image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        // Save user Profile data...
        $user->userProfile()->create($request->userProfile);

        return redirect()->route('users.index')->withSuccess(__('message.msg_added',['name' => 'user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(!auth()->guard('admin')->check()){
            $id = auth()->id();
        }

        $user = User::with(['userProfile','roles'])->findOrFail($id);

        $profileImage = getSingleMedia($user, 'profile_image');

        return view('admin.users.edit', compact('user','profileImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return Response
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(UserRequest $request, $id)
    {
        purifyInputData($request);

        if(!auth()->guard('admin')->check()){
            $id = auth()->id();
        }

        $user = User::with('userProfile')->findOrFail($id);

        $user->assignRole('user');

        // User user data...
        $user->fill($request->all())->update();

        // Save user image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }


        // user profile data....
        if(isset($user->userProfile)){
            $user->userProfile->fill($request->userProfile)->update();
        }else{
            $user->userProfile()->create($request->userProfile);
        }
        if(auth()->guard('admin')->check()){
            return redirect()->route('users.index')->withSuccess(__('message.msg_updated',['name' => 'user']));
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {   
        if(ENV('IS_DEMO')){
            return redirect()->back()->withSuccess('User delete not working on demo site.');
        }

        $article = User::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.user')]));

        if($article!='') {
            $article->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.user')]));
        }

        return redirect()->back()->withSuccess($msg);
    }

    public function changePassword(Request $request){

        $user = auth()->user();

        return view('users.pages.change-password',compact('user'));
    }

    public function updateUserStatus($type, $id, $status)
    {
        $update_column = '';
        $msg='';
        switch ($type) {
            case 'banned':
                    $update_column = ['banned' => $status];
                    $msg=_t(__('message.user_baned'));
                    if($status==0){
                        $msg=_t(__('message.user_active'));
                    }
                break;
            default:
                    $update_column = ['status' => $status];
                break;
        }

        $result = User::where('id',$id)->update($update_column);

        return response()->json(array(
            'status'    => true,
            'message'   => $msg
        ));
    }

    public function adminProfileShow(Request $request){

        $pageTitle = _t(__('message.profile'));

        return view('admin.account.index',compact('pageTitle'));
    }

    public function adminProfileStore(Request $request){
        if(env('THEMEFOREST')){
            return redirect()->back()->withErrors(_t(__('message.permissions.no_access')))->withInput($request->all());
        }

        $user_id=\Auth::id();

        $validator = Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:191',
            'email' => 'required|max:191|email|unique:admins,email,'.$user_id,
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);

        $validator->validate();

        $user = auth()->user();

        $data = $request->all();

        $userTemp = [
            'name' => $data['name'],
            'username' => stristr($data['email'], "@", true),
            'email' => $data['email'],
            'password' => isset($request->password)?Hash::make($data['password']):$user->password,
        ];

        $user->update($userTemp);

        storeMediaFile($user,$request->profile_image, 'profile_image');

        auth()->logout();

        $message = 'Your credentials has been changed successfully.';

        return redirect()->route('admin.login')->withSuccess($message);
    }

    public function removeCurrentPhoto(Request $request){

        \Auth::user()->clearMediaCollection('profile_image');

        return redirect()->back();
    }
}
