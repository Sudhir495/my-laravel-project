<?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Symfony\Component\HttpFoundation\Response;

   class EnsureCompanyIsSet
   {
       public function handle(Request $request, Closure $next): Response
       {
           $user = auth()->user();

           if ($user && !$user->current_company_id) {
               if ($request->expectsJson()) {
                   return response()->json(['error' => 'No active company selected'], 403);
               }
               return redirect()->route('companies.index')->with('error', 'Please select an active company.');
           }

           return $next($request);
       }
   }