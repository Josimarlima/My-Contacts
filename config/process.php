<?php

    session_start();

    include_once ("connection.php");
    include_once ("url.php");
    include_once ("address.php");

    $data = $_POST;

    if(!empty($data)) {

    // Cria o contato
    if ($data["type"] === "create") {

        $name = $data["name"];
        $phone = $data["phone"];
        $cep = $data["cep"];
        $complement = $data["complement"] ?? '';
        $observations = $data["observations"];

        // Faz a consulta ao ViaCEP
        $viacep = new ViaCEP($cep);
        $address_data = $viacep->getAddress();

        // Verifica se o endereço foi encontrado
        if (isset($address_data['erro'])) {
            $_SESSION["msg"] = "CEP não encontrado!";
            header("Location: {$BASE_URL}create.php");
            exit;
        }

        $query = "INSERT INTO contacts (name, phone, cep, address, complement, neighborhood, city, state, observations) 
                    VALUES (:name, :phone, :cep, :address, :complement, :neighborhood, :city, :state, :observations)";

        $stmt = $conn->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":cep", $cep);
            $stmt->bindParam(":address", $address_data['address']['logradouro']);
            $stmt->bindParam(":complement", $complement);
            $stmt->bindParam(":neighborhood", $address_data['address']['bairro']);
            $stmt->bindParam(":city", $address_data['address']['localidade']);
            $stmt->bindParam(":state", $address_data['address']['uf']);
            $stmt->bindParam(":observations", $observations);
        try {
            $stmt->execute();
            $_SESSION["msg"] = "Contato adicionado com sucesso!";

        } catch (PDOException $e) {
            // verificando erro
            $error = $e->getMessage();
            echo "Erro: $error";
        }

            //Deleta contato
        } else if ($data["type"] === "delete") {
            $id = $data["id"];

            $query = "DELETE FROM contacts WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":id", $id);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Contato removido com sucesso!";
            } catch (PDOException $e) {
                //Verrificando erros
                $error = $e->getMessage();
                echo "Erro: $error";
            }

        //Editar contatos
        } else if ($data["type"] === "edit") {

            $name = $data["name"];
            $phone = $data["phone"];
            $cep = $data["cep"];
            $complement = $complement["complement"];
            $observations = $data["observations"];
            $id = $data["id"];

        // Faz a consulta ao banco de dados para verificar se o contato existe
        $query = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o contato foi encontrado
        if (!$contact) {
            $_SESSION["msg"] = "Contato não encontrado!";
            header("Location: {$BASE_URL}index.php");
            exit;
        }

        // Faz a consulta ao ViaCEP
        $viacep = new ViaCEP($cep);
        $address = $viacep->getAddress();

        // Verifica se o endereço foi encontrado
        if (isset($address['erro'])) {
            $_SESSION["msg"] = "CEP não encontrado!";
            header("Location: {$BASE_URL}edit.php?id=$id");
            exit;
        }


            $query = "UPDATE contacts SET name = :name, phone = :phone, cep = :cep, address = :address, complement = :complement, neighborhood = :neighborhood, city = :city, state = :state, observations = :observations WHERE id = :id";
            $stmt = $conn->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":cep", $cep);
            $stmt->bindParam(":address", $address_data['address']['logradouro']);
            $stmt->bindParam(":complement", $complement);
            $stmt->bindParam(":neighborhood", $address_data['address']['bairro']);
            $stmt->bindParam(":city", $address_data['address']['localidade']);
            $stmt->bindParam(":state", $address_data['address']['uf']);
            $stmt->bindParam(":observations", $observations);
            $stmt->bindParam(":id", $id);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Contato atualizado com sucesso!";
                
            } catch (PDOException $e) {
                // verificando erro
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }
        header("Location: ". $BASE_URL . "../index.php");
    } else {
        $id;

        if(!empty($_GET)) {
            $id = $_GET["id"];
    }
        // Retorna dado de um post específico
        if(!empty($id)) {

            $query = "SELECT * FROM contacts WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":id", $id);

            $stmt->execute();

            $contact = $stmt->fetch();

            // Retorna todos os contatos
        } else {

            $contacts = [];

            $query = "SELECT * FROM contacts";

            $stmt = $conn->prepare($query);

            $stmt->execute();

            $contacts = $stmt->fetchAll();

        }

    }