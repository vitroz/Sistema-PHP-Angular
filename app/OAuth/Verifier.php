<?php

namespace CodeProject\OAuth;
use Auth;

class Verifier
{
  public function verify($username, $password)
  {
      $credentials = [
        'email'    => $username,
        'password' => $password,
      ];

      if (Auth::once($credentials)) {
          return Auth::user()->id;
      }

          if(Auth::validate(['email' => $username, 'password' => $password])){
              $user = \CodeProject\Entities\User::where('email', $username)->first();

              return $user->id;
          }

        return false;
  }

}
