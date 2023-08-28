<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    public $guarded = [ 'id' ];

    // relationship
    public function books() : HasMany {
        return $this->hasMany(Book::class);
    }

}
