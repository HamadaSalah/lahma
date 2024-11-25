<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'category_id'
    ];

    //
    public function child() {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    //
    public function parent() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    //
    public function products() {
        return $this->hasMany(Product::class);
    }
 }
