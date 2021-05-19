<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneBookDetails extends Model
{
    // protected $table = 'employees';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamp = true;
}
