<?php
// Variables à tester (normalement extraites du formulaire)
$pays = $_POST['pays'];
$budget = $_POST['Budget'];
$quantite = $_POST['quantite'];
$produit = $_POST['Produit'];
$date_commande = $_POST['date_commande'];
$date_livraison = $_POST['date_livraison_prevue'];
$matricule = $_POST['matricule'];

// Conditions à respecter
$conditions_respectees = true;
$messages_ia = [];

// Condition 1 : Vérifier si le pays est le Bénin
if ($pays !== 'benin') {
    $messages_ia[] = "❌ Le pays de livraison est hors zone autorisée. Actuellement, les commandes ne peuvent être livrées qu'au Bénin.";
    $conditions_respectees = false;
} else {
    $messages_ia[] = "✅ Pays conforme. Livraison possible au Bénin.";
}

// Conditions de vérification du budget
$montant_minimum = 100000;
$montant_maximum = 5000000;

if ($budget < $montant_minimum) {
    $messages_ia[] = "❌ Budget insuffisant. Un minimum de $montant_minimum XOF est requis.";
    $conditions_respectees = false;
} elseif ($budget > $montant_maximum) {
    $messages_ia[] = "❌ Budget trop élevé. Le maximum autorisé est de $montant_maximum XOF.";
    $conditions_respectees = false;
} else {
    $messages_ia[] = "✅ Budget acceptable.";
}

// Condition de vérification de la quantité en fonction du stock pour n'importe quel produit
$stock_disponible = 100;
$quantite_max = 500;
$produit = $_POST['Produit'];

if ($quantite > $quantite_max) {
    $messages_ia[] = "❌ La quantité demandée pour $produit dépasse la limite maximale de $quantite_max.";
    $conditions_respectees = false;
} elseif ($quantite > $stock_disponible) {
    // Calcul de la quantité possible à commander en cas de surplus
    $quantite_possible = $stock_disponible; // Quantité maximale possible en fonction du stock disponible
    $messages_ia[] = "✅ Vous ne pouvez que commander $quantite_possible $produit, car vous avez $stock_disponible $produit en stock.";
    $conditions_respectees = true; // La demande est valide
} else {
    $messages_ia[] = "✅ Vous pouvez commander $quantite $produit. Quantité disponible en stock.";
    $conditions_respectees = true; // La demande est valide
}


// Condition 4 : Vérifier la date de commande
$date_aujourdhui = date("Y-m-d");
if ($date_commande < $date_aujourdhui) {
    $messages_ia[] = "❌ La date choisie est antérieure à aujourd'hui. Veuillez choisir une date valide.";
    $conditions_respectees = false;
} else {
    $messages_ia[] = "✅ Date de commande valide.";
}

// Condition 5 : Vérifier que la date de livraison n'est pas dans le passé
if ($date_livraison < $date_aujourdhui) {
    $messages_ia[] = "❌ La date de livraison choisie est antérieure à aujourd'hui. Veuillez choisir une date de livraison valide.";
    $conditions_respectees = false;
} else {
    $messages_ia[] = "✅ Date de livraison valide.";
}

// Condition 6 : Vérifier la matricule de l'employé
$matricule_valide = 'SIGA_00306688';
if ($matricule !== $matricule_valide) {
    $messages_ia[] = "❌ Matricule invalide.";
    $conditions_respectees = false;
} else {
    $messages_ia[] = "✅ Matricule reconnu.";
}

// Conversion des messages pour JavaScript
$messages_json = json_encode($messages_ia);
?>

<!-- HTML pour afficher le texte -->
<div id="analyse_ia"><p><strong>IA :</strong></p></div>

<!-- Script JavaScript pour le typewriter et l'auto-scroll -->
<script>
    const messages = <?php echo $messages_json; ?>;
    const container = document.getElementById('analyse_ia');

    let messageIndex = 0;
    async function afficherMessage(message) {
        const paragraph = document.createElement("p");
        container.appendChild(paragraph);
        for (let char of message) {
            paragraph.textContent += char;
            await new Promise(resolve => setTimeout(resolve, 50)); // Vitesse de frappe
        }
        paragraph.scrollIntoView({ behavior: 'smooth' });
        await new Promise(resolve => setTimeout(resolve, 800)); // Pause entre les messages
    }

    async function typeMessage() {
        for (let message of messages) {
            await afficherMessage(message);
        }

        // Redirection selon les résultats
        if (<?php echo json_encode($conditions_respectees); ?>) {
            await afficherMessage("🎉 Votre commande a été analysée avec succès et est en cours de traitement par SIGA AI pour finalisation.");
            setTimeout(() => window.location.href = "succes.php", 2000);
        } else {
            await afficherMessage("⚠️ Échec de l'analyse de votre commande. Merci de réessayer ou de contacter l'assistance SIGA AI.");
            setTimeout(() => window.location.href = "error.php", 2000);
        }
    }

    // Lance le typewriter au chargement de la page
    window.onload = typeMessage;
