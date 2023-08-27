<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['reviewed_on' => 'datetime'];

    // older accessor syntax
    public function getReviewedOnForHumansAttribute() : string
    {
         return $this->reviewed_on->diffForHumans(); //toFormattedDateString();
    }
   
    // modern accessor/mutator syntax
    protected function ReviewedOnFormatted(): Attribute
    {
        return Attribute::make(
            // get: fn ($value, $attributes) => Carbon::parse($attributes['reviewed_on'])->diffForHumans(),
            get: fn ($value, $attributes) => $this->reviewed_on->toDayDateTimeString(), // relying on fact a cast has been defined for reviewed_on to datetime
        );
    }

    protected function ShortComment(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Str::of($attributes['comment'])->limit(40)->append("..."),
        );
    }

    public function book():  BelongsTo {
        return $this->belongsTo(Book::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($review) {                       
            $review->book->rating = $review->book->reviews->avg('rating');
            $review->book->save();          
        });

        static::deleted(function($review) {           
            $review->book->rating = $review->book->reviews->avg('rating');  
            $review->book->save();         
        });
    }
    
}
