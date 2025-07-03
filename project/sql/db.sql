
CREATE DATABASE IF NOT EXISTS uas_mahasiswa;

USE uas_mahasiswa;

CREATE TABLE
  mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) UNIQUE NOT NULL
  );

CREATE TABLE
  nilai (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id INT,
    matkul VARCHAR(100),
    nilai DECIMAL(5, 2),
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa (id)
  );

CREATE VIEW
  view_nilai_mahasiswa AS
SELECT
  m.nama,
  m.nim,
  n.matkul,
  n.nilai
FROM
  nilai n
  JOIN mahasiswa m ON n.mahasiswa_id = m.id;

DELIMITER // 
CREATE FUNCTION jumlah_mahasiswa () RETURNS INT DETERMINISTIC BEGIN DECLARE total INT;
SELECT
  COUNT(*) INTO total
FROM
  mahasiswa;
RETURN total;
END // DELIMITER;
