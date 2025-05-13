<?php
require_once 'Config/DB.php';

class Reservasi
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT reservasi.*, departement.nama AS nama_departement
                FROM reservasi
                JOIN departement ON reservasi.departemen_id = departemen.id");
        return $stmt;
    }
    public function show($id)
    {
        $stmt = $this->pdo->query("SELECT reservasi.*, departemen.nama AS nama_departemen
                FROM reservasi
                JOIN departemen ON reservasi.departemen_id = departemen.id
                WHERE reservasi.id = $id");
        return $stmt;
    }
    public function create($nama, $tanggal, $email, $hp, $doctor, $keluhan, $departemen_id)
    {
        // Validasi input
        if (empty($nama) || empty($hp) || empty($tanggal) || empty($doctor) || empty($email) || empty($keluhan) || empty($departemen_id)) {
            throw new InvalidArgumentException("Semua field harus diisi.");
        }

        // Siapkan dan jalankan pernyataan SQL
        $stmt = $this->pdo->prepare("INSERT INTO reservasi (nama, hp, tanggal, doctor, email, keluhan, departemen_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nama, $hp, $tanggal, $doctor, $email, $keluhan, $departemen_id]);
    }

    public function update($id, $data) {
        if (!is_array($data)) {
            throw new TypeError("Expected parameter 'data' to be an array.");
        }

        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id;

        $sql = "UPDATE reservasi SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete($id)
    {
        // Validasi input
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("ID harus berupa angka.");
        }

        try {
            $stmt = $this->pdo->prepare("DELETE FROM reservasi WHERE id = ?");
            $result = $stmt->execute([$id]);

            // Cek apakah ada baris yang terpengaruh
            if ($result && $stmt->rowCount() > 0) {
                return true; // Penghapusan berhasil
            } else {
                return false; // Tidak ada baris yang dihapus (mungkin ID tidak ada)
            }
        } catch (PDOException $e) {
            // Tangani kesalahan PDO
            // Anda bisa mencatat kesalahan atau melempar pengecualian
            throw new Exception("Terjadi kesalahan saat menghapus data: " . $e->getMessage());
        }
    }
}
$reservasi = new Reservasi($pdo);
?>
