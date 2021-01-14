<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MailTemplateDataTable;
use App\MailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MailTemplateDataTable $dataTable
     * @return void
     */
    public function index(MailTemplateDataTable $dataTable)
    {

        $assets=['datatable'];
        $pageTitle=_t(__('message.lists',['name' => __('message.template')]));
        $button='<a href="'.route("mail.template.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.template')])).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentTitle = _t(__('message.mail'));

        $pageTitle =_t(__('message.add',['name' => __('message.template')]));

        $template = new MailTemplate();

        $assets = ['textarea'];

        return view('admin.mail.template.create',compact('pageTitle','parentTitle','template','assets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['name'] = str_replace(' ','-',$request->label);

        $template = MailTemplate::create($request->all());

        $message= _t(__('message.msg_added',['name' => __('message.template')]));

        return redirect()->route('mail.template.index')->with('success',$message);
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

        $pageTitle  =_t(__('message.edit',['name' => __('message.template')]));

        $template = MailTemplate::find($id);

        $assets = ['textarea'];

        return view('admin.mail.template.edit',compact('pageTitle','parentTitle','template','assets'));
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
        $template = MailTemplate::find($id);

        $template->fill($request->all())->save();

        $message= _t(__('message.msg_updated',['name' => __('message.template')]));

        return redirect()->route('mail.template.index')->with('success',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = MailTemplate::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.template')]));
        
        if($template!='') { 
            $template->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.template')]));
        }

        return redirect()->back()->withSuccess($msg);
    }
}
