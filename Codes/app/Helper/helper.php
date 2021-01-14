<?php

function removeSession($session){
    if(\Session::has($session)){
        \Session::forget($session);
    }
    return true;
}

function authSession($force=false){
    $session=new \App\User;
    if($force){
        $user=\Auth::user()->with('user_role');
        \Session::put('auth_user',$user);
        $session =\Session::get('auth_user');
        return $session;
    }
    if(\Session::has('auth_user')){
        $session =\Session::get('auth_user');
    }else{
        $user=\Auth::user();
        \Session::put('auth_user',$user);
        $session =\Session::get('auth_user');
    }
    return $session;
}

function randomString($length,$type = 'token'){
    if($type == 'password')
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    elseif($type == 'username')
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    else
         $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = substr( str_shuffle( $chars ), 0, $length );
    return $token;
}

function getSingleMedia($model, $collection = 'profile_image')
{
    if ($model !== null) {
        $media = $model->getFirstMedia($collection);
    }

    $imgurl= isset($media)?$media->getPath():'';

    if (file_exists($imgurl)) {
         return $media->getFullUrl();
    }else{

    switch ($collection) {
        case 'profile_image':
            $media = asset('assets/img/icons/user/user.png');
            break;
        default:
            $media = asset('assets/img/icons/common/add.png');
            break;
    }

    return $media;

    }
}

function getMediaImage($media)
{
    $imgurl= isset($media)?$media->getPath():'';

    if (file_exists($imgurl)) {
        return true;
    }
    return false;
}

function getMediaFileExit($model, $collection = 'profile_image')
{

    $media = $model->getFirstMedia($collection);

    $file= isset($media)?$media->getPath():'';

    return file_exists($file);

}

function envChanges($type,$value){
    $domainName=\Request::getHttpHost();
    $path = base_path('.env.'.$domainName);

    if (!file_exists($path)){
        $path = base_path('.env');
    }

    $value = str_replace(' ','_',$value);

    if (file_exists($path)) {

        if(in_array($type,config('constant.BOOLEAN_VARIABLE'))){
            if($value === '1') {
                $value = 'true';
            }else {
                $value = 'false';
            }
        }

        if (env($type) === null){
            \File::append($path, $type.'='.$value."\n");
        }else{
            if(in_array($type,config('constant.BOOLEAN_VARIABLE'))){
                file_put_contents($path, str_replace(
                    $type.'='.(env($type) ? 'true' : 'false'), $type.'='.$value, file_get_contents($path)
                ));
            }else{
                file_put_contents($path, str_replace(
                    $type.'='.env($type), $type.'='.$value, file_get_contents($path)
                ));
            }
        }
    }
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function variableCssChange($type,$old_value,$new_value){
    $path = public_path('css/variable.css');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $type.': '.$old_value.';', $type.': '.$new_value.';', file_get_contents($path)
        ));
    }
}

function getFiltedInputValue ($object = null, $keyName = null, $empty = 0) {

    $name = '<span class="text-danger">Not available</span>';
    if ($empty == 0) {
        if (isset($object->$keyName) && $object->$keyName != null) {
            $name = $object->$keyName;
        }
    }

    return $name;
}


function _t($text,$type='default'){
    return  str_replace(['&amp;','{{','}}'], ['&',' {!!',' !!}'], clean($text, $type));
}

function _tG($text,$type='default'){
    return  str_replace(['&amp;','{{','}}'], ['&',' {!!',' !!}'], clean(getTextTranslator($text), $type));
}

function getTextTranslator($text) {
    $translator_key = \Str::slug(str_replace("'", "", $text), '_');

    if(\Lang::has('message.'.$translator_key, app()->getLocale())) {
        return __('message.'.$translator_key);
    }

    return $text;
}

function setActive($path)
{
    if(!\Request::ajax()){
        return \Request::is($path . '*') ? 'active' :  '';
    }
}

function timeAgoFormate($date){
    date_default_timezone_set('Asia/Calcutta');
    $diff_time= \Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();

    return $diff_time;
}

/*Save media file*/

function storeMediaFile($model,$file,$name)
{
    if($file) {
        $model->clearMediaCollection($name);
        if (is_array($file)){
            foreach ($file as $key => $value){
                $model->addMedia($value)
                    ->toMediaCollection($name);
            }
        }else{
            $model->addMedia($file)
                ->toMediaCollection($name);
        }
    }

    return true;
}

function returnClass($key)
{
    $classname='warning';
    if($key%2) {
        $classname='success';
    }

    return $classname;
}
function stringLong($str = '', $type = 'title', $length = 0) //Add … if string is too long

{
    if ($length != 0) {
        return strlen($str) > $length ? substr($str, 0, $length) . "..." : $str;
    }
    if ($type == 'desc') {
        return strlen($str) > 150 ? substr($str, 0, 150) . "..." : $str;
    } elseif ($type == 'title') {
        return strlen($str) > 15 ? substr($str, 0, 25) . "..." : $str;
    } else {
        return $str;
    }

}

function checkRolePermission($role,$permission){
    try{
        if($role->hasPermissionTo($permission)){
            return true;
        }
        return false;
    }catch (Exception $e){
        return false;
    }
}

/* file exits check*/
function fileExitsCheck($defaultimg='', $path, $filename)
{
    $image= $defaultimg==''? asset('assets/img/icons/common/add.png'): $defaultimg;

    $imgurl= public_path($path.'/'.$filename);
    if ($filename != null && file_exists($imgurl)) {
        $isimgurl=URL::asset($path.'/'.$filename);
        $image=$isimgurl;
    }
    return $image;
}

