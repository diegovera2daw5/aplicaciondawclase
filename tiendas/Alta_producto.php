<?php
session_start();

function Mostrarproveedores(){
         try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt=$con->query('select distinct proveedor,nom_prov from productos');

         echo '<table border align="center">';
         while($filas=$stmt->fetch(PDO::FETCH_ASSOC)){
             echo "<tr><td>".$filas['proveedor']."</td><td>".$filas['nom_prov']."</td></tr>";
         }
         echo "</table>";
         }catch (PDOException $ex){
        $ex->getMessage();
    }
}
    
?>
<html>
    <head><meta charset="utf-8">
        <style type="text/css">
            body{width:800px;height:768px; }
            h3,footer{text-align:center}
            header{background-color:gainsboro;}
        header ul{width:500px;height:50px;background-color: greenyellow;
            margin-left: 120px;margin-top: 20px}
        header ul li{float:left; width:100px;height:20px;margin-left:20px;
                     list-style-type: none}   
        section{clear: both}
        section table{margin-top:20px}
        footer{background-color: greenyellow;margin-top: 345px;height: 30px;position: absolute;width:800px}
        a,footer{text-decoration:none;color:gray;}
        article{text-align: center;font-size: 2em}
        </style>
    </head>
    <body>
        <header>
        <h3>Has iniciado sesion como:<?php echo "\n"; echo $_SESSION['usuario'];?></h3>
        <ul>
            <li><a href="Consultar.php">Consulta</a></li>
            <li><a href="Alta_producto.php">Alta</a></li>
            <li><a href="Baja_producto.php">Baja Y Modificacion</a></li>
            <li><a href="menu2.php">Ir al Inicio</a></li>
        </ul>
        </header>
        <section>
        <table align="center">
                
            <form method="POST" action="formulario_alta.php">
            <tr>
                <td><input type="radio" name="proveedor" value="1">Proveedor creado</td>                        
                <td><input type="radio" name="proveedor" value="2">Proveedor nuevo</td>
                
            </tr>
            <tr>
                <td align="right">
                    <input type="submit" name="Alta">
                </td>
                <td>
                    <a href="menu2.php">Cancelar</a>
                </td>
            </tr>
            </form>
        </table>
        <article >Proveedores:<?php Mostrarproveedores();?></article>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>
