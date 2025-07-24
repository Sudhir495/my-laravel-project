<!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Create Company</title>
       @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
   <body class="bg-gray-100 font-sans antialiased">
       <div class="min-h-screen flex">
           <!-- Sidebar -->
           <div class="w-64 bg-gray-800 text-white p-4">
               <h2 class="text-2xl font-bold mb-6">SaaS App</h2>
               <nav>
                   <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                   <a href="{{ route('companies.index') }}" class="block py-2 px-4 rounded bg-gray-700">Companies</a>
                   <form method="POST" action="{{ route('logout') }}">
                       @csrf
                       <button type="submit" class="block w-full text-left py-2 px-4 rounded hover:bg-gray-700">Logout</button>
                   </form>
               </nav>
           </div>
           <!-- Main Content -->
           <div class="flex-1 p-6">
               <div class="max-w-lg mx-auto">
                   <h1 class="text-3xl font-bold mb-6">Create New Company</h1>
                   <form method="POST" action="{{ route('companies.store') }}" class="bg-white shadow-md rounded-lg p-6">
                       @csrf
                       <div class="mb-4">
                           <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                           <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('name') border-red-500 @enderror">
                           @error('name')
                               <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="mb-4">
                           <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                           <input type="text" name="industry" id="industry" value="{{ old('industry') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('industry') border-red-500 @enderror">
                           @error('industry')
                               <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="mb-4">
                           <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                           <input type="text" name="address" id="address" value="{{ old('address') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 @error('address') border-red-500 @enderror">
                           @error('address')
                               <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                           @enderror
                       </div>
                       <div class="flex justify-end">
                           <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Company</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </body>
   </html>