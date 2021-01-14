<?php

namespace App;
use App\Comment;

use Illuminate\Database\Eloquent\Model;

class TicketTags extends Model
{
    protected $table = 'ticket_tags';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'ticket_id',
    	'category_id'
    
    ];

    protected function updateAndCreate(&$data)
    {   
        if(isset($data['category']) && $data['category'] != null){
            
            self::where('ticket_id',$data['ticket_id'])->whereNotIn('category_id',$data['category'])->delete();
        
            foreach ($data['category'] as $key => $row) {
               
                $temp=array(
                       'ticket_id' =>$data['ticket_id'],
                       'category_id'     =>$row,
                );

               self::updateOrCreate(['ticket_id'=>$data['ticket_id'],'category_id'=>$row],$temp);
           }

    	}
    }

    public function ticket(){
       return $this->belongsTo(Ticket::class,'ticket_id','id')->groupBy('ticket_id');
    }

    public function category(){
       return $this->belongsTo(Categories::class,'category_id','id');
    }
}
