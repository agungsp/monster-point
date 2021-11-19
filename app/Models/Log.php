<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'Log';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'CreateDate';

    protected $guarded = ['Id', 'Guid', 'CreateDate'];
    protected $hidden = ['Times'];
}
