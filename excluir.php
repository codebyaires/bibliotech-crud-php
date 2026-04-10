<?php
session_start();

require_once "config/conexao.php";

if (isset($_GET["excluir"])) {
    $id = $_GET["excluir"];
    $sql = "DELETE FROM livros WHERE id = '$id'";
    $res = mysqli_query($conexao, $sql);
}