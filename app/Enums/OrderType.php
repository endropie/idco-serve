<?php

namespace App\Enums;

enum OrderType: string
{
    case PURCHASE = 'PURCHASE';
    case TRIAL = 'TRIAL';
    case COMPLAINT = 'COMPLAINT';
}
