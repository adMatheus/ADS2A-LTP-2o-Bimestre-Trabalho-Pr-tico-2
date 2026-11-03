<?php if ($erro): ?><div class="aviso aviso-erro"><?= e($erro) ?></div><?php endif; ?>
<form method="post" class="formulario">
    <label>Título
        <input type="text" name="titulo" value="<?= e($dados['titulo']) ?>" required>
    </label>
    <label>Gênero
        <input type="text" name="genero" value="<?= e($dados['genero']) ?>" placeholder="Ex.: Romance, Fantasia, Ficção científica" required>
    </label>
    <div class="linha">
        <label>Ano de publicação
            <input type="number" name="ano_publicacao" value="<?= e($dados['ano_publicacao']) ?>" min="1000" required>
        </label>
        <label>Preço (R$)
            <input type="text" name="preco" value="<?= e($dados['preco']) ?>" placeholder="199.90" required>
        </label>
    </div>
    <label>Autor
        <select name="autor_id" required>
            <option value="">Selecione...</option>
            <?php foreach ($autores as $p): ?>
                <option value="<?= (int) $p['id'] ?>" <?= (string) $dados['autor_id'] === (string) $p['id'] ? 'selected' : '' ?>>
                    <?= e($p['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <div class="botoes">
        <button class="btn btn-principal" type="submit">Salvar</button>
        <a class="btn" href="index.php?page=livros">Cancelar</a>
    </div>
</form>
