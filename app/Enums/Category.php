<?php 

namespace App\Enums;

enum Category: string
{
    case Concert = 'concert';
    case theater = 'theater';
    case sports = 'sports';
    case conference = 'conference';
}