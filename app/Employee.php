<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Position;
class Employee extends Model
{


    //protected $with = ['position'];
    //
    protected $table = "staff";
    public $timestamps = false;
    protected $fillable = ['first_name', 'surname', 'patronymic', 'email', 'phone_number'];
    protected $hidden = ['laravel_through_key'];
    protected $appends = ['position_name', 'department'];

    public function staffingTable(){
        return $this->hasOne('App\StaffingTable', 'employee_id', 'id');
    }
    public function position(){
        return $this->hasOneThrough('App\Position', 'App\LogEntry', 'employee_id', 'id', 'id', 'position_id')->latest();
    }

    public function getDepartmentAttribute(){
        $department = DB::select('SELECT * FROM departments WHERE id = 
        (SELECT department_id FROM promotion_log WHERE employee_id = ? ORDER BY created_at DESC LIMIT 1)', [$this->id]);
        $converted = Department::hydrate($department);

        if(count($converted) == 0) return null;
        else return $converted[0];
    }
    /*public function department(){

        return $this->hasOneThrough('App\Department', 'App\LogEntry', 'employee_id', 'id', 'id', 'department_id')->latest();
    }*/

    public function getPositionNameAttribute(){
        return $this->position->name;
    }

   /* public function getPreviousDepartment(){
        $department = DB::select('SELECT * FROM departments WHERE id = 
        (SELECT department_id FROM promotion_log WHERE employee_id = ? ORDER BY created_at DESC LIMIT 1, 1)', [$this->id]);
        $converted = Department::hydrate($department);

        if(count($converted) == 0) return null;
        else return $converted[0];
    }*/
}
