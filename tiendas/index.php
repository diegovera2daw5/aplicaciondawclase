<?php
session_start();
?>
<html>
    <head><meta charset="utf-8">
        <style type="text/css">
            body{width:800px;height:768px; }
            h1,footer{text-align:center}
            header{background-color:gainsboro;height:40px}
        section{text-align: center}
        
        section table{margin-top:20px;}
        footer{background-color: greenyellow;margin-top: 560px;height: 30px;position: absolute;width:800px}
        a,footer{text-decoration:none;color:gray;}
        </style>
    </head>
    <body>
        <section>
        <header>
            <h1>Formulario de Acceso</h1>
        </header>
        <p>Introduzca ambos campos para poder entrar en la Aplicacion</p>
        <table align="center">
        <form action="" method="POST">
            <tr><td>Usuario:</td><td> <input type="text" name="usu"></td></tr>
            <tr><td>Contraseña: </td><td><input type="password" name="pass"></td></tr>
            <tr >
            <td colspan="2" align="center"><input type="submit" value="Entrar" name="Entrar">
            <input type="reset" value="Borrar" name="Borrar"></td>
            </tr>
        </form>
        </table>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>
<?php
if(isset($_REQUEST['Entrar'])){
    $usuario=  isset($_REQUEST['usu'])? $_REQUEST['usu']:'';
    $password=  isset($_REQUEST['pass'])? $_REQUEST['pass']:'';
    
    if(empty($usuario)){
      echo  "No ha introducido usuario<br>";
    }else{
        if(empty($password)){
          echo  "No ha introducido contraseña<br>";
          
        }else{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt=$con->prepare('select usu from clientes where usu=:usuario and pass=:password');
            $stmt->execute(array(':usuario'=>$usuario,':password'=>$password));
            
            if($stmt->rowCount()>0){
            
                $_SESSION['usuario']=$usuario;
                header('location: menu2.php');
            }else{
                echo "Usuario/Contraseña no validos";
            }
        }
        
    }
    
    
}
?>