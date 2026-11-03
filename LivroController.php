<?php
require_once __DIR__ . '/../models/Livro.php';
require_once __DIR__ . '/../models/Autor.php';

class LivroController
{
    private $model;
    private $autorModel;

    public function __construct($conn)
    {
        $this->model = new Livro($conn);
        $this->autorModel = new Autor($conn);
    }

    public function index()
    {
        $livros = $this->model->listar();
        require __DIR__ . '/../views/livros/index_livro.php';
    }

    public function create()
    {
        $erro = null;
        $autores = $this->autorModel->listar();
        $dados = ['titulo' => '', 'genero' => '', 'ano_publicacao' => '', 'preco' => '', 'autor_id' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->lerFormulario();
            $erro = $this->validar($dados);
            if (!$erro) {
                $this->model->criar($dados);
                mensagem('Livro cadastrado com sucesso!');
                redirecionar('livros');
            }
        }
        require __DIR__ . '/../views/livros/create_livro.php';
    }

    public function edit()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $dados = $this->model->buscar($id);
        if (!$dados) {
            mensagem('Livro não encontrado.', 'erro');
            redirecionar('livros');
        }
        $erro = null;
        $autores = $this->autorModel->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->lerFormulario();
            $dados['id'] = $id;
            $erro = $this->validar($dados);
            if (!$erro) {
                $this->model->atualizar($id, $dados);
                mensagem('Livro atualizado!');
                redirecionar('livros');
            }
        }
        require __DIR__ . '/../views/livros/edit_livro.php';
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->excluir((int) ($_POST['id'] ?? 0));
            mensagem('Livro excluído.');
        }
        redirecionar('livros');
    }

    private function lerFormulario()
    {
        return [
            'titulo'         => trim($_POST['titulo'] ?? ''),
            'genero'         => trim($_POST['genero'] ?? ''),
            'ano_publicacao' => trim($_POST['ano_publicacao'] ?? ''),
            'preco'          => str_replace(',', '.', trim($_POST['preco'] ?? '')),
            'autor_id'  => trim($_POST['autor_id'] ?? ''),
        ];
    }

    private function validar($d)
    {
        if ($d['titulo'] === '' || $d['genero'] === '') {
            return 'Informe o título e o gênero do livro.';
        }
        if (!ctype_digit($d['ano_publicacao']) || $d['ano_publicacao'] < 1000 || $d['ano_publicacao'] > (int) date('Y') + 2) {
            return 'Informe um ano de publicação válido.';
        }
        if (!is_numeric($d['preco']) || $d['preco'] < 0) {
            return 'Informe um preço válido (ex.: 199.90).';
        }
        if ($this->autorModel->buscar((int) $d['autor_id']) === false) {
            return 'Selecione um autor.';
        }
        return null;
    }
}
