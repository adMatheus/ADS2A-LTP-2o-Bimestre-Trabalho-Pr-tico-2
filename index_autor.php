<div class="titulo-pagina">
    <h1>Autores</h1>
    <a class="btn btn-principal" href="index.php?page=autores&action=create">Novo autor</a>
</div>

<?php if (empty($autores)): ?>
    <p class="vazio">Nenhum autor cadastrado. Cadastre um para poder adicionar livros.</p>
<?php else: ?>
<div class="tabela-wrap">
<table>
    <thead><tr><th>Nome</th><th>Nacionalidade</th><th>Ações</th></tr></thead>
    <tbody>
    <?php foreach ($autores as $p): ?>
        <tr>
            <td><strong><?= e($p['nome']) ?></strong></td>
            <td><?= e($p['nacionalidade']) ?></td>
            <td class="acoes">
                <a class="btn btn-pequeno" href="index.php?page=autores&action=edit&id=<?= (int) $p['id'] ?>">Editar</a>
                <form method="post" action="index.php?page=autores&action=delete"
                      onsubmit="return confirm('Excluir este autor?');">
                    <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                    <button class="btn btn-pequeno btn-perigo" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>
