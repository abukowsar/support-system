<?php

namespace App\Http\Controllers\Support;

use App\Department;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Ticket;
use App\Comment;
use App\CommentLike;
use App\TicketTags;
use App\Categories;
use Auth;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Validation\Rule;
use function Matrix\trace;

use App\Http\Requests\CommentRequest;

use App\Http\Requests\StoreSupportTicketRequest;

class SupportController extends Controller
{

	public function create(Request $request)
	{
		$ticket = Ticket::find($request->id);
		$title = 'Edit Ticket';

	    if($ticket ==null){
	        $title = 'Create Ticket';
	        $ticket = new Ticket;
	    }

	    $assets=['simditor'];

	    return view('support._form',compact('title','ticket','assets'));
	}

	public function store(StoreSupportTicketRequest $request)
	{
		purifyInputData($request);

		if (!isset($request->department_id)){
		    $department = Department::where('default',1)->first();
            $request['department_id'] = $department->id;
        }

    	$temp = $request->all();

	    $temp['user_id'] =\Auth::user()->id;

	    $temp['date'] = date('Y-m-d h:i');

        $temp['user_guard']=userGuardCheck();

        $ticket = Ticket::updateOrCreate(['id'=>$request->id],$temp);

	    $comments = [];

	    $comments['user_id']	=	auth()->user()->id ;

	    $comments['ticket_id']	=	$ticket->id;

	    $comments['comment']	=	$request->description ;

        $comments['parent_comment'] = 0;

	    $comment = Comment::updateOrCreate(['ticket_id'=>$ticket->id,'user_id'=>auth()->user()->id],$comments);

	    storeMediaFile($comment,$request->comment_attachment, 'comment_attachment');

	    $request->request->add(['ticket_id' => $ticket->id]);

	    TicketTags::updateAndCreate($request->all());

	    if($ticket->wasRecentlyCreated){
	        $msg = _t(__('message.create_ticket'));

	        $attchments = getAttachments($comment->getMedia('comment_attachment'));

	        $data= array(
	            'template_type' =>'open_ticket',
	            'data'=>$ticket->departments->departmentLeader,
	            'ticket'=>$ticket,
	            'attachments'=>json_encode($attchments)
	        );

	        sendEmailNotification($data);

	        return redirect()->route('support.ticket.list','all')->with('success',$msg);
	    }else{
	        $msg = _t(__('message.update_ticket'));
	        return redirect()->route('support.show',['id'=>$ticket->id])->with('success',$msg);
	    }
	}

	public function ticketStatusChange(Request $request)
	{
	    $data = Ticket::findorfail($request->id);

	    $data->update(['status'=>$request->status]);
	    $msg = 'Ticket has been '.$request->status;

	    return redirect()->back()->with('success','Ticket '.$msg);
	}


	public function getTickets(Request $request,$type='')
	{
		$keywords = $request->keywords;
		$category = Categories::getCategory($request->category);

		return view('support.ticket',compact('type','keywords','category'));
	}

	public function ticketList(Request $request)
	{

		$tickets=Ticket::with(['users'])->Priority()->withCount(['comments','votes'=>function($query){
			$query->where('vote',1);
		}]);

		if($request->type=='private'){
			$tickets->where('user_id',Auth::id());
		}else{
			$tickets->where('ticket_show_by',$request->type);
		}

		if($request->keywords){
			$tickets->where('subject', 'LIKE', '%'.$request->keywords.'%');
		}

		if($request->department_id){
			$tickets->whereIn('department_id',$request->department_id);
		}

		if($request->category){
			$category_ids=is_array($request->category)?$request->category:(array)$request->category;
			$tickets->whereHas('ticketTags',function($t) use($category_ids){
				$t->whereIn('category_id',$category_ids);
			});
		}


		switch ($request->filter_type) {
			case 'new':
				$tickets->orderBy('created_at','DESC');
				break;
			case 'helpful':
				$tickets->orderBy('votes_count','DESC');
				break;
			case 'viewed':
				$tickets->orderBy('views','DESC');
				break;
		}

		$tickets = $tickets->simplePaginate(\Config::get('constant.PAGINATION.SEARCH'));

		$returnHTML = view('support.search-ticket', compact('tickets'))->render();

		return response()->json(array(
		    'status'    => true,
		    'html'      => (count($tickets) > 0 ? $returnHTML : ''),
		    'counts'    => $tickets->count(),
		    'is_more'   => $tickets->hasMorePages()
		));
	}

	public function postReply(Request $request)
	{
		\Session::put('url.intended', url()->previous());
		return redirect()->route('login');
	}

