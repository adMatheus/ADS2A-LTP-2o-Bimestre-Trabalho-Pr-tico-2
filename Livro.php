<?php
class Livro
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Lista os livros já trazendo o nome da autor (JOIN)
    public function listar()
    {
        $sql = "SELECT j.*, p.nome AS autor_nome
                FROM livros j
                INNER JOIN autores p ON p.id = j.autor_id
                ORDER BY j.titulo";
        return $this->conn->query($sql)->fetchAll();
    }

    public function buscar($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar($d)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO livros (titulo, genero, ano_publicacao, preco, autor_id) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$d['titulo'], $d['genero'], $d['ano_publicacao'], $d['preco'], $d['autor_id']]);
    }

    public function atualizar($id, $d)
    {
        $stmt = $this->conn->prepare(
            "UPDATE livros SET titulo = ?, genero = ?, ano_publicacao = ?, preco = ?, autor_id = ? WHERE id = ?"
        );
        return $stmt->execute([$d['titulo'], $d['genero'], $d['ano_publicacao'], $d['preco'], $d['autor_id'], $id]);
    }

    public function excluir($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM livros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
