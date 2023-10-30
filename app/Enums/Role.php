<?php

namespace App\Enums;

enum Role: string 
{
    case ADMIN = "admin";
    case AUTHOR = "author";
    case GUEST = "guest";
}

// enum Role: int 
// {
//     case ADMIN = 1;
//     case AUTHOR = 2;
//     case GUEST = 3;

//     public static function values(): array
//     {
//         return array_column(self::cases(), 'value');
//     }
//     public static function names(): array
//     {
//         return array_column(self::cases(), 'name');
//     }
// }