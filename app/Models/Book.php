<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public $guarded = [ 'id' ];

    protected $with = ['category'];
 
    // accessor to format rating to 1 decimal place
    protected function RatingFormatted(): Attribute
    {
        return Attribute::make(           
            get: fn ($value, $attributes) => number_format($attributes['rating'],1), 
        );
    }

    // relationships
    public function reviews() : HasMany {
        return $this->hasMany(Review::class);
    }
    
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function authors() : HasMany {
        return $this->hasMany(Author::class);
    }

    // event closures registered in static model booted function
    public static function boot()
    {
        parent::boot();

        static::creating(function($book) {            
            $book->slug = str($book->title)->slug()->toString();           
        });

        static::updating(function($book) {            
            $book->slug = str($book->title)->slug();          
        });
    }

    // model search scope
    public function scopeSearch($query, $value) {
        return match($value) {
            $value => $query                            
                ->where('title', 'like',  "%{$value}%")
                ->orWhere('author','like',  "%{$value}%")
                ->orWhere('description','like',  "%{$value}%")
                ->orWhereHas('category', fn ($q) => $q->where('name', 'like', "%{$value}%")),
            default => $query
        };        
    }

}
