<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable  = ['id', 'name', 'rating', 'comment'];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded  = [];

    
    /**
     *  The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [ 
        ['on' => 'date'] 
    ];

    /**
     * Get the book for this Review
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    protected function getReviewedOnAttribute($value) {     
        return Carbon::create($value);
    }
    // protected function reviewedOn(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => Carbon::create($value),           
    //     );
    // }

   
    /**
     * Return truncated comment if length greater than $max otherwise whole comment
     * @param int $max
     * @return string
     */
    public function commentTruncatedTo(int $max): string
    {
        return strlen($this->comment) > $max
            ? substr($this->comment,0,$max) . '...'  //? str($this->comment)->limit($max)
            : $this->comment;
    }
}
