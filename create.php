<?php include_once("templates/header.php");
include_once("config/address.php");
?>
<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title">Criar Contato</h1>
    <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
            <label for="name">Nome do contato:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome" required>
        </div>

        <div class="form-group">
            <label for="name">Sobrenome do contato:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite o sobrenome" required>
        </div>

        <div class="form-group">
            <label for="phone">Email do contato:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone do contato:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required>
        </div>

        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP" required>
            <button type="button" class="btn btn-primary mt-3" id="searchCep">Buscar Endereço</button>
        </div>


        <!-- Função searchAddress -->
        <script>
            document.getElementById("searchCep").addEventListener("click", function() {
                var cep = document.getElementById("cep").value;
                if (cep) {
                    fetchAddress(cep);
                }
            });

            function fetchAddress(cep) {
                fetch("https://viacep.com.br/ws/" + cep + "/json/")
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById("address").value = data.logradouro || '';
                            document.getElementById("neighborhood").value = data.bairro || '';
                            document.getElementById("city").value = data.localidade || '';
                            document.getElementById("state").value = data.uf || '';
                        } else {
                            alert("CEP não encontrado!");
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao buscar o CEP:", error);
                    });
            }
        </script>
        <div class="form-group">
            <label for="address">Endereço:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Digite o endereço">
        </div>
        <div class="form-group">
            <label for="complement">Complemento:</label>
            <input type="text" class="form-control" id="complement" name="complement" placeholder="Digite o complemento">
        </div>
        <div class="form-group">
            <label for="neighborhood">Bairro:</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Digite o bairro">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Digite a cidade">
        </div>
        <div class="form-group">
            <label for="state">Estado:</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="Digite o estado">
        </div>
        <div class="form-group">
            <label for="observations">Observações:</label>
            <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Insira as observações" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
</div>





<?php include_once("templates/footer.php"); ?>