</script>


<?php
// Configuration de la base de données
$host = 'sql310.infinityfree.com'; // ou l'adresse de votre serveur de base de données
$dbname = 'if0_37599739_siga';
$username = 'if0_37599739'; // Remplacez par votre nom d'utilisateur
$password = 'hvkeB0d1z0pp'; // Remplacez par votre mot de passe

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Préparation de la requête d'insertion
    $stmt = $pdo->prepare("INSERT INTO orders (
        objet_demande,
        nom_commanditaire,
        email_commanditaire,
        telephone,
        matricule,
        date_commande,
        date_livraison_prevue,
        mode_livraison,
        pays,
        ville,
        adresse_livraison,
        region,
        code_postal,
        secteur_entreprise,
        type_depense,
        produit,
        quantite,
        budget,
        qualite_produit,
        informations
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Exécution de la requête avec les données du formulaire
    $stmt->execute([
        $_POST['objet_demande'],
        $_POST['nom_commanditaire'],
        $_POST['email_commanditaire'],
        $_POST['telephone'],
        $_POST['matricule'],
        $_POST['date_commande'],
        $_POST['date_livraison_prevue'],
        $_POST['mode_livraison'],
        $_POST['pays'],
        $_POST['ville'],
        $_POST['adresse_livraison'],
        $_POST['region'],
        $_POST['code_postal'],
        $_POST['secteur_entreprise'],
        $_POST['type_depense'],
        $_POST['Produit'],
        $_POST['quantite'],
        $_POST['Budget'],
        $_POST['qualite_produit'],
        $_POST['informations']
    ]);

    echo "";
} catch (PDOException $e) {
    echo "" . $e->getMessage();
}

// Fermer la connexion
$pdo = null;
?>

<style>
    /* Style pour la boîte de message */
    #analyse_ia {
        width: 95%;
        max-width: 95%;
        height: 90vh;
        margin: 20px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(221, 221, 221, 0.5);
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: left;
        font-family: Arial, sans-serif;
        font-size: 1.5rem; /* Taille de police par défaut */
        color: #333;
        overflow-y: auto;
    }

    #analyse_ia p {
        line-height: 1.6;
        margin: 10px 0;
    }

    /* Style pour les messages d'erreur et de succès */
    .error-message {
        color: #d9534f;
    }

    .success-message {
        color: #5cb85c;
    }

    /* Animation de type typewriter */
    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        overflow: hidden;
        background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
        animation: gradient 15s ease infinite;
        background-size: 400% 400%;
        background-attachment: fixed;
    }

    @keyframes gradient {
        0% { background-position: 0% 0%; }
        50% { background-position: 100% 100%; }
        100% { background-position: 0% 0%; }
    }

    .wave {
        background: rgb(255 255 255 / 25%);
        border-radius: 1000% 1000% 0 0;
        position: fixed;
        width: 200%;
        height: 12em;
        animation: wave 10s -3s linear infinite;
        transform: translate3d(0, 0, 0);
        opacity: 0.8;
        bottom: 0;
        left: 0;
        z-index: -1;
    }

    .wave:nth-of-type(2) {
        bottom: -1.25em;
        animation: wave 18s linear reverse infinite;
        opacity: 0.8;
    }

    .wave:nth-of-type(3) {
        bottom: -2.5em;
        animation: wave 20s -1s reverse infinite;
        opacity: 0.9;
    }

    @keyframes wave {
        2% { transform: translateX(1); }
        25% { transform: translateX(-25%); }
        50% { transform: translateX(-50%); }
        75% { transform: translateX(-25%); }
        100% { transform: translateX(1); }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #analyse_ia {
            font-size: 1.8rem; /* Police plus grande pour les tablettes */
            height: 85vh;
        }
    }

    @media (max-width: 480px) {
        #analyse_ia {
            font-size: 2.5rem; /* Police encore plus grande pour les téléphones */
            height: 80vh;
        }
    }
</style>
