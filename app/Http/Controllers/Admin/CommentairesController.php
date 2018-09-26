<?php

namespace App\Http\Controllers\Admin;

use App\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentairesRequest;
use App\Http\Requests\Admin\UpdateCommentairesRequest;

class CommentairesController extends Controller
{
    /**
     * Display a listing of Commentaire.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('commentaire_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('commentaire_delete')) {
                return abort(401);
            }
            $commentaires = Commentaire::onlyTrashed()->get();
        } else {
            $commentaires = Commentaire::all();
        }

        return view('admin.commentaires.index', compact('commentaires'));
    }

    /**
     * Show the form for creating new Commentaire.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('commentaire_create')) {
            return abort(401);
        }
        
        $articles = \App\Article::get()->pluck('titre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.commentaires.create', compact('articles'));
    }

    /**
     * Store a newly created Commentaire in storage.
     *
     * @param  \App\Http\Requests\StoreCommentairesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentairesRequest $request)
    {
        if (! Gate::allows('commentaire_create')) {
            return abort(401);
        }
        $commentaire = Commentaire::create($request->all());



        return redirect()->route('admin.commentaires.index');
    }


    /**
     * Show the form for editing Commentaire.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('commentaire_edit')) {
            return abort(401);
        }
        
        $articles = \App\Article::get()->pluck('titre', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $commentaire = Commentaire::findOrFail($id);

        return view('admin.commentaires.edit', compact('commentaire', 'articles'));
    }

    /**
     * Update Commentaire in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentairesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentairesRequest $request, $id)
    {
        if (! Gate::allows('commentaire_edit')) {
            return abort(401);
        }
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update($request->all());



        return redirect()->route('admin.commentaires.index');
    }


    /**
     * Display Commentaire.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('commentaire_view')) {
            return abort(401);
        }
        $commentaire = Commentaire::findOrFail($id);

        return view('admin.commentaires.show', compact('commentaire'));
    }


    /**
     * Remove Commentaire from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('commentaire_delete')) {
            return abort(401);
        }
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();

        return redirect()->route('admin.commentaires.index');
    }

    /**
     * Delete all selected Commentaire at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('commentaire_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Commentaire::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Commentaire from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('commentaire_delete')) {
            return abort(401);
        }
        $commentaire = Commentaire::onlyTrashed()->findOrFail($id);
        $commentaire->restore();

        return redirect()->route('admin.commentaires.index');
    }

    /**
     * Permanently delete Commentaire from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('commentaire_delete')) {
            return abort(401);
        }
        $commentaire = Commentaire::onlyTrashed()->findOrFail($id);
        $commentaire->forceDelete();

        return redirect()->route('admin.commentaires.index');
    }
}
