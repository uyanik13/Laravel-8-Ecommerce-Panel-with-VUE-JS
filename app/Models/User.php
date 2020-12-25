<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use App\Notifications\VerifyEmail;
use App\Notifications\ResetPassword;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;



//class User extends Authenticatable implements JWTSubject, MustVerifyEmail
class User extends Authenticatable implements JWTSubject

{
    use HasFactory, SoftDeletes, Notifiable;

  public $incrementing = false;

  public static function boot()
  {
    parent::boot();
    self::creating(function ($model) {
      $model->id = self::generateUuid();
    });
  }

  public static function generateUuid()
  {
    try {
      return Uuid::generate();
    } catch (\Exception $e) {
      return $e;
    }
  }

    //   protected $casts = [
//     'user_data' => 'array'
// ];
  protected $hidden = [
    'password',
    'remember_token',
    'email_verified_at',

  ];

  protected $dates = [
    'updated_at',
    'created_at',
    'deleted_at',
    'email_verified_at',
  ];

  protected $fillable = [
    'name',
    'email',
    'phone',
    'avatar',
    'address',
    'bill_address',
    'password',
    'social_data',
    'about_data',
    'user_data',
    'notification_data',
    'role',
    'status',
    'created_at',
    'updated_at',
  ];


  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims()
  {
    return [];
  }

  /**
   * Allows us to customize the password notification email.
   * See: App/Notifications/ResetPassword.php
   *
   * @param string
   */
  public function sendPasswordResetNotification($token)
  {
    $email = $this->getEmailForPasswordReset();
    $user = $this::where('email', $email)->first();
    $this->notify(new ResetPasswordNotification($token, $user->id));
  }

  /**
   * Send the email verification notification.
   *
   * @return void
   */
  public function sendEmailVerificationNotification()
  {
    $this->notify(new VerifyEmail);
  }


  /**
   * Route notifications for the Nexmo channel.
   *
   * @param \Illuminate\Notifications\Notification $notification
   * @return string
   */
  public function routeNotificationForNexmo($notification)
  {
    return $this->phone;
  }

  public function routeNotificationForChatAPI($notification)
  {
    return $this->phone;
  }

  public function gallery()
  {
    return $this->hasMany('App\Models\Gallery');
  }

  public function comments()
  {
    return $this->hasMany('App\Models\Comment');
  }


  public function payments()
  {
    return $this->hasMany('App\Models\Payment');
  }

  public function credit_cards()
  {
    return $this->hasMany('App\Models\CredtiCard');
  }

  public function orders()
  {
    return $this->hasMany('App\Models\Order');
  }

  public function subscriptions()
  {
    return $this->hasMany('App\Models\Subscription');
  }

  public function contracts()
  {
    return $this->hasMany('App\Models\Contract');
  }

  public function tokenRequests()
  {
    return $this->hasMany('App\Models\TokenRequest');
  }

}
