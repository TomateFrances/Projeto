<?php
// Configurações do banco de dados
$dsn = 'mysql:host=localhost;dbname=agenda';
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO($dsn, $username, $password);

    // Configura para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $endereco = $_POST['endereco'];
        $data_nascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];

        // Prepara a consulta SQL
        $sql = "INSERT INTO lista (nomeCompleto, email, telefone, estado, cidade, endereco, data_nascimento, cpf )
                VALUES (:nomeCompleto, :email, :telefone, :estado, :cidade, :endereco, :data_nascimento, :cpf,)";

        // Prepara a declaração
        $stmt = $pdo->prepare($sql);

        // Associa os parâmetros com os valores
        $stmt->bindValue(':nomeCompleto', $nomeCompleto, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindValue(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $cpf, PDO::PARAM_STR);

        // Executa a consulta
        $stmt->execute();

        echo "Dados inseridos com sucesso!";
    }
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro: " . $e->getMessage();
}
?>