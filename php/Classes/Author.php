<?php

namespace Matthewurrea\ObjectOriented;

require_once ("autoload.php");
require_once (dirname(__DIR__)) . "/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

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
   private $authorAvatarUrl;
   /**
    * Email of the author
    * @var string $authorEmail
    */
   private $authorEmail;
   /**
    * id for author's password
    * @var string $authorHash
    */
   private $authorHash;
   /**
    * author's username
    * @var string $authorUsername
    */
   private $authorUsername;

   /**
    * constructor method for author
    * @param $authorId id for the author
    * @param $authorActivationToken activation token for the author
    * @param $authorAvatarUrl avatar url for the author
    * @param $authorEmail author email
    * @param $authorHash password for the author
    * @param $authorUsername username for the author
    */
   public function __construct($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername) {
      $this->authorId = $authorId;
      $this->authorActivationToken = $authorActivationToken;
      $this->authorAvatarUrl = $authorAvatarUrl;
      $this->authorEmail = $authorEmail;
      $this->authorHash = $authorHash;
      $this->authorUsername = $authorUsername;
   }

   /**
    * accessor method for author id
    *
    * @return Uuid value of author id
    */
   public function getAuthorId(): Uuid {
      return ($this->authorId);
   }

   /**
    * mutator method for author id
    *
    * @param Uuid|string $newAuthorId new value of author id
    * @throws \RangeException if $newAuthorId is not positive
    * @throws \TypeError if $newAuthorId is not a uuid or string
    **/
   public function setAuthorId($newAuthorId): void {
      try {
         $uuid = self::validateUuid($newAuthorId);
      } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
         $exceptionType = get_class($exception);
         throw (new $exceptionType($exception->getMessage(), 0, $exception));
      }

      //convert and store author id
      $this->authorId = $uuid;
   }

   /**
    * accessor method for author activation token
    *
    * @return Uuid value of activation token
    */
   public function getAuthorActivationToken(): ?string {
      return ($this->authorActivationToken);
   }

   /**
    * mutator method for author activation token
    *
    * @param string $newAuthorActivationToken
    * @throws \InvalidArgumentException if the token is not a string or insecure
    * @throws \RangeException if $newAuthorActivationToken is not exactly 32 characters
    * @throws \TypeError if $newAuthorActivationToken is not an string
    **/
   public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
      if($newAuthorActivationToken === null) {
         $this->authorActivationToken = null;
         return;
      }
      $newAuthorActivationToken = strolower(trim($newAuthorActivationToken));
      if(ctype_xdigit($newAuthorActivationToken) === false) {
         throw(new\RangeException("user activation is not valid"));
      }
      //make sure user activation token is only 32 characters
      if(strlen($newAuthorActivationToken) !== 32) {
         throw(new \RangeException("user activation token has to be 32"));
      }
      $this->authorActivationToken = $newAuthorActivationToken;
   }

   /**
    * accessor method for author avatar URL
    *
    * @return string of author avatar URL
    */
   public function getAuthorAvatarUrl(): string {
      return ($this->authorAvatarUrl);
   }

   /**
    * mutator method for author avatar URL
    *
    * @param string $newAuthorAvatarUrl new value for author avatar URL
    * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
    * @throws \RangeException if $newAuthorAvatarUrl is > 255 characters
    * @throws \TypeError if $newAuthorAvatarUrl is not a string
    */
   public function setAuthorAvatarUrl(string $newAuthorAvatarUrl): void {
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

   /**
    * accessor method for author email
    *
    * @return string value of author email
    **/
   public function getAuthorEmail(): string {
      return ($this->authorEmail);
   }

   /**
    * mutator method for author email
    *
    * @param string $newAuthorEmail new value of email
    * @throws \InvalidArgumentException if $newAuthorEmail is not a string or insecure
    * @throws \RangeException if $newAuthorEmail is > 128 characters
    * @throws \TypeError if $newAuthorEmail is not a string
    */
   public function setAuthorEmail(string $newAuthorEmail): void {
      //verify the email is a string and secure
      $newAuthorEmail = trim($newAuthorEmail);
      $newAuthorEmail = filter_var($newAuthorEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
      if(empty($newAuthorEmail) === true) {
         throw(new \InvalidArgumentException("Author Email is empty or insecure"));
      }

      //verify the email will fit in the database
      if(strlen($newAuthorEmail) > 128) {
         throw (new \RangeException("Email is too long"));
      }

      //store email
      $this->authorEmail = $newAuthorEmail;
   }

   /**
    * accessor method for author hash
    *
    * @return string value of author hash
    *
    */
   public function getAuthorHash(): string {
      return $this->authorHash;
   }

   /**
    * mutator method for author hash
    *
    * @param string $newAuthorHash string contatining encrypted password
    * @throws \InvalidArgumentException if the hash is not secure
    * @throws \RangeException if $newAuthorHash is not 97 characters
    * @throws \TypeError if $newAuthorHash is not a string
    */
   public function setAuthorHash(string $newAuthorHash): void {
      //enforce that the hash is properly formatted
      $newAuthorHash = trim($newAuthorHash);
      if(empty($newAuthorHash) === true) {
         throw(new \InvalidArgumentException("author password hash empty or insecure"));
      }
      //enforce the hash is really an Argon hash
      $authorHashInfo = password_get_info($newAuthorHash);
      if($authorHashInfo["algoName"] !== "argon2i") {
         throw(new \InvalidArgumentException("author hash is not a valid hash"));
      }
      //enforce that the hash is exactly 97 characters.
      if(strlen($newAuthorHash) < 96) {
         throw(new \RangeException("author hash must be less than 96 characters"));
      }
      //store the hash
      $this->authorHash = $newAuthorHash;
   }

   /**
    * accessor method for author username
    *
    * @param string $newAuthorUsername
    * @return void value of author username
    */
   public function getAuthorUsername(string $newAuthorUsername): void {
      //verify username is secure
      $newAuthorUsername = trim($newAuthorUsername);
      $newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
      if(empty($newAuthorUsername) === true) {
         throw(new \InvalidArgumentException("username empty or insecure"));
      }

      //verify the username will fit in the database
      if(strlen($newAuthorUsername) > 32) {
         throw (new\InvalidArgumentException("username too long"));
      }
      //store username
      $this->authorUsername = $newAuthorUsername;
   }

   /**
    * insert author into mySQL
    *
    * @param \PDO $pdo PDO connection object
    * @throws \PDOException when my SQL related errors occur
    * @throws \TypeError if $pdo is not a PDO connection object
    **/
   public function insert(\PDO $pdo): void {

      //insert query
      $query = "INSERT INTO author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) VALUES(:authorId, :authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
      $statement = $pdo->prepare($query);
   }

   /**
    * update this author in mySQL
    *
    * @param \PDO $pdo PDO connection object
    * @throws \PDOException when mySQL related errors occur
    * @throws \TypeError if $pdo is not a PDO connection object
    **/
   public function insert(\PDO $pdo): void {

      //update query
      $query = "UPDATE author SET authorId = :authorId, authorActivaitonToken = :authorActivationToken, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername";
      $statement = $pdo->prepare($query);
   }
      /**
       * delete author from mySQL
       *
       * @param \PDO $pdo PDO connection object
       * @throws \PDOException when mySQL related errors occur
       * @throws \TypeError if $pdo is not a PDO connection object
       **/
      public
      function delete(\PDO $pdo): void {
         $query = "DELETE FROM author WHERE authorId = :authorId";
         $statement = $pdo->prepare($query);

      }

   /**
    * gets the author by authorId
    *
    * @param \PDO $pdo PDO connection object
    * @param Uuid|string $authorId tweet id to search for
    * @return Author|null Author found or null if not found
    * @throws \PDOException when mySQL related errors occur
    * @throws \TypeError when a variable are not the correct data type
    **/
   public static function getAuthorbyAuthorId(\PDO $pdo, $authorId) : ?Author {
      // sanitize the authorId before searching
      try {
         $authorId = self::validateUuid($authorId);
      } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
         throw(new \PDOException($exception->getMessage(), 0, $exception));
      }

      // create query template
      $query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
      $statement = $pdo->prepare($query);

      // bind the author id to the place holder in the template
      $parameters = ["authorId" => $authorId->getBytes()];
      $statement->execute($parameters);

      // grab the author from mySQL
      try {
         $author = null;
         $statement->setFetchMode(\PDO::FETCH_ASSOC);
         $row = $statement->fetch();
         if($row !== false) {
            $author = new Author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
         }
      } catch(\Exception $exception) {
         // if the row couldn't be converted, rethrow it
         throw(new \PDOException($exception->getMessage(), 0, $exception));
      }
      return($tweet);
   }


      /**
       * gets the author by author id and returns an array
       *
       * @param \PDO $pdo PDO connection object
       * @param Uuid|string $authorId author id to search by
       * @return \SplFixedArray SplFixedArray of Tweets found
       * @throws \PDOException when mySQL related errors occur
       * @throws \TypeError when variables are not the correct data type
       **/
      public
      static function getAuthorByAuthorId(\PDO $pdo, $authorId): \SplFixedArray {

         try {
            $authorId = self::validateUuid($authorId);
         } catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            throw(new \PDOException($exception->getMessage(), 0, $exception));
         }

         //query template
         $query = "SELECT authorId, authorActivaitonToken, authorAvatarUrl, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
         $statement = $pdo->prepare($query);
         // bind the author id to the place holder in the template
         $parameters = ["authorId" => $authorId->getBytes()];
         $statement->execute($parameters);
         // build an array of authors
         $authors = new \SplFixedArray($statement->rowCount());
         $statement->setFetchMode(\PDO::FETCH_ASSOC);
         while(($row = $statement->fetch()) !== false) {
            try {
               $authors = new author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
               $authors[$authors->key()] = $authors;
               $authors->next();
            } catch(\Exception $exception) {
               // if the row couldn't be converted, rethrow it
               throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
         }
         return ($authors);
      }

}
