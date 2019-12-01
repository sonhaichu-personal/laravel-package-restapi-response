<?php

namespace HaiCS\Laravel\Api\Response\Test\Stubs\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'author',
    ];
}
