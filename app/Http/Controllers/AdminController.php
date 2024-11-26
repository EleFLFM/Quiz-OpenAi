<?php

namespace App\Http\Controllers;

use App\Models\TestResult;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show()
    {
        $results = TestResult::with('user')->get();

        return view('admin.show', compact('results'));
        // Aquí puedes devolver una vista o datos específicos
    }
}
