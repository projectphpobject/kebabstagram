<?php
namespace  App\Models;
use App\Models\User;
use App\Models\Commentaires;
class Photo extends \Illuminate\DataBase\Eloquent\Model
{
	protected $table = "photos";
	protected $primaryKey = "id";
	public $timestamps = true;



    public function user()
    {
        return $this->belongsTo("\App\Models\User", "id_user");
    }


    public function commentaires()
    {
        return $this->hasMany("\App\Models\Commentaires", "id_photo");
    }
}