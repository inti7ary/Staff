<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Employee;

use App\StaffingTable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class StaffingTableController extends Controller{

    public function updateStaffingTable($id, Request $request){
       
        $staffing_table = StaffingTable::findOrFail($request->id);
      
        $staffing_table->update($request->all());
        return $staffing_table;
    }

    public function getOne($id){
        return StaffingTable::findOrFail($id);
    }
    
}