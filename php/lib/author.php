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
//   echo ($newAuthor-> getAuthorId()),($newAuthor-> getAuthorActivationToken()),($newAuthor-> getAuthorAvatarUrl()),($newAuthor-> getAuthorEmail()),($newAuthor-> getAuthorHash()),($newAuthor-> getAuthorUsername());
   //var_dump($newAuthor);

//$newAuthor = new Author("9d3caa41-038f-481e-8c91-e054303f235b", "afa1fed7-7040-4251-a9e0-70aac82ac5ff", "www.google.com", email@email.com, a1960181-9648-43a6-b1d5-c2aa3b156f90, $hash,);