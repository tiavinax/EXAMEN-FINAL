-- Création de la base de données
CREATE DATABASE IF NOT EXISTS bngrc_db;
USE bngrc_db;

-- 1. Table des villes
CREATE TABLE IF NOT EXISTS villes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table des besoins
CREATE TABLE IF NOT EXISTS besoins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ville_id INT NOT NULL,
    type ENUM('nature', 'materiaux', 'argent') NOT NULL,
    libelle VARCHAR(100) NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    quantite INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ville_id) REFERENCES villes(id) ON DELETE CASCADE
);

-- 3. Table des dons
CREATE TABLE IF NOT EXISTS dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type ENUM('nature', 'materiaux', 'argent') NOT NULL,
    libelle VARCHAR(100) NOT NULL,
    quantite INT NULL,
    montant DECIMAL(10,2) NULL,
    date_saisie DATETIME NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Contrainte : soit quantite soit montant selon le type
    CHECK (
        (type IN ('nature', 'materiaux') AND quantite IS NOT NULL AND montant IS NULL) OR
        (type = 'argent' AND montant IS NOT NULL AND quantite IS NULL)
    )
);

-- Quelques données de test (optionnel)
INSERT INTO villes (nom) VALUES 
('Antananarivo'),
('Toamasina'),
('Mahajanga');

INSERT INTO besoins (ville_id, type, libelle, prix_unitaire, quantite) VALUES
(1, 'nature', 'Riz', 2500, 100),
(1, 'materiaux', 'Tôle', 15000, 50),
(2, 'argent', 'Aide financière', 1, 500000),
(3, 'nature', 'Huile', 5000, 30);

INSERT INTO dons (type, libelle, quantite, montant, date_saisie) VALUES
('nature', 'Riz', 50, NULL, '2026-02-15 10:00:00'),
('materiaux', 'Tôle', 20, NULL, '2026-02-15 14:30:00'),
('argent', 'Don en espèces', NULL, 200000, '2026-02-16 09:15:00');