<div class="titulo-pagina">
    <h1>Meus livros</h1>
    <a class="btn btn-principal" href="index.php?page=livros&action=create">Novo livro</a>
</div>

<?php if (empty($livros)): ?>
    <p class="vazio">Nenhum livro cadastrado ainda. Clique em "Novo livro" para começar.</p>
<?php else: ?>
<div class="tabela-wrap">
<table>
    <thead>
        <tr><th>Título</th><th>Gênero</th><th>Autor</th><th>Ano</th><th>Preço</th><th>Ações</th></tr>
    </thead>
    <tbody>
    <?php foreach ($livros as $j): ?>
        <tr>
            <td><strong><?= e($j['titulo']) ?></strong></td>
            <td><?= e($j['genero']) ?></td>
            <td><span class="etiqueta"><?= e($j['autor_nome']) ?></span></td>
            <td><?= e($j['ano_publicacao']) ?></td>
            <td>R$ <?= number_format($j['preco'], 2, ',', '.') ?></td>
            <td class="acoes">
                <a class="btn btn-pequeno" href="index.php?page=livros&action=edit&id=<?= (int) $j['id'] ?>">Editar</a>
                <form method="post" action="index.php?page=livros&action=delete"
                      onsubmit="return confirm('Excluir este livro?');">
                    <input type="hidden" name="id" value="<?= (int) $j['id'] ?>">
                    <button class="btn btn-pequeno btn-perigo" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>
