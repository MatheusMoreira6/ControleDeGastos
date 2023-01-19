<?php

class Entrada
{
    private $id;
    private $nome;
    private $descricao;
    private $categoria;
    private $dataEntrada;
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

    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
    }

    public function getDataEntrada()
    {
        return ($this->dataEntrada);
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
