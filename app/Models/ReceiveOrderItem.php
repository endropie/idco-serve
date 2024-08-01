<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveOrderItem extends Model
{
    protected $fillable = [
        'name',  'quantity', 'condition', 'hrc',
        'protype_id', 'material_id', 'coat_id', 'dimension', 'rtype', 'r0type', 'fltype',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'dimension' => 'array',
    ];
}
