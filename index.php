<?php
require_once 'conexao.php';

$stmt = $pdo->query("SELECT * FROM clientes ORDER BY id DESC");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes - SAEP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; }
        .btn { display: inline-block; padding: 8px 12px; background: #007BFF; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 15px; }
        .btn-danger { background: #dc3545; }
        .btn-warning { background: #ffc107; color: black; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
<div class="container">
    <h2>Lista de Clientes</h2>
    <a href="cadastrar.php" class="btn">Cadastrar Novo Cliente</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($clientes) > 0): ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cidade']); ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="excluir.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Nenhum cliente cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>