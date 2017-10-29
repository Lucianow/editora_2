<?php

namespace CodeEduBook\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeEduBook\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

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
            'author' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ];
    }

    public function messages()
    {
        $result = [];
        $categories = $this->get('categories', []);
        $count = count($categories);
        if (is_array($categories) && $count > 0){
            foreach (range(0, $count-1) as $value){
                $field = \Lang::get('validation.attributes.categories_*', ['num' => $value+1]);
                $message = \Lang::get('validation.exists', ['attribute' => $field]);
                $result["categories.$value.exists"] = $message;
            }

        }
        return $result;
    }

    public function attributes()
    {
        return [
            'title' => 'título',
            'subtitle' => 'sub-título',
            'price' => 'preço',
            'author' => 'autor',
            'categorie' => 'categoria',
            'categories' => 'categorias',
            'categories_*' => 'categoria :num',
        ];
    }
}

