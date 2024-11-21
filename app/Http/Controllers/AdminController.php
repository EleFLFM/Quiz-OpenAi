<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard or details.
     */
    public function show()
    {
        // Aquí puedes devolver una vista o datos específicos
        return view('admin.show'); // Asegúrate de que exista esta vista
    }
}
