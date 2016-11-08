<?php
namespace  App\Models;
use App\Models\Photo;
class Commentaires extends \Illuminate\DataBase\Eloquent\Model
{
	protected $table = "commentaires";
	protected $primaryKey = "id";
	public $timestamps = false;
	
    public function photo() {
            return $this->belongsTo('\App\Models\Photo');
    }

	
}