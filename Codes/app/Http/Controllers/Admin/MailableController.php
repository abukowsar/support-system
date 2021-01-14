<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MailableDataTable;
use App\MailMailable;
use App\MailTemplate;
use App\MailTemplateMailableMapping;
// use App\Notifications\Mailable;
use App\StaticData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;

class MailableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MailableDataTable $dataTable
     * @param Request $request
     * @return void
     */
    public function index(MailableDataTable $dataTable)
    {
        $assets=['datatable'];

        $button='<a href="'.route("mail.mailable.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.template')])).'</a>';

        $pageTitle= _t(__('message.lists',['name' => __('message.mailable')]));

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pageTitle =_t(__('message.add',['name' => __('message.mailable')]));

        $mailable = new MailMailable();

        $assets = ['textarea'];

        return view('admin.mail.mailable.create',compact('pageTitle','assets','mailable'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request['to']=isset($request->to) ? json_encode($request->to):null;
        $request['bcc']=isset($request->bcc)?json_encode($request->bcc):null;
        $request['cc']=isset($request->cc)?json_encode($request->cc):null;

        $mailable = MailMailable::create($request->all());

        foreach($request->language as $key => $value){
            $temp = [
                'mailable_id' => $mailable->id,
                'template_id' => $request->template_id,
                'template_detail' => $request->template_detail[$value],
                'notification_message' => $request->notification_message[$value],
                'notification_link' => $request->notification_link[$value],
                'subject' => $request->subject[$value],
                'language' =>$value
            ];

            $template = $this->mailTemplateDetailStore($temp);

        }

        $message= _t(__('message.msg_added',['name' => __('message.mailable')]));

        return redirect()->route('mail.mailable.index')->with('success',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentTitle = _t(__('message.mail'));

        $pageTitle  =_t(__('message.edit',['name' => __('message.mailable')]));

        $mailable = MailMailable::find($id);

        $template = $mailable->mailTemplateMap()->first();

        $mailable['template_id'] = $template->template->id;

        $mailable['template_label'] = $template->template->label;

        $temp = [];

        foreach ($mailable->mailTemplateMap as $key => $value){
            $temp[$value->language] = $value->template_detail;
        }

        $mailable['template_detail'] = $temp;

        $buttonTypes = StaticData::where('type','mail_button')
        ->where(function($query) use($mailable){
            $query->where('sub_type' , $mailable->type)->orWhere('sub_type', null);
        })->get();

        $assets = ['textarea'];

        return view('admin.mail.mailable.edit',compact('pageTitle','parentTitle','mailable','assets','buttonTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mailable = MailMailable::where('id',$id)->with('mailTemplateMap')->first();
        $request['to']=isset($request->to) ? json_encode($request->to):null;
        $request['bcc']=isset($request->bcc)?json_encode($request->bcc):null;
        $request['cc']=isset($request->cc)?json_encode($request->cc):null;

        $mailable->fill($request->all())->save();
        foreach($request->language as $key => $value){
            $temp = [
                'mailable_id' => $mailable->id,
                'template_id' => $request->template_id,
                'template_detail' => $request->template_detail[$value],
                'notification_message' => $request->notification_message[$value],
                'notification_link' => $request->notification_link[$value],
                'subject' => $request->subject[$value],
                'language' =>$value
            ];
            $template = $this->mailTemplateDetailStore($temp);
        }

        $message= _t(__('message.msg_updated',['name' => __('message.mailable')]));

        return redirect()->route('mail.mailable.index')->with('success',$message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mailable = MailMailable::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.mailable')]));

        if($mailable!='') {
            $mailable->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.mailable')]));
        }

        return redirect()->back()->withSuccess($msg);
    }

    public function mailButton(Request $request){
        $buttonTypes = StaticData::where('type','mail_button')
        ->where(function($query) use($request){
            $query->where('sub_type' , $request->type)->orWhere('sub_type', null);
        })->get();
        $view = view('admin.mail.mailable.button',compact('buttonTypes'))->render();
        return response()->json(['data' => $view,'status' => true]);
    }

    public function mailTemplate(Request $request){

        $detail = MailTemplateMailableMapping::where(['template_id'=>$request->template_id,'mailable_id' => $request->mailable_id,'language' => $request->language])->first();
        if(!isset($type)){
            $detail = MailTemplate::find($request->template_id);
        }
        return response()->json(['data' => $detail,'status' => true]);
    }

    protected function mailTemplateDetailStore(array $data){

        MailTemplateMailableMapping::where(['mailable_id' => $data['mailable_id']])->update(['status' => 0]);

        $mapping = MailTemplateMailableMapping::where(['mailable_id' => $data['mailable_id'], 'template_id' => $data['template_id'],'language' => $data['language']])->first();

        MailTemplateMailableMapping::where(['mailable_id' => $data['mailable_id'],'template_id' => $data['template_id']])->update(['status' => 1]);

        if(isset($mapping)){
            $mapping->fill($data)->save();
        }else{
            $data['status'] = 1;
            $mapping = MailTemplateMailableMapping::create($data);
        }

        return $mapping;
    }
}
