<?php

namespace App\Http\Controllers;


use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        if (!empty(Auth::user()->companies)) {
            $result = Auth::user()->companies;

            if (!empty($result)) {
                return response()->json($result->toJson());
            }
        }
        return response()->json(['message' => 'This user has no associated companies']);
    }

    public function store(Request $request)
    {
        try {
            $companies = new Companies();
            $companies->title = $request->title;
            $companies->phone = $request->phone;
            $companies->description = $request->description;

            if ($companies->save()) {
                Auth::user()->companies()->save($companies);

                return response()->json(['status' => 'success',
                    'message' => 'Company created successfully']);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error',
                'message' => $e->getMessage()]);
        }

        return response()->json(['status' => 'error', 'message' => 'entry was not created']);
    }
}
