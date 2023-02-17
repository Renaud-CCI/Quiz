<?php
session_start();
require_once('config.php');

$pseudo = $_GET['pseudo'];

   $req = $db->prepare("SELECT count(id) FROM users WHERE LOWER(pseudo) = :pseudo");
   $req->execute([ 'pseudo' => strtolower($pseudo)
                    ]);

   if($req->fetchColumn() > 0)
   {
    //   echo 'Pseudo déjà utilisé !';
        header('Location: ../login.php?pseudo=' . $pseudo);
   }
   else
   {
    //   echo 'Pseudo libre :-)';
        $request = $db->prepare("INSERT INTO users (pseudo) VALUES (:pseudo)");
        $request->execute([ 'pseudo' => $pseudo
                            ]);
        $_SESSION['pseudo'] = $pseudo;
        header('Location: ../index.php');
   }

   include_once('PHP/header.php');
   include_once('PHP/script.php');
?>


