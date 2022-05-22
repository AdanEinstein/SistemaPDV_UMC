<?php
require_once(__DIR__ . "/../../database/classDAO.php");
require_once(__DIR__ . "/../../model/classUsuarios.php");

class UsuarioApi
{
    public static function getUserByEmailPassword(string $login, string $senha)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_usuarios WHERE login = :login AND senha = :senha";

        if ($dados = $conexao->select($sql, [":login" => $login, ":senha" => $senha])) {
            if ($dados["login"] == $login and $dados["senha"] == $senha) {
                return new Usuario($dados['id'], $dados['login'], $dados['senha'], $dados['perfil']);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getUserById(int $id)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_usuarios WHERE id = :id";
        $param = [":id" => $id];
        $dados = $conexao->select($sql, $param, false, true);
        return new Usuario($dados->id, $dados->login, $dados->senha, $dados->perfil);
    }

    public static function getUserByLogin(string $login)
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_usuarios WHERE login = :login";
        return $conexao->select($sql, [":login" => $login]);
    }

    public static function getUsers()
    {
        $conexao = new DAO();
        $sql = "SELECT * FROM pdv_usuarios";
        return $conexao->select($sql, null, true);
    }

    public static function postUser(string $login, string $senha): bool
    {
        $conexao = new DAO();
        $sql = "INSERT INTO pdv_usuarios VALUES (DEFAULT, :user, :password, :perfil)";
        $params = [":user" => $login, ":password" => $senha, ":perfil" => 'pendente'];
        return $conexao->executeSQL($sql, $params);
    }

    public static function putUserPerfil(int $id, string $perfil)
    {
        $conexao = new DAO();
        $sql = "UPDATE pdv_usuarios SET perfil = :perfil WHERE id = :id";
        $params = [":perfil"=>$perfil, ":id"=>$id];
        return $conexao->executeSQL($sql, $params);
    }

    public static function deleteUser(int $id)
    {
        $conexao = new DAO();
        $sql = "DELETE FROM pdv_usuarios WHERE id = :id";
        $params = [":id"=>$id];
        return $conexao->executeSQL($sql, $params);
    }
}
