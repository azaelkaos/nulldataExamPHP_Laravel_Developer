<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday'  => 'date:d/m/Y',
        'password' => 'hashed',
    ];

    static function create($attribs): object
    {
        $User = new User();
        $User->name=$attribs->name;
        $User->email=$attribs->email;
        $User->position=$attribs->position;
        $User->position=$attribs->address??'';
        $User->position=$attribs->latitude??'';
        $User->position=$attribs->longitude??'';
        $User->position=$attribs->position;
        $User->birthday=Carbon::createFromFormat('d/m/Y',$attribs->birthday)->format('Y-m-d');
        $User->save();
        return $User;
    }

    static function getInfo($id=false):array
    {
        if($id){
            return ["employee"=>User::findOrFail($id),"skills"=>Skill::where('user_id',$id)->get()];
        }else{
            return User::all()->toArray();
        }
    }

    static function setAddress($id,$lat='',$long='',$address=''){
        $user=User::findOrFail($id);
        $user->address=$address;
        $user->latitude=$lat;
        $user->longitude=$long;
        $user->save();
        return $user;
    }
}
