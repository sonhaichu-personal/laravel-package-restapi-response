<?php

use HaiCS\Laravel\Api\Response\Test\Stubs\Models\Book;
use HaiCS\Laravel\Api\Response\Test\Stubs\Transformers\BookTransformer;

Route::get('api/v1/books/detail', function () {
    $book = factory(Book::class)->make();

    return response()->api()->item($book, new BookTransformer());
})->name('get.item');

Route::get('api/v1/books/all', function () {
    $books = factory(Book::class, 20)->make();

    return response()->api()->collection($books, new BookTransformer());
})->name('get.collection');

Route::get('api/v1/books', function () {
    $collection = factory(Book::class, 20)->make();
    $books      = $collection->paginate(15);

    return response()->api()->paginator($books, new BookTransformer());
})->name('get.paginator');

Route::get('api/v1/success', function () {
    return response()->api()->success();
});
