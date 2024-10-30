<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration Form in HTML CSS</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <section class="container">

    <header>

        <div class="logo-name">
            <div class="logo-image" style="display: flex; justify-content: center; min-width: 45px;">
                <img src="images/logo.svg" alt="" style="width: 40px; object-fit: cover; border-radius: 50%;">
            </div>
            <span class="logo_name">SIGA</span>
        </div>

      Formulaire de commande 

    </header>

      <form action="analyse.php" method="post" class="form">

        <div class="input-box">
            <label>Objet de la Demande</label>
            <input type="text" name="objet_demande" placeholder="Objet de votre demande" required />
        </div>
    
        <div class="input-box">
            <label>Nom du Commanditaire</label>
            <input type="text" name="nom_commanditaire" placeholder="Entrer votre Nom" required />
        </div>
    
        <div class="input-box">
            <label>Email du Commanditaire</label>
            <input type="email" name="email_commanditaire" placeholder="Entrer votre adresse Email" required />
        </div>
    
        <div class="column">
            <div class="input-box">
                <label>Téléphone</label>
                <input type="tel" name="telephone" placeholder="Numéro" required />
            </div>
            <div class="input-box">
                <label>Matricule Employé</label>
                <input type="text" name="matricule" placeholder="Entrer votre ID Employé" required />
            </div>
        </div>
    
        <div class="column">
            <div class="input-box">
                <label>Date de commande</label>
                <input type="date" name="date_commande" required />
            </div>
            <div class="input-box">
                <label>Date de livraison prévue</label>
                <input type="date" name="date_livraison_prevue" required />
            </div>
        </div>
    
        <div class="gender-box">
            <h3>Mode de livraison</h3>
            <div class="gender-option">
                <div class="gender">
                    <input type="radio" id="check-standard" name="mode_livraison" value="standard" checked />
                    <label for="check-standard">Standard</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-express" name="mode_livraison" value="express" />
                    <label for="check-express">Express</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-aucun" name="mode_livraison" value="aucun" />
                    <label for="check-aucun">Aucun</label>
                </div>
            </div>
        </div>
    
        <br>
    
        <div class="column">
            <div class="select-box">
                <select id="country" name="pays" onchange="updateCities()">
                    <option hidden>Pays</option>
                    <option value="benin">Bénin</option>
                    <option value="south_africa">Afrique du Sud</option>
                    <option value="nigeria">Nigeria</option>
                    <option value="ghana">Ghana</option>
                    <option value="cameroon">Cameroun</option>
                    <option value="ivory_coast">Côte d'Ivoire</option>
                    <option value="democratic_republic_congo">RDC</option>
                    <option value="republic_congo">République du Congo</option>
                    <option value="uganda">Ouganda</option>
                    <option value="rwanda">Rwanda</option>
                    <option value="zimbabwe">Zimbabwe</option>
                    <option value="burkina_faso">Burkina Faso</option>
                    <option value="mali">Mali</option>
                    <option value="senegal">Sénégal</option>
                    <option value="togo">Togo</option>
                    <option value="zambia">Zambie</option>
                    <option value="namibia">Namibie</option>
                    <option value="botswana">Botswana</option>
                </select>
            </div>
            <div class="select-box">
                <select id="city" name="ville">
                    <option hidden>Villes</option>
                    <!-- Les villes seront ajoutées par JavaScript -->
                </select>
            </div>
        </div>
    
        <div class="input-box address">
            <label>Adresse de livraison</label>
            <input type="text" name="adresse_livraison" placeholder="Entrer L'adresse" required />
    
            <div class="column">
                <input type="text" name="region" placeholder="Entrer la région" required />
                <input type="number" name="code_postal" placeholder="Code postal" required />
            </div>
    
            <div class="column">
                <div class="select-box">
                    <select id="sector" name="secteur_entreprise" required>
                        <option hidden>Sélectionnez un secteur</option>
                        <option value="it">Informatique</option>
                        <option value="hr">Ressources humaines</option>
                        <option value="finance">Finance</option>
                        <option value="logistics">Logistique</option>
                        <option value="marketing">Marketing</option>
                        <option value="sales">Vente</option>
                        <option value="customer_support">Support client</option>
                        <option value="rnd">Recherche et développement (R&D)</option>
                        <option value="production">Production</option>
                        <option value="quality">Qualité</option>
                    </select>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Récupérer l'élément select
                        const sectorSelect = document.getElementById("sector");
            
                        // Désactiver toutes les options sauf celle de l'informatique
                        for (let i = 0; i < sectorSelect.options.length; i++) {
                            if (sectorSelect.options[i].value !== "it") {
                                sectorSelect.options[i].disabled = true;
                            }
                        }
                    });
                </script>
    
                <div class="select-box">
                    <select id="expense_type" name="type_depense" required>
                        <option hidden>Type De Dépense</option>
                        <option value="capex">CAPEX</option>
                        <option value="opex">OPEX</option>
                    </select>
                </div>
            </div>
    
            <div class="column">
                <input list="autres_options" name="Produit" placeholder="Selectionner un produit" />
                <datalist id="autres_options">
                    <option value="Serveurs"></option>
                    <option value="Routeurs et switches réseau"></option>
                    <option value="Imprimantes multifonctions"></option>
                    <option value="Moniteurs"></option>
                    <option value="Systèmes de sauvegarde en cloud"></option>
                    <option value="Logiciels de sécurité"></option>
                    <option value="Ordinateurs portables"></option>
                    <option value="Disques durs externes"></option>
                    <option value="Clés USB cryptées"></option>
                    <option value="Casques avec micro"></option>
                </datalist>
            </div>
        </div>
    
        <div class="column">
            <div class="input-box">
                <input type="number" name="quantite" placeholder="Quantité" required />
            </div>
            <div class="input-box">
                <div class="currency-wrapper">
                    <input type="number" name="Budget" placeholder="Budget" required class="no-arrows"/>
                    <span class="currency">XOF</span>
                </div>
                <style>
                    
                    .currency-wrapper {
                      position: relative;
                    }
                
                    .currency-wrapper input {
                      padding-right: 45px; /* Ajout d'espace pour la devise */
                    }
                
                    .currency {
                      position: absolute;
                      right: 10px;
                      top: 50%;
                      transform: translateY(-50%);
                      font-size: 16px;
                      color: #000;
                    }
                
                    /* Suppression des flèches pour augmenter/diminuer */
                    /* Pour Chrome, Safari, Edge, Opera */
                    .no-arrows::-webkit-outer-spin-button,
                    .no-arrows::-webkit-inner-spin-button {
                      -webkit-appearance: none;
                      margin: 0;
                    }
                
                    /* Pour Firefox */
                    .no-arrows {
                      -moz-appearance: textfield;
                    }
                  </style>
            </div>
        </div>

        <div class="column">
            <div class="select-box">
                <select id="quality" name="qualite_produit" onchange="updateQuality()">
                    <option hidden>Qualité du Produit</option>
                    <option value="economique">Qualité Économique</option>
                    <option value="standard">Qualité Standard</option>
                    <option value="premium">Qualité Premium</option>
                </select>
            </div>
        </div>

        <div class="input-box">
            <input type="text" name="informations" placeholder="Autres information sur le produit" required />
        </div>
    </div>

    <button type="submit">Passer La Commande</button>
