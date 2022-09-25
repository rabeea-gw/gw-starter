<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Mail\SendResetLinkPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * custom send email to reset password
     *
     * @param  mixed $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $url = config('custom.frontend_url') . "/reset-password?token={$token}";

        Mail::to($this->email)->send(new SendResetLinkPassword($url, $this->name));
    }

    /*
    ===============================
    Relationships
    ===============================
    */
}
