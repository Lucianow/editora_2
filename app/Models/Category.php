<?php

namespace CodePub\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model implements TableInterface
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];

    public function getTableHeaders()
    {
        return ['#', 'Nome'];
    }

    /**
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':       return $this->id;
            case 'Nome':    return $this->name;
        }
    }
}
