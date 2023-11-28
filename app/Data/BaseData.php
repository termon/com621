<?php

namespace App\Data;

use Illuminate\Support\Collection;

class BaseData
{
   
    public static function fromArray(array $data): ?self 
    {
        return null;
    }

    public function toArray(): array
    {
        //return (array) $this;
        
        // only return non-null values
        return  array_filter((array) $this);
    }
 
    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

}