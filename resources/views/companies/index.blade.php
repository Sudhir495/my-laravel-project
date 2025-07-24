<!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Companies</title>
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
               <div class="max-w-4xl mx-auto">
                   <h1 class="text-3xl font-bold mb-6">Your Companies</h1>
                   <a href="{{ route('companies.create') }}" class="inline-block mb-6 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add New Company</a>
                   <div class="bg-white shadow-md rounded-lg overflow-hidden">
                       <table class="min-w-full divide-y divide-gray-200">
                           <thead class="bg-gray-50">
                               <tr>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Industry</th>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                                   <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                               </tr>
                           </thead>
                           <tbody class="bg-white divide-y divide-gray-200">
                               @foreach(auth()->user()->companies as $company)
                                   <tr>
                                       <td class="px-6 py-4">{{ $company->name }}</td>
                                       <td class="px-6 py-4">{{ $company->industry }}</td>
                                       <td class="px-6 py-4">{{ $company->address }}</td>
                                       <td class="px-6 py-4 flex space-x-2">
                                           <form action="{{ route('companies.set-active', $company) }}" method="POST">
                                               @csrf
                                               <button type="submit" class="text-blue-500 hover:underline {{ auth()->user()->current_company_id === $company->id ? 'font-bold' : '' }}">
                                                   {{ auth()->user()->current_company_id === $company->id ? 'Active' : 'Set Active' }}
                                               </button>
                                           </form>
                                           <a href="{{ route('companies.edit', $company) }}" class="text-green-500 hover:underline">Edit</a>
                                           <form action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                               @csrf
                                               @method('DELETE')
                                               <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                           </form>
                                       </td>
                                   </tr>
                               @endforeach
                               @if(auth()->user()->companies->isEmpty())
                                   <tr>
                                       <td colspan="4" class="px-6 py-4 text-center text-gray-500">No companies found.</td>
                                   </tr>
                               @endif
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </body>
   </html>