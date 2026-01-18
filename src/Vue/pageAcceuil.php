<?php
$titre = "Accueil général / Connexion";
var_dump($isconnecte);
require __DIR__ . '/menu.php';
// <!DOCTYPE html>
// <html lang="fr">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>accueil</title>
//     <style>
//         body {
//             display: flex;
//             justify-content: center;
//             align-items: center;
//             height: 100vh;
//             margin: 0;
//             background-color: #f0f0f0;
//         }


//         .container {
//             display: flex;
//             gap: 20px;
//         }

//         .rectangle {
//             width: 150px;
//             height: 200px;
//             background-color: #4CAF50;
//             color: white;
//             text-align: center;
//             display: flex;
//             align-items: center;
//             justify-content: center;
//             text-decoration: none;
//             font-size: 18px;
//             border-radius: 10px;
//             transition: background-color 0.3s;
//         }

//         .rectangle:hover {
//             background-color: #45a049;
//         }
//     </style>
// </head>
// <body>
?>
<?php
//   echo "Entree dans la vue N°".$isconnecte;
if ($isconnecte == 0) {
    echo '<div class = "container" id = "divLogin">
            <form action="index.php?controleur=accueil&action=connecter"
method="post">

Login :<input type="text" name="LOGIN"><br>
Mot de passe :<input type="password" name="MDP"><br>
<input type="submit" value="Se connecter">
</form>

</div>';

} else if ($isconnecte == 1) {
    $login = $_POST["LOGIN"];
    $mdp = $_POST["MDP"];
    if ($login == "moi" && $mdp == "a") {
        echo '<div class="container" id = "divMenu">
        <a href="index.php?controleur=joueur" class="rectangle">Mes Joueurs</a>
        <a href="index.php?controleur=match" class="rectangle">Matchs</a>
        <a href="pageStats.html" class="rectangle">Statistiques</a>
    </div>';
    } else {
        echo '<div class = "error"> login ou mot de passe incorrect</div><br><br>';
        echo '<div class = "container" id = "divLogin">;
    <form action="index.php?controleur=accueil&action=connecter"
method="post">

Login :<input type="text" name="LOGIN" value="' . $login . '"><br>
Mot de passe :<input type="password" name="MDP" value="' . $mdp . '"><br>
<input type="submit" value="Se connecter">
</form>

</div>';
    }

} else {
    echo '<div class="container" id = "divMenu">
        <a href="index.php?controleur=joueur" class="rectangle">Mes Joueurs</a>
        <a href="index.php?controleur=match" class="rectangle">Matchs</a>
        <a href="pageStats.html" class="rectangle">Statistiques</a>
    </div>';

    header('Location: index.php?controleur=accueil&action=menu');
} ?>
</body>

</html>