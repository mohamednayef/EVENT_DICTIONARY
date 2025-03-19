<?php

namespace App\Enums;

enum PaymentMethod: string 
{
    case VODAFONE_CASH= "vodafone_cash";
    case MY_FAWRY = "myfawry";
    case PAYPAL = "paypal";
}