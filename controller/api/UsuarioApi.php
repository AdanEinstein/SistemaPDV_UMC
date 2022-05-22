<?php
require_once(__DIR__."/../../database/classDAO.php");
require_once(__DIR__."/../../model/classUsuarios.php");
class UsuarioApi
{
    public static function getUserByEmailPassword(string $login, string $senha)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_usuarios WHERE login = :login AND senha = :senha";
        
        if ($dados = $conexao->select($sql, [":login" => $login, ":senha" => $senha])){
            if ($dados["login"] == $login and $dados["senha"] == $senha) {
                $usuario = new Usuario($dados['id'], $dados['login'], $dados['senha'], $dados['perfil']);
                return $usuario;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
