<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\IndexCategoryRequest;
use App\Http\Requests\Category\ShowCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexCategoryRequest $request)
    {
        return Category::query()
            ->with($request->input('with', []))
            ->search($request->input('query'))
            ->orderBy($request->input('sort', 'name'), $request->input('order', 'asc'))
            ->simplePaginate($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::query()->create([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCategoryRequest $request, Category $category)
    {
        return $category->load($request->input('with', []));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
