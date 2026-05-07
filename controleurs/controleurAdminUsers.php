<?php

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin") {
    header("Location:index.php?page=connexion");
    exit();
}

$message = "";

if (isset($_POST['modifierPlan'])) {

    $idUser = intval($_POST['idUser']);
    $plan   = trim($_POST['plan']);

    /* sécurité : seulement ces valeurs */
    $plansAutorises = ['Standard', 'Premium'];

    if ($idUser > 0 && in_array($plan, $plansAutorises)) {

        /* interdit de modifier admin */
        $stmt = $pdo->prepare("
            SELECT login
            FROM UTILISATEUR
            WHERE idUser = :id
        ");

        $stmt->execute([
            'id' => $idUser
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['login'] != 'admin') {

            $stmt = $pdo->prepare("
                UPDATE UTILISATEUR
                SET plan = :plan
                WHERE idUser = :id
            ");

            $stmt->execute([
                'plan' => $plan,
                'id'   => $idUser
            ]);

            $message = "Plan utilisateur mis à jour.";
        }

    } else {

        $message = "Valeurs invalides.";
    }
}

/* USERS */
$stmt = $pdo->query("
    SELECT idUser, login, plan
    FROM UTILISATEUR
    ORDER BY idUser ASC
");

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* PLAYLISTS */
foreach ($users as &$u) {

    $stmt = $pdo->prepare("
        SELECT titre
        FROM PLAYLIST
        WHERE idUser = :id
    ");

    $stmt->execute([
        'id' => $u['idUser']
    ]);

    $u['playlists'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $u['nbPlaylists'] = count($u['playlists']);
}

unset($u);
?>