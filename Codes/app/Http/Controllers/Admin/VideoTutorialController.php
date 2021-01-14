<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\VideosDataTable;
use App\Videos;
use App\Http\Requests\VideosRequest;


class VideoTutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VideosDataTable $dataTable)
    {
        
        $assets=['datatable'];
        
        $pageTitle= _t(__('message.lists',['name' => __('message.video')]));
        $button='<a href="'.route("videos.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.video')])).'</a>';

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

        $video    = Videos::find($id);
        
        $pageTitle  =_t(__('message.edit',['name' => __('message.video')]));

        if($video==null){

            $pageTitle =_t(__('message.add',['name' => __('message.video')]));
            $video   = new Videos;
        }

        $button=route("videos.index");
      
        return view('admin.videos._form',compact('video','button','pageTitle'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideosRequest $request)
    {   
        purifyInputData($request); 
        
        $data=$request->all();
        $data['user_id']=auth()->user()->id;

        $data['user_guard']=userGuardCheck();

        $video = Videos::updateOrCreate(['id' => $request->id], $data);

        storeMediaFile($video,$request->videos, 'videos');

        $msg= _t(__('message.msg_updated',['name' => __('message.video')]));
        
        if($video->wasRecentlyCreated) { 

            $msg= _t(__('message.msg_added',['name' => __('message.video')]));
        }
        
        if($video){
            return redirect()->route('videos.index')->withSuccess($msg);
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
        $video = Videos::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.video')]));
        
        if($video!='') { 
            $video->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.video')]));
        }

        return redirect()->back()->withSuccess($msg);
    }
}
