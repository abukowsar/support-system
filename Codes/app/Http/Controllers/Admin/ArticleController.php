<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ArticleDataTable;
use App\Article;
use App\Http\Requests\ArticleRequest;
use App\AppSetting;

class ArticleController extends Controller
{   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function index(ArticleDataTable $dataTable)
    {
        
        $assets=['datatable'];
        
        $pageTitle= _t(__('message.lists',['name' => __('message.article')]));
        $button='<a href="'.route("articles.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.article')])).'</a>';

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

        $article    = Article::find($id);
        
        $pageTitle  =_t(__('message.edit',['name' => __('message.article')]));

        if($article==null){

            $pageTitle =_t(__('message.add',['name' => __('message.article')]));
            $article   = new Article;
        }

        $appSetting=AppSetting::getData();

        $button=route("articles.index");
      
        return view('admin.articles._form',compact('article','button','pageTitle','appSetting'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {   
        purifyInputData($request); 
        
        $data=$request->all();
        $data['user_id']=auth()->user()->id;

        $data['user_guard']=userGuardCheck();
        
        $article = Article::updateOrCreate(['id' => $request->id], $data);

        storeMediaFile($article,$request->article_image, 'article_image');
       
        $msg= _t(__('message.msg_updated',['name' => __('message.article')]));
        
        if($article->wasRecentlyCreated) { 

            $msg= _t(__('message.msg_added',['name' => __('message.article')]));
        }
        
        if($article){
            return redirect()->route('articles.index')->withSuccess($msg);
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
        $article = Article::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.article')]));
        
        if($article!='') { 
            $article->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.article')]));
        }

        return redirect()->back()->withSuccess($msg);
    }
}