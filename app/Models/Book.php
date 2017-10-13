<?php

namespace CodePub\Models;

use CodePub\Models\User;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Book extends Model implements TableInterface
{
    use Notifiable;

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id',
    ];

    public function author(){
        return $this->belongsTo(User::class);
    }

    public function getTableHeaders()
    {
        return ['#', 'Título', 'Autor', 'Preço'];
    }

    /**
     * @param string $header
     * @return mixed
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