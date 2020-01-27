<?php

require_once ("autoload.php");
require_once (dirname(__DIR__)) . "/vendor/autoload.php";


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
	 * mutator method for author id
	 *
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 **/
	private function setAuthorId ( $newAuthorId) : void {
		try{
				$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
				$exceptionType = get_class($exception);
				throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store author id
		$this->authorId=$uuid;
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
	 * mutator method for author activation token
	 * @param string| Uuid $newAuthorActivationToken new value of author activation token
	 * @throws \RangeException if $newAuthorActivationToken is not positive
	 * @throws \TypeError if $newAuthorActivationToken is not an integer
	 **/
	private function setAuthorActivationToken( $newAuthorActivationToken) : void {
		try{
			$uuid = self::validateUuid($newAuthorActivationToken);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptiontype = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception) );
		}

		//convert and store the author activation token
		$this->authorActivationToken = $uuid;
	}

	/**
	 * accessor method for author avatar URL
	 *
	 * @return string of author avatar URL
	 */
	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	}
}

/**
 * mutator method for author avatar URL
 *
 * @param string $newAuthorAvatarUrl new value for author avatar URL
 * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
 * @throws \RangeException if $newAuthorAvatarUrl is > 255 characters
 * @throws \TypeError if $newAuthorAvatarUrl is not a string
 */
public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {
	//verify the author avatar url is secure
	$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
	$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newAuthorAvatarUrl) === true) {
		throw(new \InvalidArgumentException("author avatar is empty or insecure"));
	}

	//verify the author avatar url will fit in the database
	if(strlen($newAuthorAvatarUrl) > 255) {
		throw(new \RangeException("author avatar url is too large"));
	}

	//store the author avatar url
	$this->authorAvatarUrl = $newAuthorAvatarUrl;
}