</form>

    </section>

<script>
const citiesByCountry = {
  south_africa: [
            "Johannesburg", "Cape Town", "Durban", "Pretoria", "Port Elizabeth", 
            "Bloemfontein", "East London", "Kimberley", "Pietermaritzburg", "Nelspruit", 
            "George", "Vereeniging", "Rustenburg", "Polokwane", "Tshwane", 
            "Richards Bay", "Middelburg", "Welkom", "Uitenhage", "Paarl"
        ],
        nigeria: [
            "Lagos", "Abuja", "Port Harcourt", "Ibadan", "Kano", 
            "Benin City", "Kaduna", "Maiduguri", "Aba", "Jos", 
            "Ilorin", "Enugu", "Warri", "Sokoto", "Owerri", 
            "Akure", "Yola", "Calabar", "Zaria", "Uyo"
        ],
        ghana: [
            "Accra", "Kumasi", "Tamale", "Takoradi", "Cape Coast", 
            "Sekondi-Takoradi", "Ashaiman", "Koforidua", "Tema", "Obuasi", 
            "Bolgatanga", "Sunyani", "Wa", "Dambai", "Nsawam", 
            "Nkwanta", "Sefwi Wiawso", "Ejisu", "Akim Oda", "Bibiani"
        ],
        cameroon: [
            "Douala", "Yaoundé", "Garoua", "Bamenda", "Bafoussam", 
            "Limbe", "Nkongsamba", "Ebolowa", "Bertoua", "Maroua", 
            "Dschang", "Buea", "Kribi", "Foumban", "Eséka", 
            "Ngaoundéré", "Yagoua", "Batouri", "Limbe", "Sangmélima"
        ],
        ivory_coast: [
            "Abidjan", "Yamoussoukro", "Bouaké", "San Pedro", "Daloa", 
            "Korhogo", "Man", "Abengourou", "Yopougon", "Treichville", 
            "Anyama", "Bingerville", "Divo", "Séguela", "Bondoukou", 
            "Agboville", "San Pédro", "Grand-Bassam", "Odienné", "Katiola"
        ],
        democratic_republic_congo: [
            "Kinshasa", "Lubumbashi", "Mbuji-Mayi", "Kananga", "Kisangani", 
            "Bukavu", "Kolwezi", "Goma", "Matadi", "Tshikapa", 
            "Likasi", "Kolwezi", "Uvira", "Beni", "Kisangani", 
            "Mbandaka", "Katanga", "Bumba", "Kindu", "Walikale"
        ],
        republic_congo: [
            "Brazzaville", "Pointe-Noire", "Dolisie", "Ouesso", "Nkayi", 
            "Mossendjo", "Sibiti", "Impfondo", "Kinkala", "Loubomo", 
            "Oyo", "Makoua", "Madingou", "Bouenza", "Djambala", 
            "Gamboma", "Ouesso", "Kinkala", "Cuvette", "Nkayi"
        ],
        uganda: [
            "Kampala", "Entebbe", "Mbarara", "Jinja", "Mbale", 
            "Masaka", "Gulu", "Fort Portal", "Kabale", "Arua", 
            "Kasese", "Lira", "Soroti", "Hoima", "Kisoro", 
            "Mukono", "Masindi", "Apac", "Bushenyi", "Moroto"
        ],
        rwanda: [
            "Kigali", "Butare", "Gitarama", "Ruhengeri", "Gisenyi", 
            "Nyamata", "Kibuye", "Rwamagana", "Musanze", "Nyanza", 
            "Huye", "Muhanga", "Kayonza", "Nyagatare", "Kamonyi", 
            "Burera", "Ngoma", "Gisagara", "Ngororero", "Rubavu"
        ],
        zimbabwe: [
            "Harare", "Bulawayo", "Mutare", "Gweru", "Masvingo", 
            "Kwekwe", "Chitungwiza", "Kadoma", "Marondera", "Beitbridge", 
            "Norton", "Bindura", "Chegutu", "Chinhoyi", "Zvishavane", 
            "Kariba", "Victoria Falls", "Masvingo", "Lupane", "Gokwe"
        ],
        burkina_faso: [
            "Ouagadougou", "Bobo-Dioulasso", "Koudougou", "Banfora", "Ouahigouya", 
            "Tenkodogo", "Dédougou", "Fada N'gourma", "Kaya", "Pouytenga", 
            "Pô", "Houndé", "Tanga", "Manguier", "Nouna", 
            "Léo", "Gaoua", "Boromo", "Zorgho", "Dori"
        ],
        mali: [
            "Bamako", "Sikasso", "Kayes", "Mopti", "Ségou", 
            "Koutiala", "Gao", "Tombouctou", "Kayes", "Koulikoro", 
            "Nioro du Sahel", "San", "Kidal", "Bamako", "Sikasso", 
            "Tombouctou", "Niono", "Bougouni", "Ségou", "Kati"
        ],
        senegal: [
            "Dakar", "Saint-Louis", "Thiès", "Kaolack", "Ziguinchor", 
            "Fatick", "Rufisque", "Mbour", "Diourbel", "Tivaouane", 
            "Louga", "Kolda", "Podor", "Tambacounda", "Sédhiou", 
            "Banjul", "Dakar", "Dakar-Plateau", "Pout", "Mbacké"
        ],
        togo: [
            "Lomé", "Sokodé", "Kara", "Atakpamé", "Tsévié", 
            "Dapaong", "Aného", "Kpalimé", "Bafilo", "Notsé", 
            "Tchaoudjo", "Lomé", "Vogan", "Tchamba", "Kande", 
            "Notsé", "Bassar", "Agou", "Kloto", "Dzigbé"
        ],
        zambia: [
            "Lusaka", "Kitwe", "Ndola", "Kabwe", "Livingstone", 
            "Chingola", "Mufulira", "Luanshya", "Chipata", "Monze", 
            "Kasama", "Mbala", "Mansa", "Nakonde", "Luwingu", 
            "Choma", "Solwezi", "Kalulushi", "Petauke", "Mufulira"
        ],

        benin: [
            "Cotonou", "Porto-Novo", "Djougou", "Parakou", "Ouidah", 
            "Abomey", "Natitingou", "Bohicon", "Kandi", "Allada"
        ]
        
};

function updateCities() {
  const countrySelect = document.getElementById('country');
  const citySelect = document.getElementById('city');
  const selectedCountry = countrySelect.value;

  // Clear the current city options
  citySelect.innerHTML = '<option hidden>Villes</option>';

  // Populate the cities based on the selected country
  if (citiesByCountry[selectedCountry]) {
      citiesByCountry[selectedCountry].forEach(city => {
          const option = document.createElement('option');
          option.value = city;
          option.textContent = city;
          citySelect.appendChild(option);
      });
  }
}

</script>

    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

  </body>
</html>