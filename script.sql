CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    image_profile VARCHAR(255),
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
);

CREATE TABLE menus (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    id_chef INT NOT NULL,
    nom_menu VARCHAR(100) NOT NULL,
    description TEXT,
    image_menu VARCHAR(255),
    FOREIGN KEY (id_chef) REFERENCES client(id_client)
);

CREATE TABLE plats (
    id_plat INT AUTO_INCREMENT PRIMARY KEY,
    id_menu INT NOT NULL,
    nom_plat VARCHAR(100) NOT NULL,
    description TEXT, 
    prix DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_menu) REFERENCES menus(id_menu)
);

CREATE TABLE reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_menu INT NOT NULL,
    date_reservation DATE NOT NULL,
    heure_reservation TIME NOT NULL,
    nombre_personnes INT NOT NULL,
    statut ENUM('en attente', 'approuvée', 'refusée') DEFAULT 'en attente',
    FOREIGN KEY (id_client) REFERENCES utilisateurs(id_utilisateur),
    FOREIGN KEY (id_menu) REFERENCES menus(id_menu)
);

CREATE TABLE statistiques (
    id_statistique INT AUTO_INCREMENT PRIMARY KEY,
    id_chef INT NOT NULL,
    demandes_en_attente INT NOT NULL,
    demandes_approuvees INT NOT NULL,
    demandes_jour INT NOT NULL,
    FOREIGN KEY (id_chef) REFERENCES utilisateurs(id_utilisateur)
);






