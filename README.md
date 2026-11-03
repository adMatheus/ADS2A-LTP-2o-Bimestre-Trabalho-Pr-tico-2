# Estante - Catálogo de Livros (CRUD em PHP + MySQL)

Sistema CRUD com duas entidades: **Autores** e **Livros** (cada livro pertence a um autor).
Arquitetura MVC simplificada: `config`, `models`, `controllers`, `views` e `public`.

## Como executar (XAMPP)
1. Copie a pasta `estante` para `C:\xampp\htdocs\`.
2. Inicie **Apache** e **MySQL** no painel do XAMPP.
3. Abra `http://localhost/phpmyadmin`, vá na aba **SQL**, cole o conteúdo de `database.sql` e execute.
4. Acesse `http://localhost/estante/public/`.

## Estrutura
```
estante/
├── config/database.php
├── controllers/ (LivroController.php, AutorController.php)
├── models/ (Livro.php, Autor.php)
├── views/
│   ├── includes/ (header.php, footer.php)
│   ├── livros/ (index_livro.php, create_livro.php, edit_livro.php, _form_livro.php)
│   └── autores/ (index_autor.php, create_autor.php, edit_autor.php, _form_autor.php)
├── public/ (index.php, css/style.css)
└── database.sql
```

## Observações
- Acesso ao banco com **PDO** e *prepared statements* (protege contra SQL Injection).
- Saída escapada com `htmlspecialchars` (protege contra XSS).
- Um autor que ainda possui livros não pode ser excluído (`ON DELETE RESTRICT`).
