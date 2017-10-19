<?php

namespace CodePub\Models;

use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Book extends Model implements TableInterface
{
    use Notifiable;
    use FormAccessible;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id',
    ];

    //Relacionamento usuário com livro
    public function author(){
        return $this->belongsTo(User::class);
    }

    //Relacionamento livro com categoria
    public function categories(){
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    //Para salvar categorias em livro
    public function formCategoriesAttribute(){
        return $this->categories->pluck('id')->all();
    }

    //Headers da tabela index
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Autor', 'Preço'];
    }

    /**
     * @param string $header
     * @return mixed
     * retorno de livros para popular tabela em index
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':           return $this->id;
            case 'Título':      return $this->title;
            case 'Autor':       return $this->author->name;
            case 'Preço':       return $this->price;
        }
    }
}