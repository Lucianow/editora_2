<?php

namespace CodePub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodePub\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        $book = $this->route('book');
//        $id = $book? $book->author_id: NULL;
//        $usuario = Auth::user()->id;
//
//        if ($usuario == $id){
//            return true;
//        }elseif ($id == NULL){
//            return true;
//        }else{
//            return false;
//        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $book = $this->route('book');
//        $id = $book? $book->author_id: NULL;
        return [
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'price' => 'required',
            'author' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'max' => 'O campo :attribute não pode ter mais que 255 caracteres!'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'título|max:255',
            'subtitle' => 'sub-título|max:255',
            'price' => 'preço|numeric',
            'author' => 'autor'
        ];
    }
}

