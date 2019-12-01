<?php

namespace HaiCS\Laravel\Api\Response\Test\Stubs\Models;

use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Set slug.
     *
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->name);
    }

    /**
     * Get the books for the cattegory
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
