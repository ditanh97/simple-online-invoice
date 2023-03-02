<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $table = "m_roles";

    protected $primaryKey = 'role_id';
    protected $fillable = [
        'name'
    ];


}
