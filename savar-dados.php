<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $line = "{$data['data']} | {$data['nome']} | {$data['telefone']} | {$data['cpf']}\n";
    file_put_contents('solicitacoes.txt', $line, FILE_APPEND | LOCK_EX);
    echo json_encode(['success' => true]);
}
?>
