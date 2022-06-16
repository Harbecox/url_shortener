<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alias extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        "alias",
        "url",
        "type",
        "subject_id"
    ];

    function visits(){
        return $this->hasMany(Visit::class,"alias","alias");
    }

    function url_obj(){
        return $this->hasOne(Url::class,"id","subject_id");
    }

    static function isUnique($alias){
        return !Alias::query()->where("alias",$alias)->exists();
    }

    static function createUnique(){
        $alias = self::makeAlias();
        while(!self::isUnique($alias)){
            $alias = self::makeAlias();
        }
        return $alias;
    }

    static function makeAlias(){
        $chars = [];
        foreach( range('a', 'z') as $char) {
            $chars[] = $char;
        }
        foreach( range('0', '9') as $char) {
            $chars[] = $char;
        }
        shuffle($chars);
        $alias = "";
        foreach (array_splice($chars,0,5) as $char){
            $alias.= rand(0,1) == 1 ? strtoupper($char) : $char;
        }
        return $alias;
    }
}
