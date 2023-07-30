<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    static function create($user_id,$attribs): object
    {
        User::findOrFail($user_id);
        $Skill = new Skill();
        $Skill->user_id=$user_id;
        $Skill->name=$attribs['name'];
        $Skill->expertice=$attribs['expertice'];
        $Skill->save();
        return $Skill;
    }

    static function setUpdate($attribs): object
    {
        $skill=Skill::findOrFail($attribs["id"]);
        $skill->name=$attribs["name"];
        $skill->expertice=$attribs["expertice"];
        $skill->update();
        return $skill;
    }

}
