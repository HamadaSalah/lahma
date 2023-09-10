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
        'category_id'
    ];

    public function products() {
        return $this->hasMany(SubProduct::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'option_product');
    }

}
