<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'options'
    ];
    
    protected $casts = [
        'options' => 'array'
    ];
    
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'option_product');
    }


}
