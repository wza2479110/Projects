<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Article.php';

use src\Models\Article as Article;
use src\Models\User as User;

class ArticleRepository extends Repository {

	/**
	 * @return Article[]
	 */
	public function getAllArticles(): array {
        // TODO
        $sqlStatement = $this->mysqlConnection->prepare('SELECT * FROM articles');
        $sqlStatement->execute();
        $resultSet = $sqlStatement->get_result();

        $articles = [];
        while ($row = $resultSet->fetch_assoc()) {
            $articles[] = new Article($row);
        }

        return $articles;
    }

	/**
	 * @param int $id
	 * @return Article|false Post object if it was found, false otherwise
	 */
	public function getArticleById(int $id): Article|false {
		// TODO
		$sqlStatement = $this->mysqlConnection->prepare('SELECT id, title, url, created_at, updated_at, author_id FROM articles WHERE id = ?');
		$sqlStatement->bind_param('i', $id); // 'i' meaning integer parameter
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();
		return $resultSet === false ? false : new Article($resultSet->fetch_assoc());
	}

	/**
	 * @param string $title
	 * @param string $url
	 * @param int $authorId
	 * @return Article|false the newly created Article object, or false in the case of a failure to save or retrieve the new record
	 */
	public function saveArticle(string $title, string $url, int $authorId): Article|false {
		if ($this->mysqlConnection->connect_error) 
		{
			die("Connection failed: " . $this->mysqlConnection->connect_error);
		}

		$createdAt = date('Y-m-d H:i:s');
		$sqlStatement = $this->mysqlConnection->prepare("INSERT INTO articles (title, url, created_at, updated_at, author_id) VALUES (?, ?, ?, NULL, ?)");
		$sqlStatement->bind_param('sssi', $title, $url, $createdAt, $authorId);
		$success = $sqlStatement->execute();

		if ($success) 
		{
			$articleId = $this->mysqlConnection->insert_id;
			$article = $this->getArticleById($articleId);
			return $article;
		}
		return false;
	}

	/**
	 * @param int $id
	 * @param string $title
	 * @param string $url
	 * @return bool
	 */
	public function updateArticle( int $id, string $title, string $url): bool 
	{
		// TODO
		if ($this->mysqlConnection->connect_error) 
		{
			die("Connection failed: " . $this->mysqlConnection->connect_error);
		}

		$updateAt = date('Y-m-d H:i:s');
		$sqlStatement = $this->mysqlConnection -> prepare("UPDATE articles SET updated_at = ?, title = ?, url = ? WHERE id = ?");
		$sqlStatement -> bind_param('sssi', $updateAt, $title, $url, $id);
		$success = $sqlStatement->execute();

		if ($success) 
		{
		
			return true;
		}
		return false;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function deleteArticle(int $id): bool {
		// TODO
		$sqlStatement = $this->mysqlConnection->prepare('DELETE FROM articles WHERE id = ?');
		$sqlStatement->bind_param('i', $id); // 'i' meaning integer parameter
		$sqlStatement->execute();
		$resultSet = $sqlStatement->get_result();
		return $resultSet === false ? false : true;
	}

	/**
	 * Given the ID of an article, return the associated User
	 *
	 * @param int $articleId
	 * @return User|false
	 */
	public function getArticleAuthor(int $articleId): User|false {
		$sqlStatement = $this->mysqlConnection->prepare(
			"SELECT users.id, users.name, users.email, users.password_digest, users.profile_picture FROM users INNER JOIN articles a ON users.id = a.author_id WHERE a.id = ?;"
		);
		$sqlStatement->bind_param('i', $articleId);
		$success = $sqlStatement->execute();
		if ($success) {
			$resultSet = $sqlStatement->get_result();
			if ($resultSet->num_rows === 1) {
				return new User($resultSet->fetch_assoc());
			}
		}
		return false;
	}

}
