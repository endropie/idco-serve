<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveOrderItem extends Model
{
    protected $fillable = [
        'name', 'quantity', 'weight', 'condition', 'hrc', 'isexpress',
        'protype_id', 'material_id', 'coat_id', 'dimension', 'rtype', 'r0type', 'fltype',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'weight' => 'double',
        'dimension' => 'array',
    ];
}
