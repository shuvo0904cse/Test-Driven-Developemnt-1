<?php

namespace App\Http\Controllers;

use App\Http\Requests\Author\AuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
        /**
     * Book
     */
    public function index()
    {
        try {
            return Author::get();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Show
     */
    public function show(Author $author)
    {
        try {
            return $author;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Store
     */
    public function store(AuthorRequest $authorRequest)
    {
        try {
            return Author::create($authorRequest->validated());
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Update
     */
    public function update(AuthorRequest $authorRequest, Author $author)
    {
        try {
            $author->update($authorRequest->validated());
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Destroy
     */
    public function destroy(Author $author)
    {
        try {
            $author->delete();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
