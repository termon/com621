<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $guarded = [ 'id' ];

    protected $with = ['category'];
    
    // mutator to store rating to 1 decimal place
    protected function Rating(): Attribute
    {
        return Attribute::make(           
            set: fn ($value, $attributes) => round($value,1), 
        );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('public')->singleFile();
    }
    
    // make list of authors not associated with book 
    public function getAddAuthorSelectList(): array {        
        return Author::all()->diff($this->authors)->pluck('name','id')->all();
    }

    // make select list of authors associated with book
    public function getRemoveAuthorSelectList(): array {
        return $this->authors->pluck('name', 'id')->all();
    }
    
    // relationships
    public function reviews() : HasMany {
        return $this->hasMany(Review::class)->orderBy('reviewed_on', 'desc');
    }
    
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
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
        if ($value) {
            return $query->where('title', 'like', "%{$value}%")
                ->orWhere('description','like', "%{$value}%")
                ->orWhere('year','like', "%{$value}%")
                ->orWhereHas('category', fn ($q) => 
                    $q->where('name', 'like', "%{$value}%"))
                ->orWhereHas('authors', fn($q) =>
                    $q->where('name', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%"));
        }
        return $query; 
          
        // return match($value) {
        //     '',null => $query,
        //     default => $query                            
        //         ->where('title', 'like',  "%{$value}%")
        //         ->orWhere('description','like',  "%{$value}%")
        //         ->orWhere('year','like',  "%{$value}%")
        //         ->orWhereHas('category', fn ($q) => $q->where('name', 'like', "%{$value}%"))
        //         ->orWhereHas('authors', fn($q) =>$q->where('name', 'like', "%{$value}%")
        //                                            ->orWhere('email', 'like', "%{$value}%")
        //         )
        // };        
    }

}
