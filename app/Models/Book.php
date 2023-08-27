<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public $guarded = [ 'id' ];

    protected $with = ['category'];
 

    public function reviews() : HasMany {
        return $this->hasMany(Review::class);
    }
    
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
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
