<?php

namespace App\Http\Controllers\Api\V1;

use App\Video;
use App\Article;
use App\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticlesRequest;
use App\Http\Requests\Admin\UpdateArticlesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ArticlesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $listvideo= Video::orderBy('created_at', 'DESC')->get();

        $reqs = Article::orderBy('created_at', 'DESC')->get();

        $artcom = Article::join('commentaires', 'articles.id', '=', 'commentaires.article_id')
        ->selectRaw('articles.id ,articles.titre ,articles.image ,articles.publier ,articles.updated_at ,count(commentaires.article_id) as comCount')
        ->groupBy('articles.id')
        ->orderBy('comCount', 'DESC')
        ->get();

        $artcomv = Article::join('commentaires', 'articles.id', '=', 'commentaires.article_id')
        ->selectRaw('articles.id ,articles.titre ,articles.image ,articles.publier ,count(commentaires.article_id) as comCount')
        ->where('commentaires.valider', '=', 1)
        ->groupBy('articles.id')
        ->orderBy('comCount', 'DESC')
        ->get();

        foreach($reqs as $key => $req){
             $reqs[$key] -> contenue = str_limit($req -> contenue, 130); 
        }

        $articles = $reqs;

        return view('afrique.index', compact('articles','listvideo','artcom','artcomv'));
    }

   

    public function categorieIndex($categorie){
        $reqs = Article::orderBy('created_at', 'DESC')->where('categories_id', '=', $categorie)->get();

        $allreqs = Article::orderBy('created_at', 'DESC')->get();

        $artcom = Article::join('commentaires', 'articles.id', '=', 'commentaires.article_id')
        ->selectRaw('articles.id ,articles.titre ,articles.image ,articles.publier ,articles.updated_at ,count(commentaires.article_id) as comCount')
        ->groupBy('articles.id')
        ->orderBy('comCount', 'DESC')
        ->get();

        $artcomv = Article::join('commentaires', 'articles.id', '=', 'commentaires.article_id')
        ->selectRaw('articles.id ,articles.titre ,articles.image ,articles.publier ,count(commentaires.article_id) as comCount')
        ->where('commentaires.valider', '=', 1)
        ->groupBy('articles.id')
        ->orderBy('comCount', 'DESC')
        ->get();

        foreach($reqs as $key => $req){
            $reqs[$key] -> contenue = str_limit($req -> contenue, 130); 
       }
       foreach($allreqs as $key => $allreq){
        $allreqs[$key] -> contenue = str_limit($allreq -> contenue, 130); 
        }
       $allarticles = $allreqs;
       $articles = $reqs;
        return view('afrique.categorie', compact('articles','allarticles','artcom','artcomv'));
    }

    public function show($id)
    {
        $article= Article::findOrFail($id);

        $commentaires = Commentaire::orderBy('created_at', 'DESC')->where('article_id', '=', $id)->get();

        $allreqs = Article::orderBy('created_at', 'DESC')->get();

        $artcom = Article::join('commentaires', 'articles.id', '=', 'commentaires.article_id')
        ->selectRaw('articles.id ,articles.titre ,articles.image ,articles.publier ,articles.updated_at ,count(commentaires.article_id) as comCount')
        ->groupBy('articles.id')
        ->orderBy('comCount', 'DESC')
        ->get();

        $artcomv = Article::join('commentaires', 'articles.id', '=', 'commentaires.article_id')
        ->selectRaw('articles.id ,articles.titre ,articles.image ,articles.publier ,count(commentaires.article_id) as comCount')
        ->where('commentaires.valider', '=', 1)
        ->groupBy('articles.id')
        ->orderBy('comCount', 'DESC')
        ->get();

        foreach($allreqs as $key => $allreq){
            $allreqs[$key] -> contenue = str_limit($allreq -> contenue, 130); 
        }
        $allarticles = $allreqs;
        
        return view('afrique.article', compact('article','allarticles','commentaires','artcom','artcomv'));
    }

    

    //recherche
    public function cherche(Request $request){
        $result = $request->input('recherche');
        $reqs = Article::where('titre','LIKE','%'.$result.'%')->get();
        foreach($reqs as $key => $req){
            $reqs[$key] -> contenue = str_limit($req -> contenue, 130); 
        }
        $articles = $reqs;
        return view('afrique.recherche', compact('articles','result'));
    }

    public function update(UpdateArticlesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $article = Article::findOrFail($id);
        $article->update($request->all());
        

        return $article;
    }

    public function store(StoreArticlesRequest $request)
    {
        $request = $this->saveFiles($request);
        $article = Article::create($request->all());
        

        return $article;
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return '';
    }
}
