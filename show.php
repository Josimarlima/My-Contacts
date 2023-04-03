<?php include_once("templates/header.php") ?>
<div class="container" id="view-contact-container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title"><?= $contact["name"] ?></h1>
    <p class="bold">Telefone:</p>
    <p><?= $contact["phone"] ?></p>
    <p class="bold">Cep:</p>
    <p><?= $contact["cep"] ?></p>
    <p class="bold">Enderço:</p>
    <p><?= $contact["address"] ?></p>
    <p class="bold">Complemento:</p>
    <p><?= $contact["complement"] ?></p>
    <p class="bold">Enderço:</p>
    <p><?= $contact["address"] ?></p>
    <p class="bold">Bairro:</p>
    <p><?= $contact["neighborhood"] ?></p>
    <p class="bold">Cidade:</p>
    <p><?= $contact["city"] ?></p>
    <p class="bold">Estado:</p>
    <p><?= $contact["state"] ?></p>
    <p class="bold">Observações:</p>
    <p><?= $contact["observations"] ?></p>
</div>
<?php include_once("templates/footer.php") ?>