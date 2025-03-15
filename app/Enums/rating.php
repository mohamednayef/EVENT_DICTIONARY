<?php

namespace App\Enums;

enum Rating: string 
{
    case YES = "1";
    case NO = "-1";
    case NORMAL = "0";
}