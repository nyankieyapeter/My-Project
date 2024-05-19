<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class redirectBasedOnSelectedStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $selectedStore = session('selected_store');
        // Get the first segment of the URL (e.g., 'public' or 'private')
        $requestedStore = $request->segment(1);


        if (!session()->has('selected_store')) {
            // Redirect the user to the store selection page
            return redirect()->route('store.selection');
        }

        if ($selectedStore !== $requestedStore) {
            // Redirect the user to the selected store
            return redirect()->route('home', ['store' => session('selected_store')]);
        }

        return $next($request);
    }
}
