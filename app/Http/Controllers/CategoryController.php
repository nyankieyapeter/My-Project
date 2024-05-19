<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('store')->get();
        return view('inventory.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required|min:2|max:14',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();
        $category->name = $request->input('category_name');
        $category->store_id = $request->input('store_id');
        $category->save();

        return redirect()->back()->with('success', 'The category has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $store, Category $category)
    {
        $rules = [
            'category_name' => 'required|min:2|max:14',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categ = Category::find($category->id);
        $categ->name = $request->input('category_name');
        $categ->store_id = $request->input('store_id');
        $categ->save();

        return redirect()->back()->with('success', 'Record has been updated succesfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($store, Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Record has been deleted succesfully');
    }
}
