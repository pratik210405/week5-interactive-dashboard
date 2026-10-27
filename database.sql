CREATE DATABASE IF NOT EXISTS week5_dashboard CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE week5_dashboard;

CREATE TABLE IF NOT EXISTS transactions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  transaction_date DATE NOT NULL,
  type ENUM('income','expense') NOT NULL,
  category VARCHAR(100) NOT NULL,
  description VARCHAR(255) DEFAULT NULL,
  amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO transactions (transaction_date, type, category, description, amount) VALUES
('2026-08-03','income','Sales','Product sales',18500.00),
('2026-08-05','expense','Transport','Delivery costs',2400.00),
('2026-08-12','income','Services','Consulting payment',9500.00),
('2026-08-16','expense','Office','Stationery and supplies',1250.00),
('2026-09-02','income','Sales','Monthly sales',22000.00),
('2026-09-07','expense','Marketing','Online promotion',3100.00),
('2026-09-15','expense','Utilities','Electricity bill',1800.00),
('2026-09-21','income','Services','Project payment',12500.00),
('2026-10-04','income','Sales','October sales',26500.00),
('2026-10-08','expense','Transport','Fuel and travel',2800.00),
('2026-10-12','expense','Office','Office supplies',950.00),
('2026-10-18','income','Services','Support contract',7800.00);
