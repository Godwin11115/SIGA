<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=sql310.infinityfree.com;dbname=if0_37599739_siga', 'if0_37599739', 'hvkeB0d1z0pp');

// Récupération de l'ID de la commande
$orderId = $_GET['id'] ?? null;

if ($orderId) {
    // Préparation et exécution de la requête pour obtenir les détails de la commande
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
    $stmt->execute(['id' => $orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        echo json_encode($order); // Convertit les détails en JSON pour un affichage facile dans la popup
    } else {
        echo json_encode(["error" => "Commande non trouvée."]);
    }
} else {
    echo json_encode(["error" => "ID de commande non spécifié."]);
}
?>
