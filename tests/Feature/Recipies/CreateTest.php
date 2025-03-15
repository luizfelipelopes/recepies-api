<?php

beforeEach(function () {
    
    $setupResponse = $this->getJson('/api/setup');
    auth()->logout();
    $this->tokens = $setupResponse->json();    
    $this->token = $this->tokens['crud'];

    $this->data = [
        'title' => 'Test Recipie',
        'image' => null,
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];
});

it('should not create a not authenticated user', function () {

    auth()->logout();

    $response = $this->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(401);

});

it('should not create a not authorized user', function () {

    $token = $this->tokens['basic'];

    $this->withToken($token)
    ->postJson('/api/V1/recipies', $this->data)
    ->assertStatus(403);

});

it('should create a recipie with image', function () {

    $this->data['image'] = 'https://via.placeholder.com/150';

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(201)
    ->assertExactJson(array_merge(['id' => 1], $this->data));

});

it('should create a recipie without image', function () {

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(201)
    ->assertExactJson(array_merge(['id' => 1], $this->data));

});

it('should validate a image that is not a url', function() {

    $this->data['image'] = 'teste';

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);
});

it('should validate a title empty', function () {

    $this->data['title'] = null;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);
});

it('should validate a title that is not a string', function () {

    $this->data['title'] = 1234;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);
});

it('should validate a ingredients empty', function () {

    $this->data['ingredients'] = null;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);

});

it('should validate a ingredients that is not a text', function () {
    
    $this->data['ingredients'] = 1234;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);
});


it('should validate a instructions empty', function () {

    $this->data['instructions'] = null;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);

});

it('should validate a instructions that is not a text', function () {

    $this->data['instructions'] = 1234;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);

});

it('should validate a category empty', function () {

    $this->data['category'] = null;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);

});

it('should validate a category that is not a string', function () {

    $this->data['category'] = 1234;

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);

});

it('should validate a category that is invalid', function () {

    $this->data['category'] = 'teste';

    $response = $this->withToken($this->token)
    ->postJson('/api/V1/recipies', $this->data);
    $response->assertStatus(422);

});
