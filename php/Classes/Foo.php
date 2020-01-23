<?php

require_once ("autoload.php");

/**
 * Author Class
 *
 * This is a author class for Phase 1 of Object Oriented PHP
 *
 * @author Matthew Urrea <matt.urrea.code@gmail.com>
 */

class Author {
	/**
	 *id for the author; this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * id for author's activation token
	 * @var Uuid $authorActivationToken
	 */
	private $authorActivationToken;
	/**
	 * URL for the author's avatar
	 * @var string $authorAvatarUrl
	 */
	public $authorAvatarUrl;
	/**
	 * Email of the author
	 * @var string $authorEmail
	 */
	public $authorEmail;
	/**
	 * id for author's password
	 * @var Uuid $authorHash
	 */
	private $authorHash;
	/**
	 * author's username
	 * @var string $authorUsername
	 */
	public $authorUsername;

	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id
	 */
	private function getAuthorId(): Uuid {
		return ($this->authorId);
	}

	/**
	 * accessor method for author activation token
	 *
	 * @return Uuid value of activation token
	 */
	private function getAuthorActivationToken(): Uuid {
		return ($this->authorActivationToken);
	}

	/**
	 * accessor method for author avatar URL
	 *
	 * @return string of author avatar URL
	 */
	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	};
};