<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_01_01_get_entries(): void
    {
        $response = $this->get('api/entries');
        $response->assertStatus(200);
        $contents = $response->json();
        $entries = $contents['entries'];
        $this->assertArrayHasKey('entryId', $entries[0]);
        $this->assertArrayHasKey('title', $entries[0]);

        $entryId = $entries[0]['entryId'];
        $this->assertIsString($entryId);
        $this->assertMatchesRegularExpression('/\d+/', $entryId);
    }

    public function test_02_01_get_an_entry(): void
    {
        $response = $this->get('api/entries');
        $response->assertStatus(200);
        $contents = $response->json();
        $entries = $contents['entries'];
        $this->assertTrue(count($entries) > 0);
        $one = $entries[0];
        $this->assertArrayHasKey('entryId', $one);
        $entryId = $one['entryId'];
        $response = $this->get("api/entries/{$entryId}");
        $response->assertStatus(200);
        $contents = $response->json();
        $this->assertArrayHasKey('title', $contents);
        $this->assertArrayHasKey('contents', $contents);
        $this->assertArrayHasKey('entryId', $contents);
    }

}