<?php

class Saida
{
    private $id;
    private $nome;
    private $descricao;
    private $categoria;
    private $dataSaida;
    private $valor;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return ($this->id);
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return ($this->nome);
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return ($this->descricao);
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getCategoria()
    {
        return ($this->categoria);
    }

    public function setDataSaida($dataSaida)
    {
        $this->dataSaida = $dataSaida;
    }

    public function getDataSaida()
    {
        return ($this->dataSaida);
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

        return ($formatter->formatCurrency($this->valor, 'BRL'));
    }
}
