<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::OrderBy('created_at', 'DESC')-> paginate()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //get validated data
        $validated = $request->validated();

        //create the slug
        $validated['slug'] = \Str::slug($validated['title']);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('flash.banner', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit',[
            'category' => $category,
            ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {


        //get validated data
        $validated = $request->validated();

        //create the slug
        $validated['slug'] = \Str::slug($validated['title']);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('flash.banner', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $model = $category;
        $category->delete();

        //set the banner status to danger
        session()->flash('flash.bannerStyle', 'danger');
        return redirect()->route('categories.index')
            ->with('flash.banner', ' Category ' . $model->title . '  deleted successfully');

    }
}
