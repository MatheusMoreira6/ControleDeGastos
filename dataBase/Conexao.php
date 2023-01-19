<?php

class Conexao
{
    private static $conexao;
    private static $host = ' ';
    private static $database = ' ';
    private static $username = ' ';
    private static $password = ' ';

    private function __construct()
    {
    }

    public static function getConexao()
    {
        if (!isset(self::$conexao)) {
            self::$conexao = mysqli_connect(self::$host, self::$username, self::$password, self::$database);

            if (!self::$conexao) {
                die("Connection failed: " . mysqli_connect_error());
            }

            return (self::$conexao);
        } else {
            return (self::$conexao);
        }
    }
}
