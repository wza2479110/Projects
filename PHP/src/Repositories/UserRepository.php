<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/User.php';

use src\Models\User;

class UserRepository extends Repository {

	/**
	 * @param string $id
	 * @return User|false
	 */
	public function getUserById(string $id): User|false {
		$sqlStatement = $this->mysqlConnection->prepare("SELECT id, password_digest, email, name, profile_picture FROM users WHERE id = ?");
		$sqlStatement->bind_param('i', $id);
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();
		if ($resultSet->num_rows === 1) 
		{
			return (new User($resultSet->fetch_assoc()));
		}
		return false;
	}

	/**
	 * @param string $email
	 * @return User|false
	 */
	public function getUserByEmail(string $email): User|false 
	{
		$sqlStatement = $this->mysqlConnection->prepare("SELECT id, password_digest, email, name, profile_picture FROM users WHERE email = ?");
		$sqlStatement->bind_param('s', $email);
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();
		if ($resultSet->num_rows === 1) 
		{
			return (new User($resultSet->fetch_assoc()));
		}
	}

	/**
	 * @param string $email
	 * @param string $name
	 * @param string $bcryptPasswordDigest
	 * @return User|bool true on success, false on failure - or modify this to return a User if you like!
	 */
	public function saveUser(string $password, string $email, string $name): User|bool {
		if ($this->mysqlConnection->connect_error) 
		{
			die("Connection failed: " . $this->mysqlConnection->connect_error);
		}

		$sqlStatement = $this->mysqlConnection -> prepare("INSERT INTO users (password_digest, email, name, profile_picture) VALUES (?, ?, ?, null)");
		$sqlStatement -> bind_param('sss',$password, $email, $name);
		$success = $sqlStatement->execute();

		if ($success) 
		{
			$UserId = $this->mysqlConnection->insert_id;
			$UserData = $this->getUserById($UserId);
			return $UserData;
		}
		return false;
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @param string|null $profilePicture
	 * @return bool
	 */
	public function updateUser(int $id, string $email, string $name, string $profilePicture = ""): bool 
    {
        if ($profilePicture == "") 
		{
            $sqlStatement = $this->mysqlConnection -> prepare("UPDATE users SET  email = ?, name = ? WHERE id = ?");
            $sqlStatement -> bind_param('ssi', $email, $name, $id);
        } 
		else 
		{
            $sqlStatement = $this->mysqlConnection -> prepare("UPDATE users SET  email = ?, name = ?, profile_picture = ? WHERE id = ?");
            $sqlStatement -> bind_param('sssi', $email, $name, $profilePicture, $id);
        }

        $success = $sqlStatement->execute();

        if ($success) 
        {

            return true;
        }
        return false;
    }

}
