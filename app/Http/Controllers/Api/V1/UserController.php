<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        //Retornar mais de um registro
        return UserResource::collection(User::all());
    }

  
    public function store(Request $request)
    {
        //
    }

   
    public function show(string $id)
    {
        //Retornar apenas um registro
        return new UserResource(User::where('id', $id)->first()); 
    }

   

    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
