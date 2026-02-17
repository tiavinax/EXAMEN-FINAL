-- Création de la base de données
-- CREATE DATABASE bngrc_db;
-- USE bngrc_db;

-- ============================================
-- 1. TABLE DES VILLES
-- ============================================
CREATE TABLE villes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- 2. TABLE DES BESOINS
-- ============================================
CREATE TABLE besoins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ville_id INT NOT NULL,
    libelle VARCHAR(200) NOT NULL,
    type ENUM('nature', 'materiaux', 'argent') NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(15,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ville_id) REFERENCES villes(id) ON DELETE CASCADE
);

-- ============================================
-- 3. TABLE DES DONS
-- ============================================
CREATE TABLE dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    donateur VARCHAR(200),
    type ENUM('nature', 'materiaux', 'argent') NOT NULL,
    libelle VARCHAR(200) NOT NULL,
    quantite INT,
    montant DECIMAL(15,2),
    date_don TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- 4. TABLE DES ATTRIBUTIONS
-- ============================================
CREATE TABLE attributions (
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
);

-- ============================================
-- DONNÉES DE TEST
-- ============================================

-- Villes
INSERT INTO villes (nom, region) VALUES 
('Antananarivo', 'Analamanga'),
('Toamasina', 'Analanjirofo'),
('Mahajanga', 'Boeny');

-- Besoins des villes
INSERT INTO besoins (ville_id, libelle, type, quantite, prix_unitaire) VALUES
(1, 'Riz', 'nature', 1, 20),
(2, 'Eau potable', 'nature', 3, 50),
(3, 'Tôle', 'materiaux', 5, 15),
(1, 'Tôle', 'materiaux', 10, 15),
(2, 'Clou', 'materiaux', 3, 15),
(3, 'aide financiere', 'argent', 0, 100);

-- Dons reçus
INSERT INTO dons (donateur, type, libelle, quantite, montant) VALUES
('Croix Rouge', 'nature', 'Riz 50kg', 10, NULL),
('Donateur privé', 'materiaux', 'Tôle', 20, NULL),
('Collecte', 'argent', 'Aide financière', NULL, 500);

-- ================ SCRIPTE SQL DU 17/02/2026 ==================

-- Table pour enregistrer les achats effectués avec dons argent

CREATE TABLE IF NOT EXISTS parametre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(100) NOT NULL,
    valeur VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS achats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    don_id INT NOT NULL,
    besoin_id INT NOT NULL,
    quantite INT NOT NULL,
    montant_achat DECIMAL(15,2) NOT NULL, -- montant du besoin (quantite × prix_unitaire)
    frais_pourcentage DECIMAL(5,2) NOT NULL,
    montant_frais DECIMAL(15,2) NOT NULL,
    montant_total DECIMAL(15,2) NOT NULL, -- montant_achat + montant_frais
    date_achat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (don_id) REFERENCES dons(id) ON DELETE CASCADE,
    FOREIGN KEY (besoin_id) REFERENCES besoins(id) ON DELETE CASCADE
);

-- Insertion du paramètre de frais
INSERT INTO parametre (libelle, valeur, description) 
VALUES ('frais_achat', '10', 'Pourcentage de frais appliqué aux achats via dons argent');