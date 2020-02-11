<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffingTable extends Model
{
    //
    protected $table = "staffing_table";
    protected $fillable = ['salary', 'work_day_beggining', 'work_day_end'];
    public $timestamps = false;
    protected $primaryKey = 'employee_id';

    
}
