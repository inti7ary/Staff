<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\LogEntry;
use Illuminate\Support\Facades\Log;
class Department extends Model
{
    //
    protected $table = "departments";
    public $timestamps = false;
    protected $fillable = ['name', 'phone_number'];
    protected $hidden = ['laravel_through_key', 'employees'];
    protected $appends = ['employees', 'count'];


  

   public function getEmployeesAttribute(){
        $employees = DB::select("SELECT * FROM staff INNER JOIN(SELECT l.employee_id, l.created_at, l.department_id 
        FROM promotion_log l INNER JOIN(SELECT employee_id, MAX(created_at) as maxdate FROM promotion_log GROUP BY employee_id) lg
         on l.employee_id = lg.employee_id and l.created_at = lg.maxdate WHERE department_id = ?) log on staff.id = log.employee_id", [$this->id]);

        $converted = Employee::hydrate($employees);
        return collect($converted);
    }

    public function getCountAttribute(){
    
        $query_result =  DB::select("SELECT COUNT(id) as count FROM staff INNER JOIN(SELECT l.employee_id, l.created_at, l.department_id 
        FROM promotion_log l INNER JOIN(SELECT employee_id, MAX(created_at) as maxdate FROM promotion_log GROUP BY employee_id) lg
         on l.employee_id = lg.employee_id and l.created_at = lg.maxdate WHERE department_id = ?) log on staff.id = log.employee_id", [$this->id]);
        return $query_result[0]->count;
    }
}
