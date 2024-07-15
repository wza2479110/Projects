<?php

namespace src\Models;

require_once 'Model.php';

class Article extends Model {

}


/* Commenting unlike Assign01, should not do this:
   id int auto_increment not null primary key,
   title varchar(255) not null,
   url varchar(255) not null,
   created_at datetime not null,
   updated_at datetime,
   author_id int not null,
   foreign key (author_id) references users (id)

   namespace src\Models;

   require_once 'Model.php';

   class Article extends Model 
{
    public $id;
    public $title;
    public $url;
    public $create_at_datetime;
    public $updated_at_datetime;
    public $author_id;
    
    public function __construct(string $theId = "", string $theTitle = '', string $theUrl = '', 
                                string $createDate = '', string $updateDate = '', string $authorId = '') 
	{
        $this->setId($theId);
		$this->setTitle($theTitle);
		$this->setUrl($theUrl);
        $this->setCreateDate($createDate);
        $this->setUpdateDate($updateDate);
        $this->setAuthorID($authorId);
	}

    public function getId(): string 
    {
		return $this->id;
	}

	public function setId(string $id): void 
    {
		$this->id = $id;
	}

    public function getTitle(): string 
    {
		return $this->title;
	}

	public function setTitle(string $title): void 
    {
		$this->title = $title;
	}

	public function getUrl(): string 
    {
		return $this->url;
	}

	public function setUrl(string $url): void 
    {
		$this->url = $url;
	}

    public function getCreateDate(): string 
    {
		return $this->create_at_datetime;
	}

	public function setCreateDate(string $createDate): void 
    {
		$this->create_at_datetime = $createDate;
	}

    public function getUpdateDate(): string 
    {
		return $this->updated_at_datetime;
	}

	public function setUpdateDate(string $updateDate): void 
    {
		$this->updated_at_datetime = $updateDate;
	}

    public function getAuthorId(): string 
    {
		return $this->author_id;
	}

	public function setAuthorId(string $authorId): void 
    {
		$this->author_id = $authorId;
	}

    public function fill(array $articleDate): Article 
    {
		foreach ($articleDate as $key => $value) 
        {
			$this->{$key} = $value;
		}
		return $this;
	}
}
 */

