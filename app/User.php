<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','mobile','service_address','billing_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token){ // $this->notify(new MyCustomResetPasswordNotification($token)); <--- remove this line, use Mail instead like below:

    $data = [ $this->email ]; 
    Mail::send('emails.reset-password', [ 'name' => $this->name, 'reset_url' => route('password.reset', ['token' => $token, 'email' => $this->email]), ], function($message) use($data){ $message->subject('Reset Password Request'); $message->to($data[0]); }); }
}
