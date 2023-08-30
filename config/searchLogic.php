<?php
include_once("process.php");
include_once("connection.php");
include_once("url.php");

// Recupera o tipo de pesquisa da URL
$searchType = $_GET['search-type'] ?? '';
$searchInput = $_GET['search-input'] ?? '';

// Recupera o parâmetro de ordenação da URL
$order = $_GET['order'] ?? '';

// Verifica se o formulário de pesquisa foi enviado
if (!empty($searchType) && !empty($searchInput)) {
    if ($searchType === 'name') {
        $column = 'name';
    } elseif ($searchType === 'lastname'
    ) {
        $column = 'lastname';
    } elseif ($searchType === 'phone'
    ) {
        $column = 'phone';
    } else {
        // Digite um Nome, Sobrenome ou Telefone para pesquisa
    }

    $query = "SELECT * FROM contacts WHERE 
        LOWER($column) LIKE LOWER(:searchInput) OR LOWER($column) LIKE LOWER(CONCAT('%', :searchInput, '%'))
        ORDER BY name $order";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(":searchInput", '%' . $searchInput . '%');
    $stmt->execute();
    $contacts = $stmt->fetchAll();

    if (count($contacts) > 0) {
        echo '<table class="table" id="search-results-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Nome</th>';
        echo '<th scope="col">Sobrenome</th>';
        echo '<th scope="col">Telefone</th>';
        echo '<th scope="col"></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($contacts as $contact) {
            echo '<tr>';
            echo '<td>' . $contact["name"] . '</td>';
            echo '<td>' . $contact["lastname"] . '</td>';
            echo '<td>' . $contact["phone"] . '</td>';
            echo '<td class="actions">';
            echo '<a href="' . $BASE_URL . '../show.php?id=' . $contact['id'] . '"><i class="fas fa-eye check-icon"></i></a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Nenhum contato encontrado.</p>';
    }

}
