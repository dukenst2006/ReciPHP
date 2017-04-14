<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post("/api/login", "Auth\\LoginController@login");
Route::post("/api/logout", "Auth\\LoginController@logout");
Route::get("/api/recipe/lastChange", "RecipeController@newest");
Route::resource("/api/recipe", "RecipeController");

Route::get("/api/user.json", function() {
    $data = [];

    if(Auth::check()) {
        $user = Auth::user();
        $data = [
            "loggedIn" => true,
            "name" => $user->name,
            "email" => $user->email,
            "isAdmin" => $user->admin,
            "id" => $user->id,
        ];
    } else {
        $data = [
            "loggedIn" => false,
        ];
    }

    $data["token"] = csrf_token();

    return response()->json($data);
});

Route::get("/", function() {
    return redirect("/home");
});

Route::get('/{url}', function () {
    return view("main");
})->where("url", '.*');
