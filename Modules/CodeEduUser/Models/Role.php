<?php

namespace CodeEduUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model implements TableInterface
{
    use Notifiable;

    protected $fillable = [
        'name', 'description'
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    //Headers da tabela index
    public function getTableHeaders()
    {
        return ['Papel', 'Descrição'];
    }

    /**
     * @param string $header
     * @return mixed
     * retorno da categories para popular tabela em index
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Papel':    return $this->name;
            case 'Descrição':    return $this->description;


        }
    }
}
