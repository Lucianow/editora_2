<?php

namespace CodePub\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed id
 * @property mixed name
 */
class Category extends Model implements TableInterface
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];

    //Relacionamento categoria com livro
    public function books(){
        return $this->belongsToMany(Book::class);
    }

    //Headers da tabela index
    public function getTableHeaders()
    {
        return ['#', 'Nome'];
    }

    /**
     * @param string $header
     * @return mixed
     * retorno da categories para popular tabela em index
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':       return $this->id;
            case 'Nome':    return $this->name;
        }
    }
}
