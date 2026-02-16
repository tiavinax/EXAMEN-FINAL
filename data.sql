-- Création de la base de données
CREATE DATABASE IF NOT EXISTS bngrc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bngrc_db;

-- Table des villes
CREATE TABLE IF NOT EXISTS villes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des besoins
CREATE TABLE IF NOT EXISTS besoins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ville_id INT NOT NULL,
    libelle VARCHAR(200) NOT NULL,
    type ENUM('nature', 'materiaux', 'argent') NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(15,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ville_id) REFERENCES villes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des dons
CREATE TABLE IF NOT EXISTS dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    donateur VARCHAR(200),
    type ENUM('nature', 'materiaux', 'argent') NOT NULL,
    libelle VARCHAR(200) NOT NULL,
    quantite INT,
    montant DECIMAL(15,2),
    date_don TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des attributions (dispatch)
CREATE TABLE IF NOT EXISTS attributions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    don_id INT NOT NULL,
    besoin_id INT NOT NULL,
    ville_id INT NOT NULL,
    quantite_attribuee INT,
    montant_attribue DECIMAL(15,2),
    date_attribution TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (don_id) REFERENCES dons(id) ON DELETE CASCADE,
    FOREIGN KEY (besoin_id) REFERENCES besoins(id) ON DELETE CASCADE,
    FOREIGN KEY (ville_id) REFERENCES villes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertion des données de test
INSERT INTO villes (nom, region) VALUES
('Antananarivo', 'Analamanga'),
('Toamasina', 'Atsinanana'),
('Mahajanga', 'Boeny'),
('Fianarantsoa', 'Haute Matsiatra'),
('Antsiranana', 'Diana');

INSERT INTO besoins (ville_id, libelle, type, quantite, prix_unitaire) VALUES
(1, 'Riz', 'nature', 1000, 1500),
(1, 'Huile', 'nature', 500, 3000),
(1, 'Tôles', 'materiaux', 200, 4000),
(2, 'Riz', 'nature', 800, 1500),
(2, 'Huile', 'nature', 300, 3000),
(3, 'Riz', 'nature', 1200, 1500),
(3, 'Tôles', 'materiaux', 150, 4000),
(4, 'Riz', 'nature', 600, 1500),
(4, 'Huile', 'nature', 200, 3000),
(5, 'Riz', 'nature', 400, 1500);

INSERT INTO dons (donateur, type, libelle, quantite, montant, date_don) VALUES
('Croix Rouge', 'nature', 'Riz', 800, NULL, '2026-02-15 10:00:00'),
('UNICEF', 'nature', 'Huile', 400, NULL, '2026-02-15 11:30:00'),
('Entreprise Locale', 'materiaux', 'Tôles', 100, NULL, '2026-02-15 14:15:00'),
('Donateur Anonyme', 'argent', 'Don en espèces', NULL, 2000000, '2026-02-16 09:00:00');

INSERT INTO attributions (don_id, besoin_id, ville_id, quantite_attribuee, montant_attribue, date_attribution) VALUES
(1, 1, 1, 300, NULL, '2026-02-16 10:30:00'),
(1, 4, 2, 200, NULL, '2026-02-16 09:15:00'),
(2, 2, 1, 150, NULL, '2026-02-16 10:30:00'),
(2, 5, 2, 100, NULL, '2026-02-16 09:15:00'),
(3, 3, 1, 50, NULL, '2026-02-15 16:45:00'),
(4, 1, 1, NULL, 500000, '2026-02-16 11:00:00');