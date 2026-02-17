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
(1, 'Riz', 'nature', 100, 2500),
(1, 'Tôle ondulée', 'materiaux', 50, 15000),
(2, 'Eau potable', 'nature', 500, 500),
(3, 'Couvertures', 'nature', 200, 5000);

-- Dons reçus
INSERT INTO dons (donateur, type, libelle, quantite, montant) VALUES
('Croix Rouge', 'nature', 'Riz 50kg', 50, NULL),
('Donateur privé', 'materiaux', 'Tôle', 30, NULL),
('Collecte', 'argent', 'Aide financière', NULL, 500000);

-- Attributions (distribution)
INSERT INTO attributions (don_id, besoin_id, ville_id, quantite_attribuee, montant_attribue) VALUES
(1, 1, 1, 50, NULL),
(2, 2, 1, 30, NULL),
(3, 4, 3, NULL, 500000);-- Insertion des données de test
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