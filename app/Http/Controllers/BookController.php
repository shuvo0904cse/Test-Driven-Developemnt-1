<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Book
     */
    public function index()
    {
        try {
            return Book::get();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show
     */
    public function show(Book $book)
    {
        try {
            return $book;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Store
     */
    public function store(BookRequest $bookRequest)
    {
        try {
            return Book::create($bookRequest->validated());
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Update
     */
    public function update(BookRequest $bookRequest, Book $book)
    {
        try {
            $book->update($bookRequest->validated());
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Destroy
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
