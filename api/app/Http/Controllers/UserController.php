<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Skill;

class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "position"=>"required",
            "birthday"=>"date_format:d/m/Y",
            "skills"=>"required|array",
            "skills.*" => 'required|min:1',
            "skills.*.name" => 'required',
            "skills.*.expertice" => 'required|integer|between:1,5',
        ]);
        $user=User::create($request);
        foreach ($request->skills as $key => $value) {
            $user=Skill::create($user->id,$value);
        }
        return response()->json([
            "status"=>1,
            "message"=> Response::$statusTexts[Response::HTTP_CREATED],
        ],Response::HTTP_CREATED);
    }

    public function read(Request $request){
        $request->validate([
            "id"=>"required|numeric",
        ]);
        return response()->json([
            "status"=>1,
            "data"=>User::getInfo($request->id),
            "message"=> Response::$statusTexts[Response::HTTP_OK],
        ],Response::HTTP_OK);
    }

    public function list(Request $request){
        return response()->json([
            "status"=>1,
            "data"=>User::getInfo(),
            "message"=> Response::$statusTexts[Response::HTTP_OK],
        ],Response::HTTP_OK);
    }

    public function setAddress(Request $request){
        $request->validate([
            "id"=>"required|numeric"
        ]);
        $user=User::setAddress($request->id,$request->latitude,$request->longitude,$request->address);
        return response()->json([
            "status"=>1,
            "data"=>$user,
            "message"=> Response::$statusTexts[Response::HTTP_CREATED],
        ],Response::HTTP_CREATED);
    }

}
