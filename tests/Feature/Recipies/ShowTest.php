<?php

use App\Models\Recipie;

it('should return a recipie', function() {

    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'Test Category',
    ]);
    $id = $recipie->id;
   
    $response = $this->getJson("/api/V1/recipies/{$id}");
    $response->assertOk()
    ->assertJsonStructure([
        'id',
        'title',
        'image',
        'ingredients',
        'instructions',
        'category',
    ])
    ->assertExactJson([
        'id' => $id,
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'Test Category',
    ]);

});

it('should not return a recipie', function() {

    $response = $this->getJson('/api/V1/recipies/1');
    $response->assertNotFound()
    ->assertExactJson([
        'message' => __('Recipie not found'),
    ]);
});