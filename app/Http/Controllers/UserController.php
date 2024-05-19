<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth()->user()->hasRole('admin|Super Admin')) {
            $users = User::whereNotNull('store_id')->get();

        }else {

            $selectedStore = session('selected_store');

            $storeMapping = [
                'cafa' => 'GATAKA SUPERMARKET',
                'cafb' => 'Canteen B',
            ];

            // Check if the selected store exists in the mapping
            if (array_key_exists($selectedStore, $storeMapping)) {
                // Get the corresponding store name
                $storeName = $storeMapping[$selectedStore];

                // Retrieve users for the selected cafe
                $users = User::where('store_id', function ($query) use ($storeName) {
                    $query->select('id')
                        ->from('stores')
                        ->where('store_name', $storeName);
                })
                ->whereNotNull('store_id')
                ->get();
            }
        }

        return view('management.user.index', [
            'users' => $users,
        ]) ;
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
    public function store($user, UserRequest $request)
    {

        $user = new User();
        $user->store_id = $request->input('store_id');
        $user->name = $request->input('user_name');
        $user->username = $request->input('username');
        $user->email = $request->input('user_email');
        $user->password = Hash::make($request->input('user_password'));
        $user->assignRole($request->input('user_role'));

        $user->save();

        return redirect()->back()->with('success', 'The user has been created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $store, User $user)
    {
        $us = User::find($user->id);
        $us->store_id = $request->input('store_id');
        $us->name = $request->input('user_name');
        $us->username = $request->input('username');
        $us->email = $request->input('user_email');
        $us->syncRoles($request->input('user_role'));
        if ($request->filled('user_password')) {
            // Hash and update the new password if it's provided
            $us->password = Hash::make($request->input('user_password'));
        }
        $us->save();

        return redirect()->back()->with('success', 'The user details have been updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($store, User $user)
    {

        $user->delete();

        return redirect()->back()->with('success', 'Record has been deleted succesfully');
    }
}
