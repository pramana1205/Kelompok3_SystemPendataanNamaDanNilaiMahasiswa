
CREATE DATABASE IF NOT EXISTS uas_mahasiswa;
USE uas_mahasiswa;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE nilai (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id INT,
    matkul VARCHAR(100),
    nilai DECIMAL(5,2),
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
);

CREATE VIEW nilai_tertinggi AS
SELECT m.nama, n.matkul, MAX(n.nilai) AS nilai_maks
FROM mahasiswa m
JOIN nilai n ON m.id = n.mahasiswa_id
GROUP BY n.matkul;

DELIMITER $$
CREATE FUNCTION hitung_rata_rata(mhs_id INT)
RETURNS DECIMAL(5,2)
BEGIN
  DECLARE rata DECIMAL(5,2);
  SELECT AVG(nilai) INTO rata FROM nilai WHERE mahasiswa_id = mhs_id;
  RETURN rata;
END$$
DELIMITER ;
