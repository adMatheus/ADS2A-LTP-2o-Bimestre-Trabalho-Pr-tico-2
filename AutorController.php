<?php
require_once __DIR__ . '/../models/Autor.php';

class AutorController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new Autor($conn);
    }

    public function index()
    {
        $autores = $this->model->listar();
        require __DIR__ . '/../views/autores/index_autor.php';
    }

    public function create()
    {
        $erro = null;
        $dados = ['nome' => '', 'nacionalidade' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = ['nome' => trim($_POST['nome'] ?? ''), 'nacionalidade' => trim($_POST['nacionalidade'] ?? '')];
            if ($dados['nome'] === '' || $dados['nacionalidade'] === '') {
                $erro = 'Preencha o nome e o nacionalidade.';
            } else {
                $this->model->criar($dados['nome'], $dados['nacionalidade']);
                mensagem('Autor cadastrado com sucesso!');
                redirecionar('autores');
            }
        }
        require __DIR__ . '/../views/autores/create_autor.php';
    }

    public function edit()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $dados = $this->model->buscar($id);
        if (!$dados) {
            mensagem('Autor não encontrado.', 'erro');
            redirecionar('autores');
        }
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = ['id' => $id, 'nome' => trim($_POST['nome'] ?? ''), 'nacionalidade' => trim($_POST['nacionalidade'] ?? '')];
            if ($dados['nome'] === '' || $dados['nacionalidade'] === '') {
                $erro = 'Preencha o nome e o nacionalidade.';
            } else {
                $this->model->atualizar($id, $dados['nome'], $dados['nacionalidade']);
                mensagem('Autor atualizado!');
                redirecionar('autores');
            }
        }
        require __DIR__ . '/../views/autores/edit_autor.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->model->excluir((int) ($_POST['id'] ?? 0));
                mensagem('Autor excluído.');
            } catch (PDOException $e) {
                // FK com RESTRICT: não deixa apagar autor que ainda tem livros
                mensagem('Não é possível excluir: existem livros cadastrados neste autor.', 'erro');
            }
        }
        redirecionar('autores');
    }
}
