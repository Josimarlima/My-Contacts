<?php

include_once("connection.php");

function createLog($action, $contactBeforeEdit, $contactAfterEdit) {
    global $conn; // Acesso à conexão global

    // Insere o registro de log no banco de dados
    $query = "INSERT INTO logs (timestamp, action, contact_id, changes) VALUES (NOW(), :action, :contactId, :changes)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":action", $action);
    $stmt->bindParam(":contactId", $contactBeforeEdit['id']);

    // Determina as alterações feitas
    $changes = [];
    if ($contactBeforeEdit['name'] !== $contactAfterEdit['name']) {
        $changes[] = "Nome alterado de '{$contactBeforeEdit['name']}' para '{$contactAfterEdit['name']}'";
    }
    if ($contactBeforeEdit['lastname'] !== $contactAfterEdit['lastname']) {
        $changes[] = "Sobrenome alterado de '{$contactBeforeEdit['lastname']}' para '{$contactAfterEdit['lastname']}'";
    }
    if ($contactBeforeEdit['email'] !== $contactAfterEdit['email']) {
        $changes[] = "Email '{$contactBeforeEdit['email']}' para '{$contactAfterEdit['email']}'";
    }
    if ($contactBeforeEdit['phone'] !== $contactAfterEdit['phone']) {
        $changes[] = "Telefone '{$contactBeforeEdit['phone']}' para '{$contactAfterEdit['phone']}'";
    }
    if ($contactBeforeEdit['cep'] !== $contactAfterEdit['cep']) {
        $changes[] = "Cep de '{$contactBeforeEdit['cep']}' para '{$contactAfterEdit['cep']}'";
    }
    if ($contactBeforeEdit['address'] !== $contactAfterEdit['address']) {
        $changes[] = "Endereço de '{$contactBeforeEdit['address']}' para '{$contactAfterEdit['address']}'";
    }
    if ($contactBeforeEdit['complement'] !== $contactAfterEdit['complement']) {
        $changes[] = "Complemento de '{$contactBeforeEdit['complement']}' para '{$contactAfterEdit['complement']}'";
    }
    if ($contactBeforeEdit['neighborhood'] !== $contactAfterEdit['neighborhood']) {
        $changes[] = "Bairro de '{$contactBeforeEdit['neighborhood']}' para '{$contactAfterEdit['neighborhood']}'";
    }
    if ($contactBeforeEdit['city'] !== $contactAfterEdit['city']) {
        $changes[] = "Cidade de '{$contactBeforeEdit['city']}' para '{$contactAfterEdit['city']}'";
    }
    if ($contactBeforeEdit['state'] !== $contactAfterEdit['state']) {
        $changes[] = "Estado de '{$contactBeforeEdit['state']}' para '{$contactAfterEdit['state']}'";
    }

    // Insere o registro de log no banco de dados
    $query = "INSERT INTO logs (timestamp, action, contact_id, changes) VALUES (NOW(), :action, :contactId, :changes)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":action", $action);
    $contactId = $contactBeforeEdit['id']; // Define a variável $contactId
    $stmt->bindParam(":contactId", $contactId);
    $changesMessage = implode(", ", $changes); // Transforma as alterações em uma string
    $stmt->bindParam(":changes", $changesMessage);
    $stmt->execute();
}