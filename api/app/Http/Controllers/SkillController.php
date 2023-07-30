<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Skill;
use App\Models\User;

class SkillController extends Controller
{
    //
    public function update(Request $request){
        $request->validate([
            "skills"=>"required|array",
            "skills.*" => 'required|min:1',
            "skills.*.id" => 'required|numeric',
            "skills.*.name" => 'required',
            "skills.*.expertice" => 'required|integer|between:1,5',
        ]);
        foreach ($request->skills as $key => $value) {
            $skill=Skill::setUpdate($value);
        }
        return response()->json([
            "status"=>1,
            "data"=>User::getInfo($skill->user_id),
            "message"=> Response::$statusTexts[Response::HTTP_OK],
        ],Response::HTTP_OK);
    }
    public function create(Request $request){
        $request->validate([
            "id"=>"required|numeric",
            "skills"=>"required|array",
            "skills.*" => 'required|min:1',
            "skills.*.name" => 'required',
            "skills.*.expertice" => 'required|integer|between:1,5',
        ]);
        foreach ($request->skills as $key => $value) {
            Skill::create($request->id,$value);
        }
        return response()->json([
            "status"=>1,
            "data"=>User::getInfo($request->id),
            "message"=> Response::$statusTexts[Response::HTTP_OK],
        ],Response::HTTP_OK);
    }
}
