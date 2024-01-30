<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(StoreApplicationRequest $request)
    {
        if($request->hasFile('file_url')){
            $name = $request->file('file_url')->getClientOriginalName();
            $path = $request->file('file_url')->storeAs('files', $name, 'public');
        }


        $app = Application::create([

            'user_id'   => auth()->user()->id,
            'subject'   => $request->subject,
            'message'   => $request->message,
            'file_url'  => $path ?? null,

        ]);


        return redirect()->to('/dashboard');

    }
}