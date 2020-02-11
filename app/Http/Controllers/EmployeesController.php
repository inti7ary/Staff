<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Employee;
use App\LogEntry;
use App\Position;
use App\Department;
use App\StaffingTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Employee as EmployeeResource;
class EmployeesController extends Controller{

    public function index(){
        return  new EmployeeResource(Employee::with(['position'])->get());
    }

    public function getOne($id){
        return new EmployeeResource(Employee::with(['staffingTable'])->findOrFail($id));
        //return Employee::with(['staffingTable'])->findOrFail($id);
    }
  


    public function create(Request $request){
        if(empty($request->position['name'])) return;
        $employee = null;
        DB::transaction(function() use ($request, &$employee){
            $pos = Position::findOrCreate($request->position['name']);
            $employee = Employee::create($request->all());
 
            $log_entry = ['employee_id' => $employee->id,
             'department_id' => $request->department['id'], 'position_id' => $pos->id];
             LogEntry::create($log_entry);
             StaffingTable::create(['employee_id' => $employee->id]);
           
       });
         return $employee === null? response("Error occurred",500)  : $employee->load(['department', 'position']);
         
    }
    public function update(Request $request){

        if(empty($request->position['name'])) return;
        $employee = null;
        
        DB::transaction(function() use ($request, &$employee){
            
            $employee = Employee::findOrFail($request->id);
            $dep = Department::find($request->department['id']);
            $pos = Position::findOrCreate($request->position['name']);

            if($employee->position->isNot($pos) || 
            $dep !== null && ($employee->department === null ||
             $employee->department->isNot($dep))){
            
            if($dep === null) $dep = $employee->department;

            $log_entry = ['employee_id' => $employee->id,
             'department_id' => $dep->id,
              'position_id' => $pos->id];
             LogEntry::create($log_entry);

            
            }
            $staffing_table = $request->staffing_table;
            
            $employee->update($request->all());

        });
        
        return $employee === null? response("Error occurred",500) : $employee->load(['position']);//->makeVisible('department');
        
    }

    public function updateStaffingTable(Request $request){
        if(Gate::none(['is_moderator', 'is_admin'])) return response('Access denied', 403);
        $staffing_table = $request->staffing_table;
        if(isset($staffing_table['salary']) &&
             isset($staffing_table['work_day_beginning']) &&
             isset($staffing_table['work_day_end'])){
      
               $staffing = StaffingTable::findOrFail($request->id);
               $staffing->update($staffing_table);
             }
        return Employee::with(['staffingTable'])->find($request->id);
    }
    public function delete(Request $request){
        $id = $request->id;
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response("Deleted",204);
    }

    
    public function show($id){        

        return view("profile", 
        ['id' => $id, ]);
    }


}