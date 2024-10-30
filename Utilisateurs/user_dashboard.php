<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=sql310.infinityfree.com;dbname=if0_37599739_siga', 'if0_37599739', 'hvkeB0d1z0pp');

// Récupération des commandes
$query = $pdo->query("SELECT * FROM orders");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord utilisateur</title>
    <style>
        /* Styles de base */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    margin: 20px 0;
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border-radius: 8px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 12px 15px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e9f5f0;
}

/* Statuts de commande */
.status-approved {
    background-color: #28a745;
    color: white;
    padding: 5px 8px;
    border-radius: 4px;
    text-align: center;
}

.status-pending {
    background-color: #ffc107;
    color: black;
    padding: 5px 8px;
    border-radius: 4px;
    text-align: center;
}

.status-rejected {
    background-color: #dc3545;
    color: white;
    padding: 5px 8px;
    border-radius: 4px;
    text-align: center;
}

/* Boutons d'action */
button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 12px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    margin: 2px;
}

button:hover {
    background-color: #0056b3;
}

button[onclick*="cancelOrder"] {
    background-color: #dc3545;
}

button[onclick*="cancelOrder"]:hover {
    background-color: #c82333;
}

button[onclick*="reorder"] {
    background-color: #17a2b8;
}

button[onclick*="reorder"]:hover {
    background-color: #117a8b;
}

/* Overlay et popup */
#orderDetailsOverlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

#orderDetailsPopup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    max-width: 600px;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    overflow-y: auto;
    max-height: 80vh;
}

#orderDetailsPopup h2 {
    margin-top: 0;
    color: #333;
    font-size: 1.5em;
}

#orderDetailsContent {
    font-size: 14px;
    line-height: 1.5;
    color: #555;
}

#orderDetailsPopup button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    margin-top: 15px;
    float: right;
}

#orderDetailsPopup button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    table, th, td {
        display: block;
        width: 100%;
    }

    th {
        text-align: left;
    }

    tr {
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }

    td {
        display: flex;
        justify-content: space-between;
        padding: 8px 15px;
        font-size: 14px;
    }

    td:before {
        content: attr(data-label);
        font-weight: bold;
        color: #333;
    }

    #orderDetailsPopup {
        width: 90%;
        padding: 15px;
    }

    button {
        font-size: 12px;
        padding: 6px 10px;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.5em;
    }

    button {
        padding: 5px 8px;
        font-size: 12px;
    }

    #orderDetailsPopup {
        width: 100%;
        max-width: 350px;
    }
}

    </style>
</head>
<body>
    <h1>Tableau de bord utilisateur</h1>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Date de commande</th>
            <th>Date de livraison prévue</th>
            <th>Mode de livraison</th>
            <th>Pays</th>
            <th>Ville</th>
            <th>Adresse de livraison</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['nom_commanditaire']) ?></td>
                <td><?= htmlspecialchars($order['email_commanditaire']) ?></td>
                <td><?= htmlspecialchars(date('Y-m-d', strtotime($order['date_commande']))) ?></td>
                <td><?= htmlspecialchars(date('Y-m-d', strtotime($order['date_livraison_prevue']))) ?></td>
                <td><?= htmlspecialchars(ucfirst($order['mode_livraison'])) ?></td>
                <td><?= htmlspecialchars($order['pays']) ?></td>
                <td><?= htmlspecialchars($order['ville']) ?></td>
                <td><?= htmlspecialchars($order['adresse_livraison']) ?></td>
                <td class="<?= isset($order['status']) ? ($order['status'] == 'approved' ? 'status-approved' : ($order['status'] == 'pending' ? 'status-pending' : 'status-rejected')) : 'status-pending' ?>">
                    <?= isset($order['status']) ? htmlspecialchars(ucfirst($order['status'])) : 'En attente' ?>
                </td>
                <td>
                    <button onclick="showOrderDetails(<?= $order['id'] ?>)">Afficher</button>
                    <button onclick="reorder()">Relancer</button>
                    <button onclick="cancelOrder(<?= $order['id'] ?>)">Annuler</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Overlay et popup de détails de commande -->
    <div id="orderDetailsOverlay" onclick="closePopup()"></div>
    <div id="orderDetailsPopup">
        <h2>Détails de la commande</h2>
        <div id="orderDetailsContent"></div>
        <button onclick="closePopup()">Fermer</button>
    </div>

    <script>
        function showOrderDetails(orderId) {
            // Requête AJAX pour obtenir les détails de la commande
            fetch('order_details.php?id=' + orderId)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById('orderDetailsContent').innerHTML = `<p>${data.error}</p>`;
                    } else {
                        // Affichage de toutes les informations dans la popup
                        document.getElementById('orderDetailsContent').innerHTML = `
                            <strong>Objet de la demande :</strong> ${data.objet_demande}<br>
                            <strong>Nom du commanditaire :</strong> ${data.nom_commanditaire}<br>
                            <strong>Email :</strong> ${data.email_commanditaire}<br>
                            <strong>Téléphone :</strong> ${data.telephone}<br>
                            <strong>Matricule :</strong> ${data.matricule}<br>
                            <strong>Date de livraison prévue :</strong> ${data.date_livraison_prevue}<br>
                            <strong>Mode de livraison :</strong> ${data.mode_livraison}<br>
                            <strong>Pays :</strong> ${data.pays}<br>
                            <strong>Ville :</strong> ${data.ville}<br>
                            <strong>Adresse de livraison :</strong> ${data.adresse_livraison}<br>
                            <strong>Région :</strong> ${data.region}<br>
                            <strong>Code postal :</strong> ${data.code_postal}<br>
                            <strong>Secteur d'entreprise :</strong> ${data.secteur_entreprise}<br>
                            <strong>Type de dépense :</strong> ${data.type_depense}<br>
                            <strong>Produit :</strong> ${data.produit}<br>
                            <strong>Quantité :</strong> ${data.quantite}<br>
                            <strong>Budget :</strong> ${data.budget}<br>
                            <strong>Qualité du produit :</strong> ${data.qualite_produit}<br>
                            <strong>Informations supplémentaires :</strong> ${data.informations}<br>
                            <strong>Statut :</strong> ${data.status}<br>
                        `;
                    }
                    document.getElementById('orderDetailsOverlay').style.display = 'block';
                    document.getElementById('orderDetailsPopup').style.display = 'block';
                });
        }

        function closePopup() {
            document.getElementById('orderDetailsOverlay').style.display = 'none';
            document.getElementById('orderDetailsPopup').style.display = 'none';
        }


        function reorder() {
            // Redirection vers la page de commande
            window.location.href = "https://siga.rf.gd/Conditions/";
        }

        function cancelOrder(orderId) {
            // Demande de confirmation
            if (confirm("Êtes-vous sûr de vouloir annuler cette commande ?")) {
                // Requête AJAX pour supprimer la commande
                fetch('cancel_order.php?id=' + orderId, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Commande annulée avec succès !");
                        location.reload(); // Rafraîchit la page pour mettre à jour la liste des commandes
                    } else {
                        alert("Erreur lors de l'annulation de la commande : " + data.error);
                    }
                });
            }
        }

    </script>
</body>
</html>
