<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "alias",
        "title",
        "description",
        "is_active",
        "is_rotation",
        "created_at"
    ];

    function alias(){
        return $this->hasOne(Alias::class,"subject_id","id")->where("type","group");
    }

    function urls(){
        return $this->hasMany(Url::class,"group_id","id");
    }
}
