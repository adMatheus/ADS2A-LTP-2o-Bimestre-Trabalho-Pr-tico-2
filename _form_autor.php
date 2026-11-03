<?php if ($erro): ?><div class="aviso aviso-erro"><?= e($erro) ?></div><?php endif; ?>
<form method="post" class="formulario">
    <label>Nome do autor
        <input type="text" name="nome" value="<?= e($dados['nome']) ?>" required>
    </label>
    <label>Nacionalidade
        <input type="text" name="nacionalidade" value="<?= e($dados['nacionalidade']) ?>" required>
    </label>
    <div class="botoes">
        <button class="btn btn-principal" type="submit">Salvar</button>
        <a class="btn" href="index.php?page=autores">Cancelar</a>
    </div>
</form>
