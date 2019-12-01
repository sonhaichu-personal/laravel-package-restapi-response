<?php

namespace HaiCS\Laravel\Api\Response\Test\Stubs\Models;

use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
        'category_id',
    ];

    /**
     * Get the category for the book
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
