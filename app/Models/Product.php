<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'img',
        'description',
        'price',
        'category_id',
        'count'
    ];
    protected $appends = ['display_favourite'];

    public function products() {
        return $this->hasMany(SubProduct::class);
    }
    public function rates() {
        return $this->hasMany(Rate::class);
    }
    public function averageRate()
    {
        return $this->rates()->average('rate') ?? null;
    }
    public function getDisplayFavouriteAttribute()
    {
        if(!empty($this->favourite)) {
            return true;
        }
        return false;
     }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'option_product');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function favourite() {
         return $this->hasOne(Favourite::class, 'product_id', 'id');
    }

    public function getDescriptionAttribute($value)
    {
        // strip_tags() function will remove all HTML tags from the string.
        return strip_tags($value);
    }

}
