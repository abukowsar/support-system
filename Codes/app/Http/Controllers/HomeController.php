<?php

namespace App\Http\Controllers;

use App\Notifications\CommonNotification;
use App\Notifications\Mailable;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Rules\GoogleRecaptcha;
use Illuminate\Http\Request;
use App\CommentLike;
use App\Categories;
use App\StaticData;
use App\Comment;
use App\Article;
use App\Knowledge;
use App\Ticket;
use App\Videos;
use App\Pages;
use App\Faq;
use Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Categories::withCount(['ticketCategory' => function($query) {
            $query->whereHas('ticket', function ($query) {
                $query->where('ticket_show_by', 'public');
            });
        }])->list()->limit(5)->get();

        $videos = Videos::list()->with('category')->limit(10)->get();
        $articles=Article::list()->limit(6)->get();
        $articleCategory=Categories::whereHas('article')->with('article')->get();

        SEOTools::setTitle(request()->appData->home_slide_title);
        SEOTools::setDescription(stringLong(request()->appData->home_slide_text,'desc'));
        SEOTools::opengraph()->setUrl(route('home'));
        SEOTools::setCanonical(route('home'));
        SEOTools::opengraph()->addProperty('type', 'Home Page');
        SEOTools::jsonLd()->addImage(getSingleMedia(request()->appData,'site_logo'));

        return view('home',compact('articles','articleCategory','categories','videos'));
    }

    public function pages(Request $request,$page)
    {
        switch ($page) {
            case 'contact-us':
                return view('pages.contact-us');
                break;
            case 'faqs':
                $data=Faq::getFaq();

                $categories=Categories::whereHas('article')->with('article')->get();

                $recentArticle = Article::where('status', 1)->orderBy('id','DESC')->take(5)->get();

                $tickets=Ticket::Priority()->where('ticket_show_by','public')->limit(5)->orderBy('id','DESC')->get();
                return view('pages.faqs',compact('data','categories','recentArticle','tickets'));
                break;
            default:
                $pageData= Pages::getPageData($page);
                break;
        }

        return view('pages.page',compact('pageData'));
    }

    public function recaptchaResponse($request){
        if($request->has('g-recaptcha-response'))
            return ['success' => true];
        else
            return ['success' => false];
    }

    /*
     * Send Contact us mail via mailable notification
     * */
    public function contactMessage(Request $request){

        $this->validate($request, [
            'email' => 'required|email|max:191',
            'name' => 'required|max:191|regex:/^[\pL\s\-]+$/u',
            'message' => 'required',
            'g-recaptcha-response' => ['required', new GoogleRecaptcha]
        ]);
        /*
         * Mailable Button Parameters
         * */
        $temp = [
            'name' => $request->name ?? '',
            'email' => $request->email ?? '',
            'mobile_no' => $request->mobile_number ?? '',
            'message' => $request->message ?? '',
        ];
        /*
         * Mailable Type contact_us
         * */
        Notification::route('mail', $request->email)
            ->notify(new CommonNotification('contact_us',$temp));

        return redirect()->back()->withSuccess(_t(__('message.contact_submit')));
    }

    public function getSingleVideo(Request $request,$id)
    {
        $video=Videos::list()->where('id',$id)->first();

        $returnHTML = view('videos.item', compact('video'))->render();

        return response()->json(array(
            'status'    => true,
            'html'      => $returnHTML
        ));
    }

    public function vots(Request $request, $val){

        $type=$request->type;

        $val=$val=='yes'?1:0; 
        
        $arrayData = array('user_id' =>Auth::id(),'type'=>$type,'item_id'=>$request->item_id,'vote'=>$val);

        \App\Vote::updateOrCreate(['user_id'=>Auth::id(),'type'=>$type,'item_id'=>$request->item_id],$arrayData);

        return redirect()->back()->withSuccess(_t(__('message.votes_msg')));

    }

    public function lang($locale)
    {
        \App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect('/');
    }

    public function singleViewPage(Request $request,$type,$slug)
    {
        $route=route('home');

        switch ($type) {
            case 'ticket':

                $ticket = Ticket::where('slug', $slug)->where('ticket_show_by','public')->first();

                if($ticket==null){
                    $ticket = Ticket::where('ticket_show_by','public')->Priority()->first();
                }

                if($ticket!=null){
                    $route=route('ticket.show',['slug'=>$ticket->slug]);
                }

                break;
            case 'knowledge':

                $knowledge = Knowledge::where('slug', $slug)->first();

                if($knowledge==null){
                    $knowledge = Knowledge::first();
                }

                if($knowledge!=null){
                    $route=route('knowledge.details',['slug'=>$knowledge->slug]);
                }
                break;
            case 'article':

                $article = Article::list()->where('slug', $slug)->first();

                if($article==null){
                    $article = Article::first();
                }

                if($article!=null){
                    $route=route('article.details',['slug'=>$article->slug]);
                }

                break;

            default:
                # code...
                break;
        }

        return redirect($route);

    }

    public function checkEnvironment(Request $request)
    {
        $message = "";
        if($request->tab == "tab3"){
            try{
                $con = mysqli_connect($request->database_hostname.':'.$request->database_port,$request->database_username,$request->database_password,$request->database_name);
                $status = true;
                if(empty($request->database_name)){
                    $message = "Database not found in your server";
                    $status = false;
                }
            }
            catch (\Exception $e){
                $con = false;
                if(strpos($e->getMessage(), 'Access denied for user') !== false){
                    $message = "Please enter correct database username or password";
                }elseif(strpos($e->getMessage(), 'Unknown database') !== false){
                    $message = "Database not found in your server";
                }elseif(strpos($e->getMessage(), "Connection refused") !== false){
                    $message = "Please enter valid database port ";
                }elseif(strpos($e->getMessage(), "Connection timed out") !== false || strpos($e->getMessage(), "Invalid argument") !== false){
                    $message = "Please enter valid database host";
                }else{
                    $message = $e->getMessage();
                }
                $status = false;
            }
        }elseif ($request->tab == "tab4"){

            $envFileData =
                'APP_NAME=\'' . optional($request)->app_name . "'\n" .
                'APP_ENV=' . optional($request)->environment . "\n" .
                'APP_KEY=' . 'base64:bODi8VtmENqnjklBmNJzQcTTSC8jNjBysfnjQN59btE=' . "\n" .
                'APP_DEBUG=' . optional($request)->app_debug . "\n" .
                'APP_LOG_LEVEL=' . optional($request)->app_log_level . "\n" .
                'APP_URL=' . optional($request)->app_url . "\n\n" .
                'DB_CONNECTION=' . optional($request)->database_connection . "\n" .
                'DB_HOST=' . optional($request)->database_hostname . "\n" .
                'DB_PORT=' . optional($request)->database_port . "\n" .
                'DB_DATABASE=' . optional($request)->database_name . "\n" .
                'DB_USERNAME=' . optional($request)->database_username . "\n" .
                'DB_PASSWORD=' . optional($request)->database_password . "\n\n" .
                'BROADCAST_DRIVER=' . optional($request)->broadcast_driver . "\n" .
                'CACHE_DRIVER=' . optional($request)->cache_driver . "\n" .
                'SESSION_DRIVER=' . optional($request)->session_driver . "\n" .
                'QUEUE_DRIVER=' . optional($request)->queue_driver . "\n\n" .
                'REDIS_HOST=' . optional($request)->redis_hostname . "\n" .
                'REDIS_PASSWORD=' . optional($request)->redis_password . "\n" .
                'REDIS_PORT=' . optional($request)->redis_port . "\n\n" .
                'MAIL_DRIVER=' . optional($request)->mail_driver . "\n" .
                'MAIL_HOST=' . optional($request)->mail_host . "\n" .
                'MAIL_PORT=' . optional($request)->mail_port . "\n" .
                'MAIL_USERNAME=' . optional($request)->mail_username . "\n" .
                'MAIL_PASSWORD=' . optional($request)->mail_password . "\n" .
                'MAIL_ENCRYPTION=' . optional($request)->mail_encryption . "\n\n";

            try {
                file_put_contents(base_path('.env'), $envFileData);
                Artisan::call('config:clear');

                $mail_vals=[optional($request)->mail_driver,optional($request)->mail_host,optional($request)->mail_port,optional($request)->mail_username,optional($request)->mail_password,optional($request)->mail_encryption];
                if(in_array('null',$mail_vals) || in_array('',$mail_vals)){
                    $message = "Please check mail configuration";
                    $status = false;
                }else{
                    Notification::route('mail', 'abctest@gmail.com')
                        ->notify(new Mailable('mail_test',['data' => 'test']));
                    $status = true;
                }
            }
            catch(Exception $e) {
                $results = trans('Mail Server Not Connected, Please check you mail configuration');
                $status = false;
            }

        }else{
            $status = true;
            if(empty($request->app_name)){
                $status = false;
                $message = "Please enter the app name";
            }elseif ($request->environment=="other" && isset($request->environment_custom)){
                $status = false;
                $message = "Please enter the app environment";
            }
        }
        return response()->json([ 'status' => $status , 'message' => $message , 'tab' => $request->tab ]);
    }

    public function registerDomain(){


        return view('pages.register-domain');
    }

    public function storeUserDomain(Request $request){

        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'company'   => 'required|max:255',
            'subdomain' => 'required|max:255|alpha_num|unique:subdomains',
            'country'   => 'required|max:255',
        ]);


        \App\SubDomain::create($request->all());

        
    }

}
