<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Recordset\Concerns\HasFilterable;

class Fltype extends Model
{
    use HasFilterable;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = "code";
}
