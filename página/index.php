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
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $endereco = $_POST['endereco'];
        $data_nascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];

        // Prepara a consulta SQL
        $sql = "INSERT INTO agenda (nome, email, telefone, estado, cidade, endereco, data_nascimento, cpf )
                VALUES (:nome, :email, :telefone, :estado, :cidade, :endereco, :data_nascimento, :cpf)";

        // Prepara a declaração
        $stmt = $pdo->prepare($sql);

        // Associa os parâmetros com os valores
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
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

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">
        <title>Agenda de contatos</title>
    </head>

    <body>
        <div class="p-3 mb-2 bg-secondary text-white container text-center rounded">
            <h1>Agenda de Contatos</h1>
            <p>Complete com os seus dados abaixo</p>
            <br>

            <form method="POST">
                <div>
                    <label for="nome">Nome completo:
                    </label>
                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        required="required">
                </div>
                <br>

                <div>
                    <label for="email">E-mail:
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        required="required"
                        placeholder="Tomate@email.com" >
                </div>
                <br>

                <div>
                    <label for="telefone">Telefone/Telefone Celular:
                    </label>
                    <input
                        type="tel"
                        name="telefone"
                        id="telefone"
                        required="required">
                </div>
                <br>

                <div>
                    <label for="estado">Estado:
                    </label>
                    <select
                        name="estado"
                        id="estado"
                        required="required">
                        <option value=""></option>
                        <option value="ac">AC</option>
                        <option value="al">AL</option>
                        <option value="ap">AP</option>
                        <option value="am">AM</option>
                        <option value="ba">BA</option>
                        <option value="ce">CE</option>
                        <option value="df">DF</option>
                        <option value="es">ES</option>
                        <option value="go">GO</option>
                        <option value="ma">MA</option>
                        <option value="mt">MT</option>
                        <option value="ms">MS</option>
                        <option value="mg">MG</option>
                        <option value="pa">PA</option>
                        <option value="pb">PB</option>
                        <option value="pr">PR</option>
                        <option value="pe">PE</option>
                        <option value="pi">PI</option>
                        <option value="rj">RJ</option>
                        <option value="rn">RN</option>
                        <option value="rs">RS</option>
                        <option value="ro">RO</option>
                        <option value="rr">RR</option>
                        <option value="sc">SC</option>
                        <option value="sp">SP</option>
                        <option value="se">SE</option>
                        <option value="to">TO</option>
                    </select>
                </div>
                <br>

                <div>
                    <label for="cidade">Cidade:
                    </label>
                    <input
                        type="text"
                        name="cidade"
                        id="cidade"
                        required="required">
                </div>
                <br>

                <div>
                    <label for="endereco">Endereço:
                    </label>
                    <input
                        type="text"
                        name="endereco"
                        id="endereco"
                        required="required" 
                        placeholder="Rua do Tomate, 123">
                </div>
                <br>

                <div>
                    <label for="data_nascimento">Data de nascimento:
                    </label>
                    <input
                        type="date"
                        name="data_nascimento"
                        id="data_nascimento"
                        required="required">
                </div>
                <br>

                <div>
                    <label for="cpf">CPF:
                    </label>
                    <input
                        type="text"
                        name="cpf"
                        id="cpf"
                        required="required">
                </div>
                <br>

                <button
                    type="submit"
                    class="btn btn-primary">Confirmar</button>
                <button
                    type="reset"
                    class="btn btn-primary">Excluir</button>
            </form>
        </div>
    </body>
</html>