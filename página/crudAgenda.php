<?php
// conectar ao banco de dados
$db = new mysqli('localhost', 'root', '', 'agenda');

// funções para crud
function getContatos() {
    global $db
    $sql = "SELECT * FROM agenda";
    $result = $db->query($sql);
    $contatos = [];
    while ($row = $result->fetch_assoc()) {
        $contatos[] = $row;
    }
    return $contatos;
}

function adicionarContato($nome, $email, $telefone, $data_nascimento) {
    global $db;
    $sql = "INSERT INTO contatos (nome, email, telefone, data_nascimento) VALUES ('$nome', $email, $telefone, $data_nascimento)";
    $db->query($sql);
}

function editarContato($id, $nome, $email, $telefone, $data_nascimento) {
    global $db;
    $sql = "UPDATE contatos SET nome = '$nome', email = '$email', telefone = '$telefone', data_nascimento = '$data_nascimento' WHERE id = $id";
    $db->query($sql);
}

function excluirContato($id) {
    global $db;
    $sql = "DELETE FROM contatos WHERE id = $id";
    $db->query($sql);
}

// ações do CRUD
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;
$id = isset($GET['id']) ? intval($_GET['id']) : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
$data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';

if ($acao === 'adicionar') {
    adicionarContato($nome, $email, $telefone, $data_nascimento);
    header ('Location: crud_php');
    exit();
} elseif ($acao === 'editar') {
    $id = intval($_GET['id']);
    $nomeoriginal = ($_GET['nome']);
    $emailoriginal = ($_GET['email']);
    $telefoneoriginal = ($_GET['telefone']);
    $data_nascimentooriginal = ($_GET['data_nascimento']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    editarContato($id, $nome, $email, $telefone, $data_nascimento);
    header('Location: editar.php?id=' . $id . 'nome=' . $nomeoriginal . 'email=' . $emailoriginal . 'telefone=' . $telefoneriginal . 'data_nascimento=' . $data_nascimentooriginal);
    // redirecionar para editar.php com o ID
    exit();
} elseif ($acao === 'excluir') {
    excluirContato($id);
    header('Location: crud.php');
    exit();
}

// obter todos os nomes
$contatos = getContatos();
?>

<h1>Lista de contatos</h1>
<form method="post" action="acao=adicionar">
    <label for="nome">Nome: </label>
    <input type="text" id="nome" name="name" required="required">
    <label for="email">E-mail: </label>
    <input type="email" id="email" name="email" required="required">
    <label for="telefone">Telefone/Telefon Celular: </label>
    <input type="tel" id="telefone" name="telefone" required="required">
    <label for="data_nascimento">Data de nascimento: </label>
    <input type="date" id="data_nascimento" name="data_nascimento" required="required">
    <button type="submit">Adicionar</button>
</form>
<table border="border">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Data de nascimento</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($contatos as $contatos): ?>
    <tr>
        <td><?php echo $nome['id']; ?></td>
        <td><?php echo $nome['nome']; ?></td>
        <td><?php echo $email['email']; ?></td>
        <td><?php echo $telefone['telefone']; ?></td>
        <td><?php echo $data_nascimento['data_nascimento']; ?></td>
        <td>
            <a href="?acao=editar&id=<?php echo $contato['id']; ?>
            &nome=<?php echo urlencode($contato['nome']); ?>
            &email=<?php echo urlencode($contato['email']); ?>
            &telefone=<?php echo urlencode($contato['telefone']); ?>
            &data_nascimento=<?php echo urlencode($contato['data_nascimento']); ?>">Editar</a>
            <a href="?acao=excluir&id=<?php echo $contato['id']; ?>">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php $db->close(); ?>

