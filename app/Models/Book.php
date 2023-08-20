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
 
    // event closures registered in static model booted function
    public static function boot()
    {
        parent::boot();

        static::creating(function($book) {            
            $book->slug = str($book->title)->slug()->toString();           
        });

        static::updating(function($book) {            
            $book->slug = str($book->title)->slug()->toString();          
        });
    }


    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    
}
