<?php

namespace App\Http\Controllers;

use App\Article;
use App\Categories;
use App\Ticket;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class ArticleController extends Controller
{
    public function index(Request $request,$slug='') 
    {
        $keywords=$request->keywords;

        $category=Categories::where('slug',$slug)->value('id');

        $articleCategory=Categories::whereHas('article')->with('article')->get();

        $tickets=Ticket::Priority()->where('ticket_show_by','public')->limit(5)->orderBy('id','DESC')->get();

        return view('article.index',compact('articleCategory','tickets','keywords','category'));
    }

    public function articleList(Request $request)
    {   
        $articles=Article::list()->with(['user','category']);

        if($request->keywords){
            $articles->where('title', 'LIKE', $request->keywords.'%');
        }
        if($request->category){
            $articles->where('category_id',$request->category);
        }

        $articles=$articles->simplePaginate(\Config::get('constant.PAGINATION.SEARCH'));

        $returnHTML = view('article.list', compact('articles'))->render();

        return response()->json(array(
            'status'    => true,
            'html'      => (count($articles) > 0 ? $returnHTML : ''),
            'counts'    => $articles->count(),
            'is_more'   => $articles->hasMorePages()
        ));
    }

    public function articleDetails(Request $request, $slug)
    {
        $assets = ['readmore'];
        $article = Article::with(['user','category'])->where('slug', $slug)->first();

        if($article == null){
             return redirect()->back()->withErrors(_t(__('message.no_query_results_found')));
        }

        $articleCategory=Categories::whereHas('article')->with('article')->get();

        $recentArticle = Article::where('status', 1)->orderBy('id','DESC')->take(5)->get();

        $tickets=Ticket::Priority()->where('ticket_show_by','public')->limit(5)->orderBy('id','DESC')->get();

        $article->increment('views', 1);

        SEOTools::setTitle($article->title);
        SEOTools::setDescription(stringLong($article->content,'desc'));
        SEOTools::opengraph()->setUrl(route('article.details',['slug'=>$article->slug]));
        SEOTools::setCanonical(route('article.details',['slug'=>$article->slug]));
        SEOTools::opengraph()->addProperty('type', 'Article');
        SEOTools::jsonLd()->addImage(getSingleMedia($article->firstImage, 'article_image'));


        return  view('article.details', compact('article','recentArticle','tickets','articleCategory','assets'));
    }

}
