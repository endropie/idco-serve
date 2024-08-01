<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Recordset\Concerns\HasFilterable;
use Recordset\Concerns\HasGenerateNumber;

class ReceiveOrder extends Model
{
    use HasGenerateNumber, HasFilterable;

    public function items()
    {
        return $this->hasMany(ReceiveOrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_uid');
    }

    public function setNumber()
    {

        if (!str($this->number)->startsWith('DRAFT-')) return;

        $prefix = 'SO';
        $digits = 5;
        $separator = '/';

        $strtime = date("Y" .$separator ."m");
        $strset = $prefix . $separator . $strtime . $separator . "{number}";

        \App\Jobs\GenerateNumber::dispatchSync($this, $strset, $digits);
    }

    static function booted()
    {
        static::creating(function ($model) {
            $model->number = 'DRAFT-' . str()->uuid();
            $model->created_uid = 0; //auth()->user()->id;
        });
    }
}
