<?php
session_start();

function Mostrarproductos(){
         try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt=$con->query('select * from productos');

         echo '<table border align="center">';
         echo '<tr><th>Codigo</th><th>Proveedor</th><th>Producto</th><th colspan="2">Accion</th></tr>';
         while($filas=$stmt->fetch(PDO::FETCH_ASSOC)){
             echo "<tr><td>".$filas['cod_producto']."</td><td>".$filas['nom_prov'].
                  "</td><td>".$filas['nombre_producto'].'</td>
                    <td>
                    <a  href="baja_total.php?cod='.$filas['cod_producto'].'">Eliminar</a>
                    </td>
                    <td>
                    <a  href="Modificar.php?cod='.$filas['cod_producto'].'">Modificar</a></td></tr>';
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
        footer{background-color: greenyellow;margin-top: 310px;height: 30px;
        position: absolute;width:800px}
        a,footer{text-decoration:none;color:gray;}
        section{text-align: center;font-size: 3em}
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
        <article>Productos en la Tienda:<?php Mostrarproductos();?></article>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>

