<?php
// Ponto de entrada: roteamento simples por parâmetros GET (?page=livros&action=index)
session_start();
ob_start(); // permite usar header() para redirecionar depois do HTML do cabeçalho

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/LivroController.php';
require_once __DIR__ . '/../controllers/AutorController.php';

// ----- funções auxiliares -----
function e($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function mensagem($texto, $tipo = 'ok')
{
    $_SESSION['msg'] = ['texto' => $texto, 'tipo' => $tipo];
}

function redirecionar($page, $action = 'index')
{
    header("Location: index.php?page={$page}&action={$action}");
    exit;
}

// ----- roteamento -----
$conn   = (new Database())->conectar();
$page   = $_GET['page'] ?? 'livros';
$action = $_GET['action'] ?? 'index';

$controllers = [
    'livros'       => 'LivroController',
    'autores' => 'AutorController',
];
$acoesValidas = ['index', 'create', 'edit', 'delete'];

if (!isset($controllers[$page]) || !in_array($action, $acoesValidas, true)) {
    http_response_code(404);
    $page = 'livros';
    $action = 'index';
    mensagem('Página não encontrada.', 'erro');
}

require __DIR__ . '/../views/includes/header.php';
$controller = new $controllers[$page]($conn);
$controller->$action();
require __DIR__ . '/../views/includes/footer.php';
