-- HorologyHub Schema

SET FOREIGN_KEY_CHECKS=0;

-- Watches Catalog
DROP TABLE IF EXISTS watches;
CREATE TABLE watches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    reference_number VARCHAR(100),
    movement_type VARCHAR(50),
    case_material VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Price History
DROP TABLE IF EXISTS price_history;
CREATE TABLE price_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    watch_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(3) DEFAULT 'EUR',
    condition_status ENUM('Naked', 'Box_Papers') NOT NULL,
    source_url VARCHAR(255),
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (watch_id) REFERENCES watches(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- AI Analysis / Ratings
DROP TABLE IF EXISTS investment_ratings;
CREATE TABLE investment_ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    watch_id INT NOT NULL,
    rating_score DECIMAL(3, 1), -- 0.0 to 10.0
    ai_analysis_text TEXT,
    recommendation ENUM('Buy', 'Hold', 'Pass'),
    analyzed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (watch_id) REFERENCES watches(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- SeikoMod Parts
DROP TABLE IF EXISTS watch_parts;
CREATE TABLE watch_parts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    part_type ENUM('Dial', 'Hand', 'Case', 'Movement', 'Bezel') NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    specifications JSON, -- Stores dimensions e.g. {"diameter": 28.5, "thickness": 1.2}
    compatible_movements JSON, -- Array of movement IDs or names e.g. ["NH35", "NH36"]
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS=1;
