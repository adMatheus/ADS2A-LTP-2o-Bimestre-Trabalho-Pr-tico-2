<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estante - Catálogo de Livros</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="topo">
    <div class="container topo-conteudo">
        <a class="logo" href="index.php">Es<span>tante</span></a>
        <nav>
            <a href="index.php?page=livros" class="<?= $page === 'livros' ? 'ativo' : '' ?>">Livros</a>
            <a href="index.php?page=autores" class="<?= $page === 'autores' ? 'ativo' : '' ?>">Autores</a>
        </nav>
    </div>
</header>
<main class="container">
<?php if (!empty($_SESSION['msg'])): ?>
    <div class="aviso aviso-<?= e($_SESSION['msg']['tipo']) ?>"><?= e($_SESSION['msg']['texto']) ?></div>
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>
