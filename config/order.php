<?php
    // Recupera o parâmetro de ordenação da URL
    $order = $_GET['order'] ?? '';

    // Verifica se a ordenação é válida
    if ($order !== 'asc' && $order !== 'desc') {
        $order = 'asc'; // Use ordem crescente por padrão se a seleção for inválida
    }

    // Constroe a consulta SQL de acordo com a ordenação escolhida
    $query = "SELECT * FROM contacts ORDER BY name $order";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $contacts = $stmt->fetchAll();
