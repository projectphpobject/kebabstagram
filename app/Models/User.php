<?php
namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected  $table = 'users';
    protected $primaryKey = "id";
    public $timestamps = false;
    protected  $fillable = [
        'pseudo',
        'nom',
        'prenom',
        'email',
        'password',

    ];

    public function setPassword($password)
    {
        $this->update([
            'password'  =>  password_hash($password, PASSWORD_DEFAULT)


        ]);


    }


    public function photos()
    {
        return $this->hasMany('\App\Models\Photo',"id_user");
    }



}



