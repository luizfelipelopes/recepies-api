<?php

use App\Models\Recipie;

beforeEach(function () {

    $this->getJson('/api/setup');
    
    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

    $this->id = $recipie->id;

});

it('should update a recipie with image', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertOk()
    ->assertExactJson([
        'id' => 1,
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

});

it('should create a recipie without image', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => null,
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertOk()
    ->assertExactJson([
        'id' => 1,
        'title' => 'Test Recipie',
        'image' => null,
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

});

it('should validate a image that is not a url', function() {
    $data = [
        'title' => 'Test Recipie',
        'image' => 'teste',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});

it('should validate a title that is empty', function () {
    $data = [
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});

it('should validate a title that is not a string', function () {
    $data = [
        'title' => 1234,
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});

it('should validate a ingredients empty', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a ingredients that is not a text', function () {
    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 1234,
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});


it('should validate a instructions empty', function () {
    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a instructions that is not a text', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 1234,
        'category' => 'breakfast',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a category empty', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);


});

it('should validate a category that is not a string', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 1234,
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a category that is invalid', function () {

    $data = [
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'test',
    ];

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});