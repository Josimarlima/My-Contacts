<?php

class ViaCEP
{
    private $cep;
    private $street;
    private $neighborhood;
    private $city;
    private $state;

    public function __construct($cep)
    {
        $this->cep = $cep;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getAddress()
    {
        $url = "https://viacep.com.br/ws/" . $this->cep . "/json/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($result);
        if (!empty($data->erro)) {
            throw new Exception("CEP inválido");
        }

        return [
            'address' => [
                'logradouro' => $data->logradouro ?? '',
                'bairro' => $data->bairro ?? '',
                'localidade' => $data->localidade ?? '',
                'uf' => $data->uf ?? ''
            ]
        ];
}
}