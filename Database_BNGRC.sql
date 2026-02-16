CREATE database examen_final;
use examen_final;
-- Table des régions
CREATE TABLE regions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des villes
CREATE TABLE villes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    region_id INT,
    nom VARCHAR(100) NOT NULL,
    population INT,
    FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories de besoins (nature, matériaux, argent)
CREATE TABLE categories_besoin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des besoins
CREATE TABLE besoins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ville_id INT NOT NULL,
    categorie_id INT NOT NULL,
    libelle VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    quantite_initiale INT NOT NULL,
    quantite_restante INT NOT NULL,
    date_besoin DATE NOT NULL,
    FOREIGN KEY (ville_id) REFERENCES villes(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES categories_besoin(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des donateurs
CREATE TABLE donateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    contact VARCHAR(50),
    email VARCHAR(100),
    adresse TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des dons
CREATE TABLE dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    donateur_id INT NOT NULL,
    type_don ENUM('nature', 'materiaux', 'argent') NOT NULL,
    libelle VARCHAR(255) NOT NULL,
    description TEXT,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2),
    montant_total DECIMAL(10,2),
    date_don DATE NOT NULL,
    FOREIGN KEY (donateur_id) REFERENCES donateurs(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des attributions (dispatch)
CREATE TABLE attributions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    besoin_id INT NOT NULL,
    don_id INT NOT NULL,
    quantite_attribuee INT NOT NULL,
    montant_attribue DECIMAL(10,2),
    date_attribution DATE NOT NULL,
    FOREIGN KEY (besoin_id) REFERENCES besoins(id) ON DELETE CASCADE,
    FOREIGN KEY (don_id) REFERENCES dons(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des catégories de base
INSERT INTO categories_besoin (nom, description) VALUES
('nature', 'Nourriture, eau, vêtements, etc.'),
('materiaux', 'Tôles, clous, ciment, outils, etc.'),
('argent', 'Dons en espèces');
INSERT INTO regions (nom) VALUES 
('Diana'),
('Sava'),
('Itasy'),
('Analamanga');

-- Ajout des villes
INSERT INTO villes (region_id, nom, population) VALUES
(1, 'Antsiranana', 150000),
(1, 'Ambilobe', 80000),
(2, 'Sambava', 120000),
(2, 'Antalaha', 100000),
(3, 'Miarinarivo', 90000),
(3, 'Arivonimamo', 110000),
(4, 'Antananarivo', 1500000),
(4, 'Ambohidratrimo', 200000);

-- Ajout des donateurs
INSERT INTO donateurs (nom, contact, email) VALUES
('Croix Rouge Malagasy', '034 12 345 67', 'contact@croixrouge.mg'),
('UNICEF Madagascar', '032 11 222 33', 'madagascar@unicef.org'),
('PAM', '033 44 555 66', 'wfp.madagascar@wfp.org'),
('Fondation Telma', '020 22 333 44', 'fondation@telma.mg'),
('ANONYME', NULL, NULL);