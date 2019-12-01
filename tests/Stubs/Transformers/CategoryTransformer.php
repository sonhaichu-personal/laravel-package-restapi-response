<?php

namespace HaiCS\Laravel\Api\Response\Test\Stubs\Transformers;

use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Category;
use HaiCS\Laravel\Api\Response\Test\Stubs\Transformers\BookTransformer;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'books',
    ];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform(Category $model)
    {
        return [
            'name' => $model->name,
            'slug' => $model->slug,
        ];
    }

    public function includeBooks(Category $model)
    {
        return $this->collection($model->books, new BookTransformer());
    }
}
