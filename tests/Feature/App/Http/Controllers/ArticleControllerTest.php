<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\UploadedFile as FileUploadedFile;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    private $inputs;
    private $defaultRoute = '/api/articles';

    public function setUp() : void
    {
        parent::setUp();

        $this->inputs = [
            'title' => 'The magic story',
            'body' => 'I decide to read and write it'
        ];
    }

    public function test_can_create_new_article()
    {
        $response = $this->post($this->defaultRoute, $this->inputs);
        $response->assertStatus(201);
        $this->assertEquals(1, Article::count());

        $article = Article::first();

        $this->assertEquals($this->inputs['title'], $article->title);
        $this->assertEquals($this->inputs['body'], $article->body);
    }

    public function test_failed_request_validation()
    {
        $this->inputs['title'] = '';

        $response = $this->json('POST', $this->defaultRoute, $this->inputs);
        $response->assertStatus(422);
        $this->assertEquals(0, Article::count());
    }

    public function test_throw_exception_on_store_an_article()
    {
        $this->inputs['cover'] = "Hello";

        $response = $this->json('POST', $this->defaultRoute, $this->inputs);
        $response->assertStatus(500);
    }

    public function test_can_create_an_article_with_save_cover()
    {
        $filename = 'icon-css.jpg';
        $this->inputs['cover'] = new UploadedFile(resource_path('test-files/' . $filename), $filename);

        $response = $this->json('POST', $this->defaultRoute, $this->inputs);
        $response->assertStatus(201);
    }
}
