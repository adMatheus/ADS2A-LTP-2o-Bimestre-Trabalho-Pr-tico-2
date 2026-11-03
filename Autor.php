<?php
class Autor
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function listar()
    {
        return $this->conn->query("SELECT * FROM autores ORDER BY nome")->fetchAll();
    }

    public function buscar($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM autores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar($nome, $nacionalidade)
    {
        $stmt = $this->conn->prepare("INSERT INTO autores (nome, nacionalidade) VALUES (?, ?)");
        return $stmt->execute([$nome, $nacionalidade]);
    }

    public function atualizar($id, $nome, $nacionalidade)
    {
        $stmt = $this->conn->prepare("UPDATE autores SET nome = ?, nacionalidade = ? WHERE id = ?");
        return $stmt->execute([$nome, $nacionalidade, $id]);
    }

    public function excluir($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM autores WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
