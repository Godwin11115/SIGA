<?php
$pdo = new PDO('mysql:host=sql310.infinityfree.com;dbname=if0_37599739_siga', 'if0_37599739', 'hvkeB0d1z0pp');

// Mise à jour du statut de commande
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'], $_POST['order_id'])) {
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    $query = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $query->execute([$status, $order_id]);
}

// Récupérer toutes les commandes
$query = $pdo->query("SELECT * FROM orders");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord administrateur</title>
</head>
<body>
    <h1>Tableau de bord administrateur</h1>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Date de commande</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['nom_commanditaire']) ?></td>
                <td><?= htmlspecialchars($order['email_commanditaire']) ?></td>
                <td><?= htmlspecialchars($order['date_commande']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <select name="status" onchange="this.form.submit()">
                            <option value="approved" <?= $order['status'] == 'approved' ? 'selected' : '' ?>>Approuvé</option>
                            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>En attente</option>
                            <option value="rejected" <?= $order['status'] == 'rejected' ? 'selected' : '' ?>>Rejeté</option>
                        </select>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
