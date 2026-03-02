-- Create database
CREATE DATABASE IF NOT EXISTS `28speedshop`;
USE `28speedshop`;

-- Table: stock
CREATE TABLE IF NOT EXISTS `stock` (
    `idbarang` INT AUTO_INCREMENT PRIMARY KEY,
    `namabarang` VARCHAR(255) NOT NULL,
    `deskripsi` TEXT,
    `stock` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: masuk (barang masuk)
CREATE TABLE IF NOT EXISTS `masuk` (
    `idmasuk` INT AUTO_INCREMENT PRIMARY KEY,
    `idbarang` INT NOT NULL,
    `qty` INT NOT NULL,
    `keterangan` TEXT,
    `tanggal` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`idbarang`) REFERENCES `stock`(`idbarang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: keluar (barang keluar)
CREATE TABLE IF NOT EXISTS `keluar` (
    `idkeluar` INT AUTO_INCREMENT PRIMARY KEY,
    `idbarang` INT NOT NULL,
    `qty` INT NOT NULL,
    `keterangan` TEXT,
    `tanggal` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`idbarang`) REFERENCES `stock`(`idbarang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: login
CREATE TABLE IF NOT EXISTS `login` (
    `iduser` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user
INSERT INTO `login` (`email`, `password`) VALUES ('admin@28speedshop.com', 'admin123');
