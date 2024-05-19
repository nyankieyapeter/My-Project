<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
        return view('management.store.index', [
            'stores' => $stores,
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
            'extension' => 'required|min:2|max:10',
            'store_name' => 'required|string|min:2|max:10',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $store = new Store();
        $store->store_name = $request->input('store_name');
        $store->extension = $request->input('extension');
        $store->save();

        return redirect()->back()->with('success', 'The store has been updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $stor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $stor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $store, Store $stor)
    {
        $rules = [
            'extension' => 'required|min:2|max:10',
            'store_name' => 'required|string|min:2|max:10',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $st = Store::find($stor->id);
        $st->store_name = $request->input('store_name');
        $st->extension = $request->input('extension');
        $st->save();

        return redirect()->back()->with('success', 'The store has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($store, Store $stor)
    {
        $stor->delete();

        return redirect()->back()->with('success', 'Record has been deleted succesfully');

    }
}
