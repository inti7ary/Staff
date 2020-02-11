<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Department;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
class DepartmentsController extends Controller{


    public function index(){
        //return Department::with(['employees'])->get();
       return Department::all();
     
    }

    public function create(Request $request){
        return Department::create($request->all());
    }

    public function delete(Request $request){
        $id = $request->id;
        $department = Department::findOrFail($id);
        $department->delete();

        return response("Deleted", 204);
    }

    public function update(Request $request){
        $id = $request->id;
        $department = Department::findOrFail($id);
        $department->update($request->all());
        return $department;
    }

    public function getOne($id){
        //employees attribute is hidden by default, made it visible for this api method call
        $dep =  Department::findOrFail($id)->makeVisible('employees');

        return $dep;
    }
    
    public function show($id){
        return view("department", ['department' => Department::findOrFail($id), 'id' => $id]);
    }
}