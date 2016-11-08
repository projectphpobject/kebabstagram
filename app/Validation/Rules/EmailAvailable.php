<?php

namespace App\Validation\Rules;
use App\Models\User;
use Respect\Validation\RUles\AbstractRule;
class EmailAvailable extends AbstractRule
{

   public function validate($input)
   {
      return User::where('email',$input)->count()=== 0;
   }


}