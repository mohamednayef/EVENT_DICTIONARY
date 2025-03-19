<?php 

namespace App\Enums;

enum PaymentStatus: string 
{
    // paid','faild','refurded
    case PAID = "paid";
    case FAILD = "faild";
    case REFURDED = "refurded";
}