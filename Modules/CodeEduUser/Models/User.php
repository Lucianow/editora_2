<?php

namespace CodeEduUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TableInterface
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword(){
        return bcrypt(str_random(8));
    }


    //Headers da tabela index
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail'];
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
            case 'E-mail':  return $this->email;
        }
    }
}
