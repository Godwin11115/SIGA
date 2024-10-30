<?php
header('Content-Type: application/json');

try {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=sql310.infinityfree.com;dbname=if0_37599739_siga', 'if0_37599739', 'hvkeB0d1z0pp');

    // Récupération de l'ID de la commande à supprimer
    $orderId = $_GET['id'] ?? null;

    if ($orderId) {
        // Préparation et exécution de la requête pour supprimer la commande
        $stmt = $pdo->prepare("DELETE FROM orders WHERE id = :id");
        $stmt->execute(['id' => $orderId]);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "ID de commande non spécifié."]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => "Erreur : " . $e->getMessage()]);
}
?>
