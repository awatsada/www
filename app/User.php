<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use \SoapClient;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','level',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    // get called from AuthServiceProvider.php
    public function owns($user, $comment) 
    {
        return $user->id == $comment->user_id;  
    }

    public function isSuperAdmin($user) {
        return ( $user->level == 'admin' );
    }







    private $soapURL;
    private $soapClient;
    private $user;
    private $objUserDetails;
    private $userDetails;
    private $auth;
    private $isLogin;
    private $username;


    public function __construct($auth = null) {
        if($auth) {
            $this->soapURL = "https://passport.psu.ac.th/authentication/authentication.asmx?wsdl";
            $this->soapClient = new SoapClient($this->soapURL);
        }
    }

    public function Authenticate($username, $password) {
        $params = array(
            'username' => $username,
            'password' => $password
        );
        
        $user = $this->soapClient->Authenticate($params);

        if ($user->AuthenticateResult)
        {
            $this->username = $username;
            $this->objUserDetails = $this->soapClient->GetUserDetails($params);
            $this->userDetails = $this->objUserDetails->GetUserDetailsResult->string;
            $this->isLogin = true;

            return true;
        }

        $this->isLogin = false;
        return false;
    }

  //return firstname
    public function getFirstname()
    {
        if ($this->isLogin)
            return $this->userDetails[1];
        return null;
    }

    //return lastname
    public function getLastname()
    {
        if ($this->isLogin)
            return $this->userDetails[2];
        return null;
    }
    
    //return title name
    public function getTitle()
    {
        if ($this->isLogin)
            return $this->userDetails[12];
        return null;
    }

    public function getId() {
        return $this->userDetails[0];
    }

    public function getEmail() {
        return $this->userDetails[13];
    }

    public function getPid() {
        return $this->userDetails[5];
    }







}
