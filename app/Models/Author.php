<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * @var string[] properties that should not be mass updatable
     */
    public $guarded = [];

    /**
     * Author has many books relationship
     *
     * @return HasMany
     */
//    public function books(): HasMany
//    {
//        return $this->hasMany(Book::class);
//    }
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }


}
