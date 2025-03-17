<?php 

namespace App\Enums;

enum TicketStatus: string 
{
    case CANCELED = "canceled";
    case BOOKED = "booked";
}