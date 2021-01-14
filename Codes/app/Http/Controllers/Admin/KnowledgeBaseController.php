<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\KnowledgeDataTable;
use App\Knowledge;
use App\Http\Requests\KnowledgeRequest;

class KnowledgeBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KnowledgeDataTable $dataTable)
    {
        
        $assets=['datatable'];
        
        $pageTitle= _t(__('message.lists',['name' => __('message.knowledge')]));
        $button='<a href="'.route("knowledges.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.knowledge')])).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $id=$request->id;

        $knowledge    = Knowledge::find($id);
        
        $pageTitle  =_t(__('message.edit',['name' => __('message.knowledge')]));

        if($knowledge==null){

            $pageTitle =_t(__('message.add',['name' => __('message.knowledge')]));
            $knowledge   = new Knowledge;
        }

        $button=route("knowledges.index");
      
        return view('admin.knowledge._form',compact('knowledge','button','pageTitle'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeRequest $request)
    {   
        purifyInputData($request); 
        
        $data=$request->all();
        $data['user_id']=auth()->user()->id;

        $data['user_guard']=userGuardCheck();

        $knowledge = Knowledge::updateOrCreate(['id' => $request->id], $data);

        $msg= _t(__('message.msg_updated',['name' => __('message.knowledge')]));
        
        if($knowledge->wasRecentlyCreated) { 

            $msg= _t(__('message.msg_added',['name' => __('message.knowledge')]));
        }
        
        if($knowledge){
            return redirect()->route('knowledges.index')->withSuccess($msg);
        }
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $knowledge = Knowledge::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.knowledge')]));
        
        if($knowledge!='') { 
            $knowledge->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.knowledge')]));
        }

        return redirect()->back()->withSuccess($msg);
    }
}
