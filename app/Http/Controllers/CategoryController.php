<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.list', compact(Category::all()));
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        Category::create($request->all());
        return redirect('/categories');
    }

    public function edit(Category $category)
    {
        return view("categories.edit", ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
        ]);
        $category->update($request->all());
        return redirect('/categories');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return back();
    }
}
