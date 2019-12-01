<?php

namespace HaiCS\Laravel\Api\Response\Test\Stubs\Transformers;

use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform(Book $model)
    {
        return [
            'title'       => $model->title,
            'description' => $model->description,
            'author'      => $model->author,
        ];
    }
}
