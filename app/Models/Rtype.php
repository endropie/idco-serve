<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Recordset\Concerns\HasFilterable;

class Rtype extends Model
{
    use HasFilterable;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = "code";
}
