<?php

use App\Models\Recipie;

it('should delete a recipie', function () {

    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

    $response = $this->deleteJson("/api/V1/recipies/{$recipie->id}");
    $response->assertOk()
    ->assertExactJson([
        'message' => __('Recipie deleted'),
    ]);

});

it('should not delete a recipie inexistent', function () {

    $response = $this->deleteJson("/api/V1/recipies/1");
    $response->assertNotFound()
    ->assertExactJson([
        'message' => __('Recipie not found'),
    ]);

});
