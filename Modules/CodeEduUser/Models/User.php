<?php

namespace CodeEduUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TableInterface
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword($password = null){
        return !$password ? bcrypt(str_random(8)) : bcrypt($password);
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

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param Collection| string $role
     * @return boolean
     */
    public function hasRole($role){
        return is_string($role) ?
            $this->roles->contains('name', $role):
            (boolean) $role->intersect($this->roles)->count();
    }

    /**
     * @return boolean
     */
    public function isAdmin(){
        return $this->hasRole(config('codeeduuser.acl.role_admin'));
    }
}
