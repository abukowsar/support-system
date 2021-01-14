<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Http\Requests\FaqRequest;
use App\DataTables\FaqDataTable;
use Illuminate\Http\Request;
use App\Pages;
use App\Faq;
use App\DataTables\PagesDataTable;
use App\StaticData;

class PageController extends Controller
{   
    public function index(PagesDataTable $dataTable)
    {
        $assets=['datatable'];
        
        $pageTitle= _t(__('message.lists',['name' => __('message.page')]));
        $button='<a href="'.route("pages.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.page')])).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    public function create(Request $request)
    {
        $id=$request->id;

        $page    = Pages::find($id);
        
        $pageTitle  =_t(__('message.edit',['name' => __('message.page')]));

        if($page==null){

            $pageTitle =_t(__('message.add',['name' => __('message.page')]));
            $page   = new Pages;
        }

        $button=route("pages.index");
        
        return view('admin.pages._form',compact('page','button','pageTitle'));
    }

    public function store(PageRequest $request)
    {   
        purifyInputData($request);

        $package = Pages::updateOrCreate(['id' => $request->id], $request->all());

        $msg= _t(__('message.msg_updated',['name' => __('message.page')]));
        
        if($package->wasRecentlyCreated) { 
            $msg= _t(__('message.msg_added',['name' => __('message.page')]));
        }

        return redirect()->route('pages.index')->withSuccess($msg);
    }

    public function destroy($id)
    {
        $article = Pages::findOrFail($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.page')]));
        
        if($article!='') { 
            $article->delete();

            $msg= _t(__('message.msg_deleted',['name' => __('message.page')]));
        }

        return redirect()->back()->withSuccess($msg);
    }

    public function faq(Request $request, FaqDataTable $dataTable){

        $assets     = ['datatable'];

        $pageTitle  =_t(__('message.lists',['name' => __('message.faq')]));

        $button ='<a href="'.route("faq.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.faq')])).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    public function faqCreate(Request $request){

        $id=$request->id;

        $faq = Faq::where('id',$id)->first();

        $pageTitle= _t(__('message.edit',['name' => __('message.faq')]));

        if($faq==null){
            $pageTitle  = _t(__('message.add',['name' => __('message.faq')]));
            $faq        = new Faq;
        }

        $button=route('faq.index');

        return view('admin.faq._form',compact('faq','pageTitle','button'));
    }

    public function faqStore(FaqRequest $request)
    {   
        purifyInputData($request);
        
        $faq = Faq::updateOrCreate(['id' => $request->id], $request->all());

        $msg= _t(__('message.msg_updated',['name' => __('message.faq')]));
        
        if($faq->wasRecentlyCreated) { 

            $msg= _t(__('message.msg_added',['name' => __('message.faq')]));
        }

        return redirect()->route('faq.index')->withSuccess($msg);
    }

    public function faqDestroy($id)
    {
        $faq= Faq::findOrFail($id);

        if (empty($faq)) {
            return redirect(route('faq.index'))->withErrors([_t(__('message.not_found_entry',['form' => __('message.faq')]))]);
        }

        $faq->delete();

        return redirect()->route('faq.index')->withSuccess(_t(__('message.msg_deleted',['name' => __('message.faq')])));
        
    }
}
