<?php
session_start();
$cod=  isset($_GET['cod']) ? $_GET['cod']:"";
function Mostrarproductos(){
         try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt2=$con->query('select * from productos');

         echo '<table border align="center">';
         while($filas2=$stmt2->fetch(PDO::FETCH_ASSOC)){
             echo "<tr><td>".$filas2['cod_producto']."</td><td>".$filas2['nom_prov'].
                  "</td><td>".$filas2['nombre_producto'].'</td><td>
                   <a href="baja_total?cod='.$filas2['cod_producto'].'">Eliminar</a></td></tr>';
         }
         echo "</table>";
         }catch (PDOException $ex){
        $ex->getMessage();
    }
}

function Eliminar($cod){
     if(isset($_POST['Borrar'])){
        try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt3=$con->prepare('delete from productos where cod_producto=:cod ');
            $stmt3->execute(array(':cod'=>$cod));

            if($stmt3->rowCount()==1){
                echo '<p align="center">Eliminacion Correcta del producto</p>';
            }
         }catch (PDOException $ex){
        $ex->getMessage();
        }
    echo '<a href="menu2.php"></a>';
    }
}
?>

<html>
    <head><meta charset="utf-8">
        <style type="text/css">
            body{width:800px;height:768px;}
            h3,footer{text-align:center}
            header{background-color:gainsboro;}
        header ul{width:500px;height:50px;background-color: greenyellow;
            margin-left: 120px;margin-top: 20px}
        header ul li{float:left; width:100px;height:20px;margin-left:20px;
                     list-style-type: none}   
        section{clear: both}
        section table{margin-top:20px}
        footer{background-color: greenyellow;margin-top: 467px;height: 30px;
               position: absolute;width:800px}
        a,footer{text-decoration:none;color:gray;}
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
            <form method="POST" align="center" action="">
                Para eliminar el Producto pulse el Boton:<br>
                <input type="submit" value="Borrar" name="Borrar">
            </form>
            <?php
            try{
                $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
                $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
                $stmt=$con->prepare('select * from productos where cod_producto=:cod');
                $stmt->execute(array(':cod'=>$cod));

                 echo '<table border align="center">';
                 echo "<tr><th>Codigo</th><th>Producto</th><th>Categoria</th>
                 <th>Precio</th><th>Codigo del Proveedor</th><th>Proveedor</th></tr>";
                 while($filas=$stmt->fetch(PDO::FETCH_ASSOC)){
                     echo "<tr><td>".$filas['cod_producto']."</td><td>"
                             .$filas['nombre_producto']."</td><td>"
                             .$filas['categoria']."</td><td>"
                             .$filas['precio']."</td><td>"
                             .$filas['proveedor']."</td><td>"
                             .$filas['nom_prov']."</td></tr>";
                 }
                 echo "</table>";
            }catch (PDOException $ex){
                $ex->getMessage();
            }
            ?>
        <article><?php Eliminar($cod)?></article>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>