<?php
   namespace MatthewUrrea\ObjectOriented;

   require_once (dirname(__DIR__)) . "/Classes/autoload.php";
   require_once (dirname(__DIR__)) . "/vendor/autoload.php";

   use MatthewUrrea\ObjectOriented\Author;
   use Ramsey\Uuid\Uuid;

   $hash = password_hash("password", PASSWORD_ARGON2I, ["time_cost" => 7]);
   var_dump($hash);

   $newAuthor = new Author("ff81b6a8-7186-454a-9c75-0c5b95039b1d", "24234234324234234234234234234343", "ProfilePic.com", "gmail@gmail.com", $hash, "a;lsdjf;ajhe;o");
   var_dump($newAuthor);