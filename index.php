<?php
session_start();
include_once("ClassLogin.php");
$aux = new ControleLogin();

if(!isset($_SESSION['SAIR'])){
if(isset($_COOKIE['PCEmail'])){
  $email = $_COOKIE['PCEmail'];
  $senha = $_COOKIE['PCSenha'];
  $lembrar = true;

  echo($email);

  $aux -> LogIn($email, $senha, $lembrar);

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto coleta - Inicio</title>
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" 
    integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/inicio.css">
</head>
<body  class="text-center">
<div class="tudo">
    <div class="ajusta">
    <form class="form-signin" method="POST">
  <img class="mb-4" src="img/via.png" alt="" width="100" height="100">
  <h1 class="h3 mb-3 font-weight-normal">Faça Login</h1>
  <label for="inputEmail" class="sr-only">Email</label>
  <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email" required autofocus>
  <label for="inputPassword" class="sr-only">Senha</label>
  <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="lembrar" name="lembrar"> Lembrar Login
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="button">Sign in</button>
    </form>
    </div>
</div>
</body>
</html>
<?php
  if(isset($_POST['button'])){
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $lembrar = false;
    if(isset($_POST['lembrar'])){
      $lembrar = true;
    }

    
    $aux -> LogIn($email, $senha, $lembrar);


  }
?>
