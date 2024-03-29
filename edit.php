<?php
include_once("templates/header.php");
include_once("config/address.php");
$id = $_GET["id"];
?>
<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title">Editar contato</h1>
    <form id="edit-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
        <input type="hidden" name="type" value="edit">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome do contato:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required value="<?= $contact["name"] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Sobrenome do contato:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite o sobrenome" required value="<?= $contact["lastname"] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email do contato:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required value="<?= $contact["email"] ?>">
        </div>
        <div class="form-group">
            <label for="phone">Telefone do contato:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required value="<?= $contact["phone"] ?>">
        </div>

        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP" required value="<?= $contact["cep"] ?>">
            <button type="button" id="search-cep" class="btn btn-primary mt-3">Buscar Endereço</button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const searchCepButton = document.getElementById("search-cep");
                searchCepButton.addEventListener("click", function() {
                    const cepInput = document.getElementById("cep");
                    const cep = cepInput.value.replace(/\D/g, '');

                    if (cep.length === 8) {
                        fetchCepData(cep);
                    } else {
                        alert("CEP inválido.");
                    }
                });

                function fetchCepData(cep) {
                    const url = `https://viacep.com.br/ws/${cep}/json/`;

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                populateAddressFields(data);
                            } else {
                                alert("CEP não encontrado!");
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            alert("Erro ao buscar CEP.");
                        });
                }

                function populateAddressFields(data) {
                    document.getElementById("address").value = data.logradouro;
                    document.getElementById("neighborhood").value = data.bairro;
                    document.getElementById("city").value = data.localidade;
                    document.getElementById("state").value = data.uf;
                }
            });
        </script>

        <div class="form-group">
            <label for="address">Endereço:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Digite o endereço" required value="<?= $contact["address"] ?>">
        </div>
        <div class="form-group">
            <label for="complement">Complemento:</label>
            <input type="text" class="form-control" id="complement" name="complement" placeholder="Digite o complemento" required value="<?= $contact["complement"] ?>">
        </div>
        <div class="form-group">
            <label for="neighborhood">Bairro:</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Digite o bairro" required value="<?= $contact["neighborhood"] ?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Digite a cidade" required value="<?= $contact["city"] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="state">Estado:</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Digite o estado" required value="<?= $contact["state"] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="observations">Observações</label>
            <textarea class="form-control" id="observations" name="observations" rows="3" placeholder="Insira as observações"><?= $contact["observations"] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<?php include_once("templates/footer.php") ?>