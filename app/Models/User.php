<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->attributes[$this->primaryKey];
    }
    public function setPic($url)
    {
        $this->setAttribute('pic_profile', $url);
        return $this;
    }

    public function getPic()
    {
        return $this->getAttribute('pic_profile');
    }

    public function setEmail($email)
    {
        $this->setAttribute('email', $email);
        return $this;
    }

    public function getEmail()
    {
        return $this->getAttribute('email');
    }

    public function setName($name)
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function getStatus(){
        if($this->getAttribute('status') != 2){
            return 'HABILITADO';
        }else{
            return 'BLOQUEADO';
        }
    }

    public function setType($type){
        $this->setAttribute('type', $type);
        return $this;
    }
    public function getType(){
        return $this->getAttribute('type');
    }
    public function setStatusNum($status){
        $this->setAttribute('status', $status);
        return $this;
    }

    public function getStatusNum(){
       return $this->getAttribute('status');
    }

}
