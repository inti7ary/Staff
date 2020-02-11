<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



 




Route::get('/employees', 'EmployeesController@index')->name("api.employees");

Route::get('/employees/{id}', 'EmployeesController@getOne')->name('api.employee');
Route::get('/departments', 'DepartmentsController@index')->name("api.departments");
Route::get('/departments/{id}', 'DepartmentsController@getOne')->name("api.department");
//Route::middleware('can:is_admin')->group(function(){
    
    Route::post("/employees", 'EmployeesController@create')->name("api.create.employee");
    Route::put("/employees", 'EmployeesController@update')->name("api.update.employee");
    Route::put("/staffing_table/{id}", 'StaffingTableController@updateStaffingTable')
    ->name("api.update.staffing_table");
    Route::get("/staffing_table/{id}", 'StaffingTableController@getOne')->name("api.staffing_table");
    Route::delete("/employees", "EmployeesController@delete")->name("api.delete.employee");
    
    
    Route::post("/departments", 'DepartmentsController@create')->name("api.create.department");
    Route::put("/departments", 'DepartmentsController@update')->name("api.update.department");
    Route::delete("/departments", "DepartmentsController@delete")->name("api.delete.department");

//});

Route::get('/log', 'LogController')->name('api.log');
