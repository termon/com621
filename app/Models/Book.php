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

    public $guarded = [ 'id' ];

    protected $with = ['category'];
 
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

    public function demo() {
        $book = Book::create([
            'title' => 'Dummys Guide to HTML5',
            'author' => 'J. Smith',          
            'year' => 2022,
            'rating' => 3.0,
            'category_id' => Category::find(1)->id,
            'description' => "HTML5 provides..."
        ]);
        echo "Title: {$book->title} Slug: {$book->slug}\n";
        $book->title = "The Dummys Guide to HTML5";
        $book->update();
        echo "Title: {$book->title} Slug: {$book->slug}\n";

    }
}
