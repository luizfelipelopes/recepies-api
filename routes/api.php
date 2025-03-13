<?php

use App\Http\Controllers\Api\V1\RecipiesController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// api/V1

Route::group(['prefix' => 'V1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('recipies', RecipiesController::class);
});

Route::get('/setup', function () {

    $credentials = [
        'email' => 'admin@mail.com',
        'password' => 'password',
    ];

    $isLogged = Auth::attempt($credentials);

    if(!$isLogged) {

        $user = User::create([
            'name' => 'Admin',
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);

        if(Auth::attempt($credentials)) {

            $adminToken = $user->createToken('admin-token', ['*'])->plainTextToken;
            $crudToken = $user->createToken('crud-token', ['create', 'update', 'delete'])->plainTextToken;
            $basicToken = $user->createToken('basic-token', ['none'])->plainTextToken;

            return [
                'admin' => $adminToken,
                'crud' => $crudToken,
                'basic' => $basicToken
            ];
        }
    }

});