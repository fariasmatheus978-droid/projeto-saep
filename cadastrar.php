<?php
require_once 'conexao.php';

$mensagem = "";

$metodo = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';

if ($metodo == 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : '';

    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($cidade)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, telefone, cidade) VALUES (:nome, :email, :telefone, :cidade)");
            $stmt->execute([
                'nome' => $nome,
                'email' => $email,
                'telefone' => $telefone,
                'cidade' => $cidade
            ]);
            
            echo "<script>alert('Cliente cadastrado com sucesso.'); window.location.href='index.php';</script>";
            exit;
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar (E-mail duplicado?): " . $e->getMessage();
        }
    } else {
        $mensagem = "Preencha todos os campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .erro { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Cadastrar Cliente</h2>
    <?php if (!empty($mensagem)): ?>
        <div class="erro"><?php echo htmlspecialchars($mensagem); ?></div>
    <?php endif; ?>
    <form action="cadastrar.php" method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="telefone" required>
        </div>
        <div class="form-group">
            <label>Cidade:</label>
            <input type="text" name="cidade" required>
        </div>
        <button type="submit" class="btn">Salvar Cliente</button>
    </form>
    <br>
    <a href="index.php" style="color: #007BFF; text-decoration: none;">Voltar para a listagem</a>
</div>
</body>
</html>