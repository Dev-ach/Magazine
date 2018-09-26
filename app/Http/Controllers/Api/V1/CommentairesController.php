<?php

namespace App\Http\Controllers\Api\V1;

use App\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentairesRequest;
use App\Http\Requests\Admin\UpdateCommentairesRequest;

class CommentairesController extends Controller
{
    public function index()
    {
        return Commentaire::all();
    }

    public function show($id)
    {
        return Commentaire::findOrFail($id);
    }

    public function update(UpdateCommentairesRequest $request, $id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update($request->all());
        

        return $commentaire;
    }

    public function store(StoreCommentairesRequest $request)
    {
        $commentaire = new Commentaire;
        $commentaire->pseudo = $request->input('pseudo'); 
        $commentaire->email = $request->input('email'); 
        $commentaire->commentaire =$request->input('commentaire'); 
        $commentaire->article_id = $request->input('article_id');
        $commentaire->valider = 0;
        $commentaire->save();
        return redirect('article/'.$commentaire->article_id.'');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();
        return '';
    }
}
