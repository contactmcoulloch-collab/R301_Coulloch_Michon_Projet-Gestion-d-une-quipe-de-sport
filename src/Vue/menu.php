<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <title><?php echo $titre; ?></title>
</head>

<body>


    <div class="panel titre">
        <h2> <?php echo $titre; ?></h2>
    </div>
    <br><br>
    <div class="container2">
        <div class="col-menu">
            <a href="index.php">Sortir</a> <br>
            <a href="index.php?controleur=accueil&action=menuGen">Menu général</a> <br>
            <a href="index.php?controleur=joueur&action=liste">Joueurs</a> <br>
            <a href="index.php?controleur=match&action=liste">Matchs</a> <br>
            <a href="index.php?controleur=stats&action=liste">Statistiques</a> <br>
        </div>
        <div class="col-body">