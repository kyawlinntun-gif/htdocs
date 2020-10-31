<?php

namespace App\Http\Controllers\VueForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreDataController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'description' => 'required'
        ]);

        return response('hello');
    }
}
