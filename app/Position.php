<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";
    public $timestamps = false;
    protected $fillable = ["name"];
    protected $hidden = ['laravel_through_key'];


    public static function findOrCreate($name){
        $name = mb_strtolower($name);
        $pos = Position::where("name", "=", $name)->first();
        if($pos === null){
            $pos = Position::create(['name' => $name]);
        }

        return $pos;
    }
}
