<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('category_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('category_delete')) {
                return abort(401);
            }
            $categories = Category::onlyTrashed()->get();
        } else {
            $categories = Category::all();
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('category_create')) {
            return abort(401);
        }
        return view('admin.categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        if (! Gate::allows('category_create')) {
            return abort(401);
        }
        $category = Category::create($request->all());

        foreach ($request->input('articles', []) as $data) {
            $category->articles()->create($data);
        }


        return redirect()->route('admin.categories.index');
    }


    /**
     * Show the form for editing Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update Category in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $id)
    {
        if (! Gate::allows('category_edit')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->update($request->all());

        $articles           = $category->articles;
        $currentArticleData = [];
        foreach ($request->input('articles', []) as $index => $data) {
            if (is_integer($index)) {
                $category->articles()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentArticleData[$id] = $data;
            }
        }
        foreach ($articles as $item) {
            if (isset($currentArticleData[$item->id])) {
                $item->update($currentArticleData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.categories.index');
    }


    /**
     * Display Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('category_view')) {
            return abort(401);
        }
        $articles = \App\Article::where('categories_id', $id)->get();

        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category', 'articles'));
    }


    /**
     * Remove Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Delete all selected Category at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Category::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Permanently delete Category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.index');
    }
}