function purifyInputData(&$request)
{
    $data=$request->all();
    array_walk_recursive($data, function(&$data) {
        $data = str_replace('&amp;', '&', clean($data));
    });
   $request->merge($data);

}

function checkMenuRoleAndPermission($menu) {
    if(\Auth::check()){
        if($menu->data('role') == null && auth()->user()->hasRole('admin')) {
            return true;
        }

        if($menu->data('permission') == null && $menu->data('role') == null) {
            return true;
        }


        if($menu->data('role') != null) {
            if(auth()->user()->hasAnyRole(explode(',', $menu->data('role')))) {
                return true;
            }
        }

        if($menu->data('permission') != null) {
            if(auth()->user()->can($menu->data('permission')) ) {
                return true;
            }
        }
    }

    return false;
}

function userGuardCheck() {
    $guards = array_keys(config('auth.guards'));

    foreach ($guards as $guard) {
        if(Auth::guard($guard)->check())
            return $guard;
    }

    return 'web';
}

function userDetails($model,$type){

    switch ($model->user_guard) {
        case 'web':
            return $model->user;
        case 'company':
                return $model->employee ?? $model->admin ;
        break;

        default:
            return $model->admin ?? $model->employee;
        break;
    }
}

function dataBaseRefresh(){
    $sql_dump = \File::get('sofdesk.sql');
    $status=  \DB::connection()->getPdo()->exec($sql_dump);
}

function defaultStatus($status){
    switch ($status){
        case 0:
            return '<span class="text-danger">De-active</span>';
            break;
        case 1:
            return '<span class="text-success">Active</span>';
            break;
        default:
            break;
    }
}

function sendEmailNotification($data){

    \Log::debug('INFO', ['NOTIFICATION' => 'Send QUEUE','data'=>(array)$data ]);

    $mailables = App\MailMailable::where('type',$data['template_type'])->with('mailTemplateMap')->get();

    if($mailables!=null){

        foreach ($mailables as $mailable) {

            if($mailable!=null && $mailable->to != null){
                foreach (json_decode($mailable->to) as $key => $mailTo) {
                    $data['mailableTemplate']=$mailable;

                    $ticket=isset($data['ticket'])?$data['ticket']:null;

                    if(isset($ticket) && $ticket != null){
                        $data['id']=$ticket->id;
                        $data['subject']=$ticket->subject;
                        $data['priority']=$ticket->priority;
                        $data['description']=$ticket->description;
                        $data['user']=$ticket->users->name;
                        $data['type']=$ticket->type;
                        $data['department']=$ticket->departments->department_name;
                        $data['link']=route('support.ticket.edit',['id'=>$ticket->id]);
                    }

                    switch ($mailTo) {
                        case 'admin':

                            $admin=\App\Admin::first();
                            if(isset($admin->email))
                                $admin->notify(new App\Notifications\CommonNotification($data['template_type'],$data));

                            break;

                        case 'department-leaders':

                            if(isset($data['data'])){
                                foreach ($data['data'] as $key => $leader) {
                                    if(isset($leader->employee->email)){
                                        $leader->employee->notify(new App\Notifications\CommonNotification($data['template_type'],$data));
                                    }
                                }
                            }

                            break;

                        case 'ticket-user':

                            if(isset($ticket) && $ticket != null){
                                $user=$ticket->users;
                                $user->notify(new App\Notifications\CommonNotification($data['template_type'],$data));
                            }
                            break;

                        case 'assigned-employee':

                            if(isset($data['assign_employee'])){

                                $data['assign_employee']->notify(new App\Notifications\CommonNotification('assign_ticket',$data));
                            }

                            break;

                        default:

                            Notification::route('mail', $mailTo)
                                ->notify(new \App\Notifications\CommonNotification($data['template_type'],$data));

                            break;
                    }
                }
            }
        }
    }

}

function getAttachments($attchments){
    $files=[];
    if(count($attchments) > 0){
        foreach($attchments as $attchment ){
            if (file_exists(isset($attchment)?$attchment->getPath():'')){
                array_push($files, $attchment->getFullUrl());
            }
        }
    }

    return $files;
}

function newTicket($ticketsList,$type = 'self'){

    $activity = $ticketsList;
    /*$open = $activity->newActivity()->where('status','open')->count() > 0;
    dd($activity->newActivity()->->where('status','open')->count());*/

    if ($type == 'self'){
        $activity = $ticketsList->myTickets()->with('activity')->get();
    }

    $new = newData();

    foreach ($activity as $key => $value){
        if(isset($value->activity)){
            if ($value->assigned_id == null){
                if($value->activity->created_at < $value->updated_at){
                    $new['request'] = true;
                }
            }
            if ($value->assigned_id != null) {
                if ($value->status == 'open') {
                    if (strtotime($value->activity->created_at) < strtotime($value->updated_at)) {
                        $new['open'] = true;
                    }
                }
            }
            if ($value->status == 'solved'){
                if(strtotime($value->activity->created_at) < strtotime($value->updated_at)){
                    $new['solved'] = true;
                }
            }
        }else{
            if ($value->assigned_id != null) {
                if ($value->status == 'open') {
                    $new['open'] = true;
                }
            }

            if ($value->status == 'solved'){
                $new['solved'] = true;
            }

            if ($value->assigned_id == null){
                $new['request'] = true;
            }
        }
    }

    return $new;

}

function newData(){
    return [
        'request' => false,
        'open' => false,
        'unassigned' => false,
        'my_ticket' => false,
        'solved' => false,
        'resent_updated' => false
    ];
}

?>
