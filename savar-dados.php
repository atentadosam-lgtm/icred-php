<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $line = sprintf(
        "%s | %s | %s | %s\n",
        date('Y-m-d H:i:s'),
        $data['nome'],
        $data['telefone'],
        $data['cpf']
    );
    
    file_put_contents('solicitacoes.txt', $line, FILE_APPEND | LOCK_EX);
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>