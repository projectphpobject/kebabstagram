<?php
namespace  App\Models;

class Notation extends \Illuminate\DataBase\Eloquent\Model
{
    protected $table = "notation";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function utilisateur()
    {
        return $this->belongsTo("App\Models\User", "id_user");
    }


}