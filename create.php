<?php include_once("templates/header.php"); ?>
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
            <label for="phone">Telefone do contato:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone" required>
        </div>
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP" required>
            <button type="button" class="btn btn-primary mt-3" onclick="searchAddress()">Buscar endereço</button>
        </div>
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
<script>
    $(document).ready(function() {
        $('#cep').blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if (validacep.test(cep)) {
                    $('#address').val("...");
                    $('#neighborhood').val("...");
                    $('#city').val("...");
                    $('#state').val("...");
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(data) {
                        if (!("erro" in data)) {
                            $('#address').val(data.logradouro);
                            $('#complement').val(data.complemento);
                            $('#neighborhood').val(data.bairro);
                            $('#city').val(data.localidade);
                            $('#state').val(data.uf);
                        } else {
                            alert("CEP não encontrado.");
                            $('#cep').val("");
                            $('#address').val("");
                            $('#complement').val("");
                            $('#neighborhood').val("");
                            $('#city').val("");
                            $('#state').val("");
                        }
                    });
                } else {
                    alert("Formato de CEP inválido.");
                    $('#cep').val("");
                    $('#address').val("");
                    $('#complement').val("");
                    $('#neighborhood').val("");
                    $('#city').val("");
                    $('#state').val("");
                }
            } else {
                $('#address').val("");
                $('#complement').val("");
                $('#neighborhood').val("");
                $('#city').val("");
                $('#state').val("");
            }
        });
    });

    function searchAddress() {
        var cep = $('#cep').val().replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                $('#address').val("...");
                $('#neighborhood').val("...");
                $('#city').val("...");
                $('#state').val("...");
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(data) {
                    if (!("erro" in data)) {
                        $('#address').val(data.logradouro);
                        $('#complement').val(data.complemento);
                        $('#neighborhood').val(data.bairro);
                        $('#city').val(data.localidade);
                        $('#state').val(data.uf);
                    } else {
                        alert("CEP não encontrado.");
                        $('#cep').val("");
                        $('#address').val("");
                        $('#complement').val("");
                        $('#neighborhood').val("");
                        $('#city').val("");
                        $('#state').val("");
                    }
                });
            } else {
                alert("Formato de CEP inválido.");
                $('#cep').val("");
                $('#address').val("");
                $('#complement').val("");
                $('#neighborhood').val("");
                $('#city').val("");
                $('#state').val("");
            }
        } else {
            $('#address').val("");
            $('#complement').val("");
            $('#neighborhood').val("");
            $('#city').val("");
            $('#state').val("");
        }
    }
</script>





<?php include_once("templates/footer.php"); ?>