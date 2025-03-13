<?php

use App\Models\Recipie;
beforeEach(function () {
    $this->getJson('/api/setup');
});

it('should return a list of recipies', function () {
    
    Recipie::factory()->count(9)->create();
    
    $response = $this->getJson('/api/V1/recipies');
    $response->assertStatus(200)
    ->assertJsonCount(9, 'data')
    ->assertJsonStructure([
        'data' => [ '*' => [
                'id',
                'title',
                'image',
                'ingredients',
                'instructions',
                'category',
            ]
        ],
        'links', 'meta'
    ]);
});


it('should not return a list of recipies', function () {
    
    $response = $this->getJson('/api/V1/recipies');
    $response->assertStatus(200)
    ->assertJsonCount(0, 'data')
    ->assertJsonStructure([
        'data' => [ '*' => [
                'id',
                'title',
                'image',
                'ingredients',
                'instructions',
                'category',
            ]
        ]
    ]);

});

it('should return a list of recipies with pagination', function () {

    Recipie::factory()->count(100)->create();

    $response = $this->getJson('/api/V1/recipies?page=2');
    $response->assertOk()
    ->assertJsonCount(10, 'data')
    ->assertJsonStructure(['links', 'meta']);

}); 
