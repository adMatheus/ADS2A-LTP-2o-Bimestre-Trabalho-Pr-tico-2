<?php
// Conexão com o banco usando PDO (padrão do XAMPP: usuário root, sem senha)
class Database
{
    private $host = 'localhost';
    private $db   = 'estante_db';
    private $user = 'root';
    private $pass = '';

    public function conectar()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->user,
                $this->pass
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die('Erro ao conectar no banco: ' . $e->getMessage());
        }
    }
}
