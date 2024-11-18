<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Affliate extends Authenticatable implements MustVerifyEmail

    {
        use Notifiable;

        protected $guard = 'affliate';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function affliateSecurity()
{
    return $this->hasOne('App\AffliateSecurity');
}
        public function VerifyAffliate()
{
  return $this->hasOne('App\VerifyAffliate');
}
    }