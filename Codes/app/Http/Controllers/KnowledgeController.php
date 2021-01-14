<?php

namespace App\Http\Controllers;

use App\Knowledge;
use App\Categories;
use App\Ticket;
use Illuminate\Http\Request;

use Artesaos\SEOTools\Facades\SEOTools;

class KnowledgeController extends Controller
{
    public function index(Request $request) 
    {
        $articleCategory=Categories::whereHas('knowledge')->with('knowledge')->get();
        $tickets=Ticket::Priority()->where('ticket_show_by','public')->limit(5)->orderBy('id','DESC')->get();

        return view('knowledge.index',compact('tickets','articleCategory'));
    }

    public function knowledgeCategoryList(Request $request)
    {
        $knowledgeCategory=Categories::whereHas('knowledge');

        if($request->keywords){
            $knowledgeCategory->where('category_name', 'LIKE', $request->keywords.'%');
        }

        $knowledgeCategory=$knowledgeCategory->simplePaginate(\Config::get('constant.PAGINATION.SEARCH'));

        $returnHTML = view('knowledge.list', compact('knowledgeCategory'))->render();

        return response()->json(array(
            'status'    => true,
            'html'      => (count($knowledgeCategory) > 0 ? $returnHTML : ''),
            'counts'    => $knowledgeCategory->count(),
            'is_more'   => $knowledgeCategory->hasMorePages()
        ));
    }

    public function knowledgebaseListing(Request $request,$category) 
    {

        $categoryItem=Categories::where('slug',$category)->first();

        $articleCategory=Categories::whereHas('knowledge')->with('knowledge')->get();
        $tickets=Ticket::Priority()->where('ticket_show_by','public')->limit(5)->orderBy('id','DESC')->get();

        return view('knowledge.category-knowledge-list',compact('tickets','articleCategory','category','categoryItem'));
    }


    public function knowledgebaseAjaxList(Request $request)
    {   
        $category=Categories::where('slug',$request->category)->first();

        $knowledgebase=Knowledge::with('employee')->list()->where('category_id',$category->id);

        if($request->keywords){
            $knowledgebase->where('title', 'LIKE', $request->keywords.'%');
        }

        $knowledgebase=$knowledgebase->simplePaginate(\Config::get('constant.PAGINATION.SEARCH'));

        $returnHTML = view('knowledge.knowledge-list', compact('knowledgebase'))->render();

        return response()->json(array(
            'status'    => true,
            'html'      => (count($knowledgebase) > 0 ? $returnHTML : ''),
            'counts'    => $knowledgebase->count(),
            'is_more'   => $knowledgebase->hasMorePages()
        ));
    }

    public function knowledgebaseDetails(Request $request, $slug)
    {
        $assets = ['readmore'];

        $categories=Categories::whereHas('article')->with('article')->get();

        $recentKnowledge = Knowledge::where('status', 1)->orderBy('id','DESC')->take(5)->get();

        $tickets=Ticket::Priority()->where('ticket_show_by','public')->limit(5)->orderBy('id','DESC')->get();

    	$knowledge = Knowledge::with(['employee','category'])->where('slug', $slug)->first();

        $knowledge->increment('views', 1);

        SEOTools::setTitle($knowledge->title);
        SEOTools::setDescription(stringLong($knowledge->content,'desc'));
        SEOTools::opengraph()->setUrl(route('knowledge.details',['slug'=>$knowledge->slug]));
        SEOTools::setCanonical(route('knowledge.details',['slug'=>$knowledge->slug]));
        SEOTools::opengraph()->addProperty('type', 'Knowledge Base');

    	return  view('knowledge.details', compact('knowledge','recentKnowledge','tickets','categories','assets'));
    }

}
