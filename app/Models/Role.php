<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public static function PM() {

        return Role::where('role', "Project Manager")->pluck('id')[0];
    }

    public static function DEV() {

        return Role::where('role', "Developer")->pluck('id')[0];
    }
}
