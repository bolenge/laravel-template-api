<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateNewsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_users_can_create_article()
    {
        $this->withoutExceptionHandling();
        $this->assertEquals(0, Article::count());

        $inputs = [
            'title' => 'TDD en Marche',
            'body' => 'Je fais du TDD'
        ];

        $this->json('POST', '/api/articles', $inputs)->assertStatus(201);
        $this->assertEquals(1, Article::count());
        $article = Article::first();

        $this->assertEquals($inputs['title'], $article->title);
        $this->assertEquals($inputs['body'], $article->body);
    }
}
