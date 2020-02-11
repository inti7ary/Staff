<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\LogEntry;
class LogController extends Controller{


    public function __invoke(){
        return LogEntry::with(['employee', 'department', 'position'])->get();
    }
}