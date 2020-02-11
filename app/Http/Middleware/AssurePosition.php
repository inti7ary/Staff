<?php

namespace App\Http\Middleware;
use App\Position;
use Illuminate\Http\Request;
use Closure;

class AssurePosition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!empty($request->position)){
            $pos_id= -1;
            $pos_name = mb_strtolower($request->position['name']);
            $pos = Position::where("name", "=", $pos_name)->first();
            if($pos === null){
                $pos = Position::create(['name' => $pos_name]);
                $pos_id = $pos->id;
            }else $pos_id = $pos->id;

            $request->position['id'] = $pos_id;
        }

        return $next($request);
    }
}