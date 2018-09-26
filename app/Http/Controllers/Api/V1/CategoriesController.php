<?php

namespace App\Http\Controllers\Api\V1;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        return $categories = Category::all();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    
    public function update(UpdateCategoriesRequest $request, $id)
    {
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

        return $category;
    }

    public function store(StoreCategoriesRequest $request)
    {
        $category = Category::create($request->all());
        
        foreach ($request->input('articles', []) as $data) {
            $category->articles()->create($data);
        }

        return $category;
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return '';
    }
}