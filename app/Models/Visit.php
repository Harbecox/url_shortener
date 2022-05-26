<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        "alias",
        "country_code",
        "ip",
        "referer",
        "browser",
        "os",
        "device",
    ];
}
