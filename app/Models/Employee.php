<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        "lastname",
        "firstname",
        "middlename",
        "position",
        "employeeID",
        "phone",
        "email",
        "facebook",
        "telegram",
        "wechat",
        "viber",
        "whatsapp",
        "profile",
        "qrcode",
    ];
}
