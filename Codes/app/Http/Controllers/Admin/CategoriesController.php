<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use App\StaticData;
use App\Categories;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        
        $assets=['datatable'];
        $pageTitle=_t(__('message.lists',['name' => __('message.categories')]));
        $button='<a href="'.route("categories.create").'" class="float-right btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> '._t(__('message.add',['name' => __('message.category')])).'</a>';

        return $dataTable->render('global.datatable', compact('assets','pageTitle','button'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $category       = Categories::find($request->id);
        $pageTitle      =_t(__('message.edit',['name' => __('message.category')]));

        if($category    == null){
            $pageTitle  =_t(__('message.add',['name' => __('message.category')]));
            $category   = new Categories;
        }

        $category_type = StaticData::where('type','category_type')->orderBy('sequence', 'ASC')->get();

        $button = route("categories.index");
      
        return view('admin.categories._form',compact('category_type','category','button','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {   
        purifyInputData($request);

        $category = Categories::updateOrCreate(['id' => $request->id], $request->all());

        $msg= _t(__('message.msg_updated',['name' => __('message.category')]));
        
        if($category->wasRecentlyCreated) { 

            $msg= _t(__('message.msg_added',['name' => __('message.category')]));
        }
        
        if($category){
            return redirect()->route('categories.index')->withSuccess($msg);
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
        $category = Categories::find($id);
        $msg= _t(__('message.msg_fail_to_delete',['item' => __('message.category')]));
        
        if($category!='') { 
        
            $category->delete();
            $msg= _t(__('message.msg_deleted',['name' => __('message.category')]));
        }

        return redirect()->back()->withSuccess($msg);
    }

}
