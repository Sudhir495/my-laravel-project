<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Ensure this is imported
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        // Apply middleware for API routes
        $this->middleware('auth:sanctum')->only(['index', 'store', 'update', 'destroy', 'setActive']);
        // Apply middleware for web routes
        $this->middleware('auth')->only(['create', 'edit']);
        // Apply company scoping middleware, excluding routes that don't need it
        $this->middleware(\App\Http\Middleware\EnsureCompanyIsSet::class)->except(['index', 'store', 'setActive', 'create', 'edit']);
    }

    public function index()
    {
        if (request()->expectsJson()) {
            return response()->json(auth()->user()->companies);
        }

        return view('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $company = auth()->user()->companies()->create($request->only(['name', 'address', 'industry']));

        if (!auth()->user()->current_company_id) {
            auth()->user()->update(['current_company_id' => $company->id]);
        }

        if ($request->expectsJson()) {
            return response()->json($company, 201);
        }

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            return redirect()->route('companies.index')->with('error', 'Unauthorized');
        }

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->route('companies.index')->with('error', 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $company->update($request->only(['name', 'address', 'industry']));

        if ($request->expectsJson()) {
            return response()->json($company);
        }

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            if (request()->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->route('companies.index')->with('error', 'Unauthorized');
        }

        $company->delete();

        if (auth()->user()->current_company_id === $company->id) {
            auth()->user()->update(['current_company_id' => null]);
        }

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Company deleted']);
        }

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }

    public function setActive(Request $request, Company $company)
    {
        if ($company->user_id !== auth()->id()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return redirect()->route('companies.index')->with('error', 'Unauthorized');
        }

        auth()->user()->update(['current_company_id' => $company->id]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Active company set', 'company' => $company]);
        }

        return redirect()->route('companies.index')->with('success', 'Active company set successfully.');
    }
}