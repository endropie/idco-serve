<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Recordset\Concerns\HasFilterable;

class Tool extends Model
{
    use HasFilterable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'notes',
    ];
}
