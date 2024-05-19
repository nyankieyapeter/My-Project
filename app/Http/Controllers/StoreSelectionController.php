<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreSelectionController extends Controller
{
    public function storeselection() {
        return view('selection.storeselection');
    }

    public function processstoreselection(Request $request) {

        $option = $request->input('option');

        // Store the selected store in the logged-in user's session
        session(['selected_store' => $option]);


        if ($option == 'cafa') {
            return redirect()->route('home', ['store' => session('selected_store')]);
        }elseif ($option == 'cafb') {
            return redirect()->route('home', ['store' => session('selected_store')]);
        }
    }

}
