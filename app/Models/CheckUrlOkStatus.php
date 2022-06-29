<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUrlOkStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "check"
    ];
}
