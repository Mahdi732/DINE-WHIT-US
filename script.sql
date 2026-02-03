-- Schema for dinewithus (aligns with PHP code)
CREATE DATABASE IF NOT EXISTS dinewithus CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dinewithus;

DROP TABLE IF EXISTS statistiques;
DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS plats;
DROP TABLE IF EXISTS menus;
DROP TABLE IF EXISTS client;

CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    image_profile VARCHAR(255),
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE menus (
    id_menu INT AUTO_INCREMENT PRIMARY KEY,
    id_chef INT NOT NULL,
    nom_menu VARCHAR(100) NOT NULL,
    description TEXT,
    image_menu VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_menus_client FOREIGN KEY (id_chef) REFERENCES client(id_client) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE plats (
    id_plat INT AUTO_INCREMENT PRIMARY KEY,
    id_menu INT NOT NULL,
    nom_plat VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    image_plat VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_plats_menu FOREIGN KEY (id_menu) REFERENCES menus(id_menu) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_menu INT NOT NULL,
    date_reservation DATE NOT NULL,
    heure_reservation TIME NOT NULL,
    nombre_personnes INT NOT NULL,
    statut ENUM('en attente', 'approuvée', 'refusée') DEFAULT 'en attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reservations_client FOREIGN KEY (id_client) REFERENCES client(id_client) ON DELETE CASCADE,
    CONSTRAINT fk_reservations_menu FOREIGN KEY (id_menu) REFERENCES menus(id_menu) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE statistiques (
    id_statistique INT AUTO_INCREMENT PRIMARY KEY,
    id_chef INT NOT NULL,
    demandes_en_attente INT NOT NULL DEFAULT 0,
    demandes_approuvees INT NOT NULL DEFAULT 0,
    demandes_jour INT NOT NULL DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_stats_client FOREIGN KEY (id_chef) REFERENCES client(id_client) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Helpful indexes
CREATE INDEX idx_reservations_client ON reservations (id_client);
CREATE INDEX idx_reservations_menu ON reservations (id_menu);
CREATE INDEX idx_plats_menu ON plats (id_menu);
CREATE INDEX idx_menus_chef ON menus (id_chef);


