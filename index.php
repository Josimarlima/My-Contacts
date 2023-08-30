<?php

include_once("templates/header.php");
?>


<?php if (isset($printMsg) && $printMsg != "") : ?>
    <p id="msg"><?= $printMsg ?></p>
<?php endif; ?>

<h1 id="main-title">My Contacts</h1>


<!-- Botão para abrir o modal -->
<div class="button-menu-container">
    <div class="search-container">
        <form method="GET" action="#searchResultsModal" class="mb-3">
            <select name="search-type" id="search-type">
                <option value="" disabled selected>Opções</option>
                <option value="name">Nome</option>
                <option value="lastname">Sobrenome</option>
                <option value="phone">Telefone</option>
            </select>
            <input type="text" id="search-input" name="search-input" placeholder="Pesquisar...">
            <button type="button" class="btn btn-primary" id="search-button">Pesquisar</button>
        </form>
    </div>


    <!-- Ajusta em ordem crescente e decrescente -->
    <div class="sort-form">
        <form method="GET" action="index.php" class="mb-3">
            <label for="order">Ordenar por:</label>
            <select name="order" id="order">
                <option value="asc" <?= ($order === 'asc') ? 'selected' : '' ?>>Ordem Crescente</option>
                <option value="desc" <?= ($order === 'desc') ? 'selected' : '' ?>>Ordem Decrescente</option>
            </select>
            <button type="submit" class="btn btn-primary">Aplicar</button>
        </form>
    </div>
</div>

<?php if (count($contacts) > 0) : ?>
    <table class="table" id="contacts-table">
        <thead>
            <tr>
                <th scope="col" class="col-name">Nome</th>
                <th scope="col" class="col-lastname">Sobrenome</th>
                <th scope="col" class="col-phone">Telefone</th>
                <th scope="col" class="col-action"></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <td><?= $contact["name"] ?></td>
                    <td><?= $contact["lastname"] ?></td>
                    <td><?= $contact["phone"] ?></td>
                    <td class="actions">
                        <a href="<?= $BASE_URL ?>show.php?id=<?= $contact['id'] ?>"><i class="fas fa-eye check-icon"></i></a>
                        <a href="<?= $BASE_URL ?>edit.php?id=<?= $contact['id'] ?>"><i class="far fa-edit edit-icon"></i></a>
                        <form class="delete-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                            <button type="submit"><i class="fas fa-times delete-icon"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p id="empty-list-text">Ainda não há contatos na sua agenda, <a href="<?= $BASE_URL ?>create.php">Clique aqui para adicionar</a>.</p>
<?php endif; ?>



<?php
include_once("templates/footer.php");
?>