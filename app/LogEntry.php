<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class LogEntry extends Model
{
    //public $incrementing = true;
    //
    protected $table = "promotion_log";
    protected $fillable = ["employee_id", "department_id", "position_id"];
    //const CREATED_AT = "date";


    public function employee(){
        return $this->hasOne('App\Employee', 'id', 'employee_id');
    }
    public function department(){
        return $this->hasOne('App\Department', 'id', 'department_id');
    }

    public function position(){
        return $this->hasOne('App\Position', 'id', 'position_id');
    }

    public function setUpdatedAt($value){
        //do nothing
    }
}
