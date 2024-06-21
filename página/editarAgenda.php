<?php
    // Conectar ao banco de dados
    $db = new mysqli('localhost', 'root', '', 'agenda');

    if ($db->connect_error) {
        echo "Erro: Falha ao conectar ao banco de dados. " . $db->connect_error;
        exit();
    }

    // Verificar se o ID foi recebido e validar como inteiro
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);    
    } else {
        echo "Erro: ID não recebido.";
        exit();
    }

    // Buscar o nome atual e armazenar o nome original
    $sql = "SELECT nome, email, telefone, data_nascimento FROM contatos WHERE id = $id";
    $result = $db->query($sql);

    if ($result->num_rows == 0) {
        echo "Erro: Nome não encontrado no banco de dados.";
        exit();
    }

    $contato = $result->fetch_assoc();
    $nomeOriginal = $contato['nome'];
    $emailOriginal = $contato['email'];
    $telefoneOriginal = $contato['telefone'];
    $data_nascimentoOriginal = $contato['data_nascimento'];

    // Se o novo nome foi recebido, validar e atualizar no banco de dados
    if (isset($_POST['novo_nome'])) {
        $novoNome = trim($_POST['novo_nome']);
        $novoNome = filter_var($novoNome, FILTER_SANITIZE_STRING);

        if ($novoNome === '') {
            echo "Erro: Novo nome não pode ser vazio.";
            exit();
        }

        $sql = "UPDATE contatos SET nome = '$novoNome' WHERE id = $id";
        $result = $db->query($sql);

        if ($result === false) {
            echo "Erro: Falha ao atualizar o nome.";
            exit();
        }

        header('Location: agenda.php');
        exit();
    }

    ?>

    <h1>Editar Nome</h1>
    <form method="post">    
        <label for="novo_nome">Substituir <?php echo $nomeOriginal; ?>:</label>
        <input type="text" id="novo_nome" name="novo_nome" required="required"><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <input type="submit" value="Atualizar">
    </form>

<?php $db->close(); ?>