	public function viewTickets(Request $request,$slug)
	{
		$assets = ['simditor','readmore'];

		$ticket = Ticket::withCount('comments')->with(['comments'=>function($e){
			$e->with('commentLikeByMe')->withCount('commentLike')->orderBy('id','DESC');
		},'userVote'])->where('slug',$slug)

		->where(function($q){
		    $q->where('user_id',Auth::id());
		    $q->orWhere('ticket_show_by','public');
		 })
		->firstOrFail();

		$ticket->increment('views', 1);

		$categories=Categories::whereHas('ticketCategory',function($q){
			$q->whereHas('ticket');
		})->get();

		$recentTickets = Ticket::orderBy('id','DESC')->take(10)->get();

		SEOTools::setTitle($ticket->subject);
		SEOTools::setDescription(stringLong($ticket->description,'desc'));
		SEOTools::opengraph()->setUrl(route('ticket.show',['slug'=>$ticket->slug]));
		SEOTools::setCanonical(route('ticket.show',['slug'=>$ticket->slug]));
		SEOTools::opengraph()->addProperty('type', 'Ticket');

		return view('support.details',compact('assets','ticket','categories','recentTickets'));
	}

	public function saveComments(CommentRequest $request)
	{
		purifyInputData($request);

		$comments = $request->all();
		$comments['user_id']    = auth()->user()->id;
        $comments['user_guard'] = userGuardCheck();
		$comments['ticket_id']  = $request->ticket_id;

		$ticket = Ticket::find($request->ticket_id);
		$ticket->updated_at = date('Y-m-d H:i:s');
        $ticket->save();

		$comment = Comment::updateOrCreate(['id' => $request->id], $comments);

		$ticket=$comment->ticket;

        $ticket['description']=$comment->comment;

        $replyTo='reply_ticket';

        if($comment->user_guard == 'web'){
        	$replyTo='reply_by_user';
        }

        storeMediaFile($comment, $request->comment_attachment, 'comment_attachment');

        $attchments = getAttachments($comment->getMedia('comment_attachment'));

		$data= array(
		    'template_type' => $replyTo,
		    'ticket'=>$ticket,
		    'attachments'=>json_encode($attchments)
		);

		sendEmailNotification($data);

		return redirect()->back()->withSuccess(_t(__('message.supportTickets.comment_message')));
	}

	public function commentLoved(Request $request)
	{
	    $votes=1;
	    if($request->vote==1){
	        $votes=0;
	    }
	    $like =CommentLike::commentLoved($request->id);

	    if($like==null){
	        $like = new CommentLike;
	        $like->user_id = auth()->user()->id;
	        $like->comment_id = $request->id;
	        $like->vote =$votes;
	        $like->save();

	    }else{
	        $like->update(['vote'=>$votes]);
	    }

	    return response()->json( array('status' => true,'vote'=>$votes) );
	}


	public function searchPublicTicket(Request $request)
	{
		$tickets=Ticket::with(['users'])->Priority()
				->where('ticket_show_by','public')
				->withCount('comments')
				->limit(5);

		if($request->type=='views'){
			$tickets->orderBy('id','DESC');
		}

		$tickets=$tickets->orderBy('id','DESC')->get();

		$returnHTML = view('support.search-ticket', compact('tickets'))->render();

		return response()->json([
		    'status'    => true,
		    'html'      => $returnHTML
		]);
	}

	/*home page search list*/

	public function suppotSearch(Request $request)
	{
		$auth_id=(\Auth::check())?Auth::id():null;

        $data = [
            'string'    =>$request->string,
            'limit'     =>5,
            'user_id'   =>$auth_id,
            'offset' 	=>null,
            'type'		=>$request->type
        ];

        $search_data=Ticket::getSearchUnionData($data);

        $html='';

        foreach ($search_data as $key => $row) {

            $route=route('ticket.show',['slug'=>$row->slug]);
            if($row->s_type == 'article'){
                $route=route('article.details',['slug'=>$row->slug]);
            }

            $row->title= isset($row->title) ? stringLong($row->title,'',70) : '';

            $html.='<a href="'.$route.'" class="text-black"><li class="user_name">'.ucfirst($row->title).'</li></a>';
        }

        return response()->json( array('status' => true,'html'=>$html) );
	}

	public function ticketSuggestionList(Request $request)
	{
		$auth_id=(\Auth::check())?Auth::id():null;

        $data = [
            'string'    =>$request->string,
            'limit'     =>2,
            'user_id'   =>$auth_id,
            'offset' 	=>null,
            'type'		=>$request->type
        ];

        $search_data=Ticket::getSearchUnionData($data);

        $returnHTML = view('support.ticket-suggestion', compact('search_data'))->render();

        return response()->json(array(
            'status'    	=> true,
            'html'      	=> count($search_data) > 0 ? $returnHTML : '',
            'count'      	=> count($search_data),
        ));

	}

	public function getSuppotSearch(Request $request)
	{
		purifyInputData($request);

		if($request->type=='tickets'){
			$route=route('public.ticket',['type'=>'public','keywords'=>$request->string]);

		}else{
			$route=route('article.list',['keywords'=>$request->string]);
		}

       return redirect()->to($route);
   }

}
