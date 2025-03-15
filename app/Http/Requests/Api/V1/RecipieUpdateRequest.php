<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class RecipieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isPatch = $this->isMethod('patch');

        if($isPatch) {
            
            return [
                'title' => 'sometimes|required|string',
                'image' => 'sometimes|url|nullable',
                'ingredients' => 'sometimes|required|string',
                'instructions' => 'sometimes|required|string',
                'category' => 'sometimes|required|string|in:breakfast,lunch,dinner,snack',
            ];

        } else {

            return [
                'title' => 'required|string',
                'image' => 'url|nullable',
                'ingredients' => 'required|string',
                'instructions' => 'required|string',
                'category' => 'required|string|in:breakfast,lunch,dinner,snack',
            ];
        }
    }
}
