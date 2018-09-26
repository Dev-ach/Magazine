<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticlesRequest;
use App\Http\Requests\Admin\UpdateArticlesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class ArticlesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('article_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('article_delete')) {
                return abort(401);
            }
            $reqs = Article::onlyTrashed()->get();
            foreach($reqs as $key => $req){
                 $reqs[$key] -> contenue = str_limit($req -> contenue, 150); 
            }
            $articles = $reqs;
        }
        elseif(! Gate::allows('article')){
                $reqs = Article::all();
                foreach($reqs as $key => $req){
                     $reqs[$key] -> contenue = str_limit($req -> contenue, 150); 
                }
                $articles = $reqs;
        }
        else {
            $articles = Article::all();
        }

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating new Article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('article_create')) {
            return abort(401);
        }
        
        $categories = \App\Category::get()->pluck('categorie', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $tag_ids = \App\Tag::get()->pluck('tag', 'id');

        $redacteurs = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.articles.create', compact('categories', 'tag_ids', 'redacteurs'));
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param  \App\Http\Requests\StoreArticlesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticlesRequest $request)
    {
        if (! Gate::allows('article_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $article = Article::create($request->all());
        $article->tag_id()->sync(array_filter((array)$request->input('tag_id')));



        return redirect()->route('admin.articles.index');
    }


    /**
     * Show the form for editing Article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('article_edit')) {
            return abort(401);
        }
        
        $categories = \App\Category::get()->pluck('categorie', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $tag_ids = \App\Tag::get()->pluck('tag', 'id');

        $redacteurs = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $article = Article::findOrFail($id);

        return view('admin.articles.edit', compact('article', 'categories', 'tag_ids', 'redacteurs'));
    }

    /**
     * Update Article in storage.
     *
     * @param  \App\Http\Requests\UpdateArticlesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticlesRequest $request, $id)
    {
        if (! Gate::allows('article_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $article = Article::findOrFail($id);
        $article->update($request->all());
        $article->tag_id()->sync(array_filter((array)$request->input('tag_id')));



        return redirect()->route('admin.articles.index');
    }


    /**
     * Display Article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('article_view')) {
            return abort(401);
        }
        
        $categories = \App\Category::get()->pluck('categorie', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $tag_ids = \App\Tag::get()->pluck('tag', 'id');

        $redacteurs = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$commentaires = \App\Commentaire::where('article_id', $id)->get();

        $article = Article::findOrFail($id);

        return view('admin.articles.show', compact('article', 'commentaires'));
    }


    /**
     * Remove Article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index');
    }

    /**
     * Delete all selected Article at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Article::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();

        return redirect()->route('admin.articles.index');
    }

    /**
     * Permanently delete Article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('article_delete')) {
            return abort(401);
        }
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->forceDelete();

        return redirect()->route('admin.articles.index');
    }
}
