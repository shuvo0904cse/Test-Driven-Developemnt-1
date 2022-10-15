<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * author lists
     */
    public function test_author_lists()
    {
        $authors = Author::factory()->count(10)->create();
        $response = $this->getJson(route("authors.index"));
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount($authors->count());
    }

    /**
     * updated author dob format is wrong
     */
    public function test_a_author_dob_format_is_wrong()
    {
        $response = $this->postJson(route('authors.store'), [
            "name" => "Author Name",
            "dob"  => Carbon::now()->toDateTimeString()
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['dob']);
    }

    /**
     * author name is required
     */
    public function test_author_name_is_required()
    {
        $response = $this->postJson(route('authors.store'), [
            'name' => null
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name']);
    }

    /**
     * author can be deleted
     */
    public function test_author_can_be_created()
    {
        $response = $this->postJson(route('authors.store'), Author::factory()->make()->toArray());
        $response->assertCreated();
    }

    /**
     * updated author name is required
     */
    public function test_a_updated_author_name_is_required()
    {
        $author = Author::factory()->create();
        $response = $this->putJson(route('authors.update', $author->id), [
            'name' => null
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name']);
    }

    /**
     * updated author can be updated
     */
    public function test_a_updated_author_can_be_updated()
    {
        $author = Author::factory()->create();
        $response = $this->putJson(route('authors.update', $author->id), [
            'name' => 'author Name here',
            'dob'  => Carbon::now()->toDateString()
        ]);
        $response->assertOk();
    }

    /**
     * author can be deleted
     */
    public function test_author_can_be_deleted()
    {
        $author = Author::factory()->create();
        $response = $this->deleteJson(route('authors.destroy', $author->id));
        $response->assertOk();
    }
}
