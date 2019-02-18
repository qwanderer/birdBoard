<?php


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>"auth"], function(){
    Route::get("/projects", "ProjectsController@index");
    Route::get("/projects/create", "ProjectsController@create");
    Route::get("/projects/{project}", "ProjectsController@show");

    Route::post("/projects", "ProjectsController@store");



    Route::post("/projects/{project}/tasks", "ProjectTasksController@store");



    Route::get('/home', 'HomeController@index')->name('home');
}); // auth group



Auth::routes();


