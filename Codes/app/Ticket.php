<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Article;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use HasSlug, SoftDeletes,Notifiable;

    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'user_id',
        'slug',
    	'department_id',
        'assigned_id',
    	'priority',
    	'subject',
    	'description',
    	'status',
    	'ticket_show_by',
    	'url',
    	'solved_by',
    	'date',
    	'reopen_at',
        'views'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                ->generateSlugsFrom('subject')
                ->saveSlugsTo('slug');
    }

    public function scopePriority($query)
    {
        return $query->orderByRaw("FIELD(priority , 'emergency', 'high', 'normal', 'low') ASC");
    }

    public function scopeNewActivity($query){
        return $query->whereDoesnthave('activity',function ($q) {
            $q->where('created_at' ,'>', \DB::raw('tickets.updated_at'));
        });
    }

    public function users(){
       return $this->belongsTo('App\User','user_id','id');
    }
    public function user(){
       return $this->belongsTo('App\User','user_id','id');
    }

    public function assigned(){
        return $this->hasMany(TicketAssignedMapping::class,'ticket_id','id');
    }

    public function comments(){
       return $this->hasMany(Comment::class,'ticket_id','id')->orderBy('id', 'DESC');
    }

    public function ticketTags(){
       return $this->hasMany(TicketTags::class,'ticket_id','id');
    }

    public function leaderDepartments(){
        return $this->hasMany(DepartmentLeader::class,'department_id','department_id');
    }

    public function departments(){
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function leader(){
        return $this->belongsTo(Employee::class,'assigned_id','id');
    }

    protected function getTicketDate($type){
        return self::selectRaw('count(Date(created_at)) as total , DATE_FORMAT(created_at , "%m") as date' )
            ->myTickets()
            ->whereYear('created_at',date('Y'))
            ->groupBy(\DB::raw('DATE_FORMAT(created_at, "%m")'))
            ->where('status',$type)
            ->get()
            ->toArray();
    }

    public function scopeRequestTickets($query)
    {
        if(!auth()->user()->hasRole('admin')) {
            $query = $query->whereHas('leaderDepartments', function ($query) {
                $query->where('leader_id', \Auth::id());
            });
        }

        return $query->whereNull('assigned_id')->where('status', 'open');
    }

    public function scopeUnassignedTickets($query)
    {
        if(!auth()->user()->hasRole('admin')) {
            $query = $query->whereHas('leaderDepartments', function ($query) {
                $query->where('leader_id', \Auth::id());
            })->where('assigned_id', \Auth::id());
        }

        return $query->whereNotNull('assigned_id')
                ->doesnthave('assigned')
                ->where('status', 'open');
    }

    public function scopeMyTickets($query)
    {
        if(auth()->user()->hasRole('admin')) {
            return $query;
        }

        if(auth()->user()->hasRole('leader')) {
            return $query->where('assigned_id', \Auth::id());
        }

        if(auth()->user()->hasRole('employee')) {
            return $query->whereHas('assigned', function ($query) {
                return $query->where('assigned_to', \Auth::id());
            });
        }

        return $query->where('user_id', \Auth::id());
    }

    public function scopeRecentlyUpdated($query)
    {
        $activity = Activity::inLog('ticket.last.activity')->causedBy(auth()->user())->first();

        if($activity!=null){
            return $query->where('updated_at', '>', $activity->created_at);
        }
    }

    protected function getSearchUnionData($data){

        $string=$data['string'];

        $tickets= self::with('users')->select('user_id','subject as title','slug',\DB::raw(' (CASE WHEN id THEN "ticket" ELSE null END) as  type'),'description','created_at')
                ->withCount('comments')
                ->where('subject', 'like',"%{$string}%")
                ->where('ticket_show_by','public');

                if(isset($data['limit']) && $data['offset']==null) {
                    $tickets->limit($data['limit']);
                }
                if(isset($data['offset'])) {
                    $tickets->limit(\Config::get('constant.PAGINATION.SEARCH'))->offset($data['offset']);
                }

                $article= Article::select('user_id','title','slug',\DB::raw(' (CASE WHEN id THEN "article" ELSE null END) as  s_type'),'content as description','created_at','id as comments_count')
                        ->where('title', 'like',"%{$string}%");

                if(isset($data['limit']) && $data['offset']==null) {
                    $article->limit($data['limit']);
                }
                if(isset($data['offset'])) {
                    $article->limit(\Config::get('constant.PAGINATION.SEARCH'))->offset($data['offset']);
                }

                switch ($data['type']) {
                    case 'tickets':
                        $results = $tickets->get();
                        break;
                    case 'articles':
                        $results = $article->get();
                        break;

                    default:
                        $results = $tickets->union($article)->get();

                        break;
                }

        return $results;

    }


    public function votes()
    {
        return $this->hasMany(Vote::class, 'item_id','id')->where('type','ticket');
    }

     public function userVote()
    {
        return $this->hasOne(Vote::class, 'item_id','id')->where('type','ticket')->whereHas('user')->with('user');
    }

    public function activity(){
        return $this->hasOne(Activity::class,'subject_id','id')->with('subject')
            ->where('subject_type','App\Ticket')
            ->where(['causer_id' => auth()->id(),'causer_type' => get_class(auth()->user())]);
    }

}
