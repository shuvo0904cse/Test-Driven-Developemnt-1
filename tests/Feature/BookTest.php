<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * books lists
     */
    public function test_books_list()
    {
        $books = Book::factory()->count(10)->create();
        $response = $this->getJson(route("books.index"));
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount($books->count());
    }

    /**
     * book title is required
     */
    public function test_book_title_is_required()
    {
        $response = $this->postJson(route("books.store"), [
            "title" => null,
            "author_id" => rand(1, 100)
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['title']);
    }

    /**
     * book author id is required
     */
    public function test_book_author_id_is_required()
    {
        $response = $this->postJson(route("books.store"), [
            "title" => "Book Name Here",
            "author_id" => null
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['author_id']);
    }

    /**
     * books can be created
     */
    public function test_book_can_be_created()
    {
        $book = Book::factory()->make()->toArray();
        $response = $this->postJson(route("books.store"), $book);
        $response->assertCreated();
    }

    /**
     * a updated book title is required
     */
    public function test_a_updated_book_title_is_required()
    {
        $book = Book::factory()->create();
        $response = $this->putJson(route("books.update", $book->id), [
            "title" => null,
            "author_id" => rand(1, 100)
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['title']);
    }

    /**
     * a updated book author id is required
     */
    public function test_a_updated_book_author_id_is_required()
    {
        $book = Book::factory()->create();
        $response = $this->putJson(route("books.update", $book->id), [
            "title" => "Book Name Here",
            "author_id" => null
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['author_id']);
    }

    /**
     * a book can be updated
     */
    public function test_a_book_can_be_updated()
    {
        $book = Book::factory()->create();
        $response = $this->putJson(route("books.update", $book->id), [
            "title" => "updated here",
            "author_id" => rand(1, 100)
        ]);
        $response->assertOk();
    }

    /**
     * a book can be deleted
     */
    public function test_a_book_can_be_deleted()
    {
        $book = Book::factory()->create();
        $response = $this->deleteJson(route("books.destroy", $book->id));
        $response->assertOk();
    }
}
