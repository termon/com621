<?php

namespace App\Models;

class WelcomeViewModel 
{
    public function __construct(
        public string $title,
        public array $topics = [] ) {}
   
}
