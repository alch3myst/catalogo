<!-- 
Sql do banco de dados
CREATE TABLE ContatoDosClientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20)
);
-->

<?php

header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");

class ContatoAPI {
	private $pdo = null;
	private $stmt = null;
	public $contatoApiKey = "123456";

    public function __construct($dbHost, $dbName, $dbUsername, $dbPassword) {
		try {
			$this->pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset='utf8mb4'", $dbUsername, $dbPassword,
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);
		} catch (PDOException $e) {
			die("[Usuario.php] Erro de conexão com banco de dados:\n" . $e->getMessage());
		}
    }

	function __destruct () {
		if ($this->stmt!==null) { $this->stmt = null; }
		if ($this->pdo!==null) { $this->pdo = null; }
	}

	// Adicionar contato
	public function adicionarContato($nome, $email, $telefone) {
		$this->stmt = $this->pdo->prepare("INSERT INTO ContatoDosClientes (nome, email, telefone) VALUES (?, ?, ?)");
		$this->stmt->execute([$nome, $email, $telefone]);
		echo "Ok";
	}

	// Lista todos contatos
	public function listarTodosContatos() {
		$this->stmt = $this->pdo->query("SELECT * FROM ContatoDosClientes");
		$json = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		print_r(json_encode($json));
	}

	// Seleciona um contato por id
	// Uso interno
	public function selecionarContatoPorID($id) {
		$this->stmt = $this->pdo->prepare("SELECT * FROM ContatoDosClientes WHERE id = ?");
		$this->stmt->execute([$id]);
		$json =  $this->stmt->fetch(PDO::FETCH_ASSOC);
		print_r(json_encode($json));
	}

	// Seleciona um contato por email
	public function selecionarContatoPorEmail($email) {
		$this->stmt = $this->pdo->prepare("SELECT * FROM ContatoDosClientes WHERE email = ?");
		$this->stmt->execute([$email]);
		$json = $this->stmt->fetch(PDO::FETCH_ASSOC);
		print_r(json_encode($json));
	}

	// Atualiza um contato
	public function atualizarContato($id, $nome, $email, $telefone) {
		$this->stmt = $this->pdo->prepare("UPDATE ContatoDosClientes SET nome = ?, email = ?, telefone = ? WHERE id = ?");
		$this->stmt->execute([$nome, $email, $telefone, $id]);
		echo "Ok";
	}

	// Deleta um contato usando id
	// Uso interno
	public function deletarContatoPorID($id) {
		$this->stmt = $this->pdo->prepare("DELETE FROM ContatoDosClientes WHERE id = ?");
		$this->stmt->execute([$id]);
		echo "Ok";
	}
}

$contatoAPI = new ContatoAPI('localhost:3306', 'banco', 'root', 'root');
$APIKey = filter_var($_POST["apiKey"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$modo = filter_var($_GET["modo"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($contatoAPI->contatoApiKey == $APIKey) {
	printf("Ok");
	switch ($modo) {
		case 'Adicionar':
			$nome = filter_var($_POST["nome"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$telefone = filter_var($_POST["telefone"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$contatoAPI->adicionarContato($nome, $email, $telefone);
			break;

		case 'ListarTodos':
			$contatoAPI->listarTodosContatos();
			break;

		case 'SelecionarPorID':
			$id = filter_var($_POST["id"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$contatoAPI->selecionarContatoPorID($id);
			break;

		case 'SelecionarPorEmail':
			$email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$contatoAPI->selecionarContatoPorEmail($email);
			break;

		case 'AtualizarContato':
			$id = filter_var($_POST["id"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$nome = filter_var($_POST["nome"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$telefone = filter_var($_POST["telefone"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$contatoAPI->atualizarContato($id, $nome, $email, $telefone);
				break;
		
		case 'DeletarContato':
			$id = filter_var($_POST["id"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$contatoAPI->deletarContatoPorID($id);
			break;

		default:
			$contatoAPI->__destruct();
			return;
			break;
	}
} else {
	printf("Acesso negado");
	$contatoAPI->__destruct();
	return;
}