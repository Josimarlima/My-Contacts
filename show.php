<?php
include_once("templates/header.php");
// Limpa a mensagem de erro
if (isset($_SESSION['msg'])) {
    $printMsg = $_SESSION['msg'];
    $_SESSION['msg'] = "";
}

?>

<div class="container" id="view-contact-container">
    <?php if (isset($printMsg) && $printMsg != "") : ?>
        <p id="msg"><?= $printMsg ?></p>
    <?php endif; ?>
    <?php include_once("templates/backbtn.html"); ?>

    <div class="row">
        <div class="col">
            <h1 id="main-title"><?= $contact["name"] ?> <?= $contact["lastname"] ?></h1>
        </div>
        <div class="col-2">
            <div class="actions">
                <a href="<?= $BASE_URL ?>edit.php?id=<?= $contact['id'] ?>"><i class="far fa-edit edit-icon"></i></a>
                <form class="delete-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
                    <input type="hidden" name="type" value="delete">
                    <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                    <button type="submit"><i class="fas fa-times delete-icon"></i></button>
                </form>
            </div>
        </div>
    </div>

    <p class="bold">Email:</p>
    <p><?= $contact["email"] ?></p>

    <p class="bold">Telefone:</p>
    <p><?= $contact["phone"] ?></p>
    <div class="row">
        <div class="col">
            <p class="bold">Endereço:</p>
            <p><?= $contact["address"] ?></p>
        </div>
        <div class="col">
            <p class="bold">Complemento:</p>
            <p><?= $contact["complement"] ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="bold">Bairro:</p>
            <p><?= $contact["neighborhood"] ?></p>
        </div>
        <div class="col">
            <p class="bold">CEP:</p>
            <p><?= $contact["cep"] ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="bold">Cidade:</p>
            <p><?= $contact["city"] ?></p>
        </div>
        <div class="col">
            <p class="bold">Estado:</p>
            <p><?= $contact["state"] ?></p>
        </div>
    </div>
    <p class="bold">Observações:</p>
    <p><?= $contact["observations"] ?></p>
</div>


<?php include_once("templates/footer.php") ?>