<?php
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");

class ProdutosAPI {
	private $pdo = null;
	private $stmt = null;
	private $apiKey = "123456";
	
    public function __construct($dbHost, $dbName, $dbUsername, $dbPassword) {
		try {
			$this->pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUsername, $dbPassword,
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

	// Adicionar produto
	public function adicionarProduto($uuid, $nome, $linha, $colecao, $qtd_vendas, $valor_venda, $custo_producao, $roi, $json_data) {
		if (filter_var($_POST["apiKey"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) != $this->apiKey) return;

		$this->stmt = $this->pdo->prepare("INSERT INTO produtos_interno (uuid,nome,linha,colecao,qtd_vendas,valor_venda,custo_producao,roi,json_data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
		$this->stmt->execute([$uuid, $nome, $linha, $colecao, $qtd_vendas, $valor_venda, $custo_producao, $roi, $json_data]);

		print("Produto Adicionado");
	}

	// Lista todos produtos
	public function listarTodosProdutos() {
		$this->stmt = $this->pdo->query("SELECT * FROM produtos_interno");
		$json = json_encode($this->stmt->fetchAll(PDO::FETCH_ASSOC));
		print_r($json);
	}

	// Seleciona um produto por id
	public function selecionarProdutoPorID($id) {
		$this->stmt = $this->pdo->prepare("SELECT * FROM produtos_interno WHERE id = ?");
		$this->stmt->execute([$id]);
		$json = json_encode($this->stmt->fetch(PDO::FETCH_ASSOC));
		print_r($json);
	}

	public function selecionarProdutoPorColecao($colecao) {
		$this->stmt = $this->pdo->prepare("SELECT * FROM produtos_interno WHERE colecao = ?;");
		$this->stmt->execute([$colecao]);
		$json = json_encode($this->stmt->fetchAll(PDO::FETCH_ASSOC));
		print_r($json);
	}

	// Atualiza um produto
	public function atualizarProduto($nome, $linha, $colecao, $qtd_vendas, $valor_venda, $custo_producao, $roi, $json_data, $id) {
		if (filter_var($_POST["apiKey"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) != $this->apiKey) return;
		
		$this->stmt = $this->pdo->prepare("UPDATE produtos_interno SET nome = ?, linha = ?, colecao = ?, qtd_vendas = ?, valor_venda = ?, custo_producao = ?, roi = ?, json_data = ? WHERE id = ?");
		$this->stmt->execute([$nome, $linha, $colecao, $qtd_vendas, $valor_venda, $custo_producao, $roi, $json_data, $id]);
		print("Produto Atualizado");
	}

	// Deleta um produto usando id
	// Uso interno
	public function deletarProdutoPorID($id) {
		if (filter_var($_POST["apiKey"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) != $this->apiKey) return;
		
		$this->stmt = $this->pdo->prepare("DELETE FROM produtos_interno WHERE id = ?");
		$this->stmt->execute([$id]);
		print(`Produto Removido $id`);
	}
}

$produtosAPI = new ProdutosAPI('localhost:3306', 'banco', 'root', 'root');
$modo = filter_var($_GET["modo"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($modo) {
	case 'Adicionar':
		$uuid = filter_var($_POST["uuid"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$nome = filter_var($_POST["nome"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$linha = filter_var($_POST["linha"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$colecao = filter_var($_POST["colecao"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$qtd_vendas = filter_var($_POST["qtd_vendas"], FILTER_SANITIZE_NUMBER_INT);
		$custo_producao = filter_var($_POST["custo_producao"], FILTER_SANITIZE_NUMBER_FLOAT);
		$valor_venda = filter_var($_POST["valor_venda"], FILTER_SANITIZE_NUMBER_FLOAT);
		$roi = filter_var($_POST["roi"], FILTER_SANITIZE_NUMBER_FLOAT);
		$json_data = filter_var($_POST["json_data"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$produtosAPI->adicionarProduto($uuid, $nome, $linha, $colecao, $qtd_vendas, $custo_producao, $valor_venda, $roi, $json_data);
		$produtosAPI->__destruct();
		break;

	case 'ListarTodos':
		$produtosAPI->listarTodosProdutos();
		$produtosAPI->__destruct();
		break;

	case 'SelecionarPorID':
		$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
		$produtosAPI->selecionarProdutoPorID($id);
		$produtosAPI->__destruct();
		break;

	case 'SelecionarPorColecao':
		$colecao = filter_var($_POST["colecao"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$produtosAPI->selecionarProdutoPorColecao($colecao);
		$produtosAPI->__destruct();
		break;


	case 'AtualizarProduto':
		$nome = filter_var($_POST["nome"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$linha = filter_var($_POST["linha"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$colecao = filter_var($_POST["colecao"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$qtd_vendas = filter_var($_POST["qtd_vendas"], FILTER_SANITIZE_NUMBER_INT);
		$custo_producao = filter_var($_POST["custo_producao"], FILTER_SANITIZE_NUMBER_FLOAT);
		$valor_venda = filter_var($_POST["valor_venda"], FILTER_SANITIZE_NUMBER_FLOAT);
		$roi = filter_var($_POST["roi"], FILTER_SANITIZE_NUMBER_FLOAT);
		$json_data = filter_var($_POST["json_data"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

		$produtosAPI->atualizarProduto($nome, $linha, $colecao, $qtd_vendas, $valor_venda, $custo_producao, $roi, $json_data, $id);
		$produtosAPI->__destruct();
		break;
	
	case 'DeletarProduto':
		$id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

		$produtosAPI->deletarProdutoPorID($id);
		break;

	default:
		$produtosAPI->__destruct();
		break;
}
?>