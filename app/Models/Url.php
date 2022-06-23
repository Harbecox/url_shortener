<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        "group_id",
        "user_id",
        "created_at"
    ];

    function alias(){
        return $this->hasOne(Alias::class,"subject_id","id")->where("type","url");
    }

    function group(){
        return $this->belongsTo(Group::class,"group_id","id");
    }
}
