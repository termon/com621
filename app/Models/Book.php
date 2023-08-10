<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    // public $fillable  = [];
    public $guarded = [];

    /**
     * Relationships to be eagerly loaded
     */
    //protected $with = ['category'];

    // event closures registered in static model booted function
    public static function boot()
    {
        parent::boot();

        static::created(function($book) {            
            $book->slug = str($book->title)->slug()->toString();           
        });

        static::updated(function($book) {            
            $book->slug = str($book->title)->slug()->toString();          
        });
    }

    /**
     * Get the Reviews for this book.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the Author(s) for this book.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    protected function getSummaryAttribute()
    {
       return Str::limit($this->description, 30,'...');
    }

    /**
     * Get the Category for this book.
     */
//    public function category(): BelongsTo
//    {
//        return $this->belongsTo(Category::class);
//    }

}
