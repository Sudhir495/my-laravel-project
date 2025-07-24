<!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Dashboard</title>
       @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
   <body class="bg-gray-100 font-sans antialiased">
       <div class="min-h-screen flex">
           <!-- Sidebar -->
           <div class="w-64 bg-gray-800 text-white p-4">
               <h2 class="text-2xl font-bold mb-6">SaaS App</h2>
               <nav>
                   <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                   <a href="{{ route('companies.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Companies</a>
                   <form method="POST" action="{{ route('logout') }}">
                       @csrf
                       <button type="submit" class="block w-full text-left py-2 px-4 rounded hover:bg-gray-700">Logout</button>
                   </form>
               </nav>
           </div>
           <!-- Main Content -->
           <div class="flex-1 p-6">
               <div class="max-w-4xl mx-auto">
                   <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->name }}</h1>
                   <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                       <h2 class="text-xl font-semibold">Current Company</h2>
                       @if(auth()->user()->currentCompany)
                           <p class="mt-2">Name: {{ auth()->user()->currentCompany->name }}</p>
                           <p>Industry: {{ auth()->user()->currentCompany->industry }}</p>
                           <p>Address: {{ auth()->user()->currentCompany->address }}</p>
                       @else
                           <p class="mt-2 text-red-500">No active company selected. <a href="{{ route('companies.index') }}" class="text-blue-500 underline">Manage companies</a></p>
                       @endif
                   </div>
                   <div class="bg-white shadow-md rounded-lg p-6">
                       <h2 class="text-xl font-semibold">Your Companies</h2>
                       <a href="{{ route('companies.create') }}" class="inline-block mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add New Company</a>
                   </div>
               </div>
           </div>
       </div>
   </body>
   </html>