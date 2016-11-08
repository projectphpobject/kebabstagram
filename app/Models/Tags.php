<?php
namespace  App\Models;

class Tags extends \Illuminate\DataBase\Eloquent\Model
{
    protected $table = "tags";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function photo() {
        return $this->belongsTo('Photo');
    }


}