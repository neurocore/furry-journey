<?php

namespace App\Http\Requests;

use App\User;
use App\Genre;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user has role author and 
     *  genre is correct to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::find($this->input('author_id'));
        if ($user === null)                    return false; // Пользователя не существует
        if ($user->hasRole('author') === null) return false; // Пользователь не является автором

        $genre_ids = $this->input('genre_ids');
        foreach ($genre_ids as $genre_id)
            if (Genre::find($genre_id) === null)
                return false; // Такого жанра не существует
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'year' => 'required|numeric',
            'author_id' => 'required',
        ];
    }
}
