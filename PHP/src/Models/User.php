<?php


namespace src\Models;

require_once 'Model.php';

class User extends Model {

}

/*
   id int auto_increment not null primary key,
   password_digest varchar(255),
   email varchar(255) not null unique,
   name varchar(255) not null,
   profile_picture varchar(255) default 'default.jpg'

namespace src\Models;
require_once 'Model.php';

class User extends Model 
{
    public $id;
    public $password;
    public $email;
    public $varchar;
    public $profile_picture;

    public function __construct(string $theId = "", string $thePassword = '', string $theEmail = '', string $theVarchar = '', string $theProfilePicture = '') 
	{
        $this->setId($theId);
		$this->setPassword($thePassword);
		$this->setEmail($theEmail);
        $this->setVarchar($theVarchar);
        $this->setProfilePecture($theProfilePicture);
	}

    public function getId(): string 
    {
		return $this->id;
	}

    public function setId(string $id): void 
    {
		$this->id = $id;
	}

    public function getPassword(): string 
    {
		return $this->password;
	}

    public function setPassword(string $password): void 
    {
		$this->password = $password;
	}

    public function getEmail(): string 
    {
		return $this->email;
	}

    public function setEmail(string $email): void 
    {
		$this->email = $email;
	}

    public function getVarchar(): string 
    {
		return $this->varchar;
	}

    public function setVarchar(string $varchar): void 
    {
		$this->varchar = $varchar;
	}

    public function getProfilePicture(): string 
    {
		return $this->profile_picture;
	}

    public function setProfilePecture(string $profilePicture): void 
    {
		$this->profile_picture = $profilePicture;
	}

    public function fill(array $UserData): User 
    {
		foreach ($UserData as $key => $value) 
        {
			$this->{$key} = $value;
		}
		return $this;
	}
}
*/