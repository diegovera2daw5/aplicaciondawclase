<?php
session_start();
$cod=  isset($_GET['cod']) ? $_GET['cod']:"";

function Prodmodificar($cod){
   
            try{
                $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
                $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
                $stmt=$con->prepare('select * from productos where cod_producto=:cod');
                $stmt->execute(array(':cod'=>$cod));

                 echo '<table border align="center">';
                 
                 while($filas=$stmt->fetch(PDO::FETCH_ASSOC)){
                     echo 
'
    <tr>
<th>Codigo</th><th>Codigo del Proveedor</th><th>Proveedor</th></tr>
    <tr>
    <td><input type="text" value="'.$filas['cod_producto'].'" name="codigo" readonly="readonly"></td>
    <td><input type="text" value="'.$filas['proveedor'].'" name="prov" readonly="readonly"></td>
    <td><input type="text" value="'.$filas['nom_prov'].'" name="nom_prov" readonly="readonly"></td>
</tr>
<tr><th>Producto</th><th>Categoria</th><th>Precio</th></tr>
<tr>
    <td><input type="text" value="'.$filas['nombre_producto'].'" name="nombre" ></td>  
    <td><input type="text" value="'.$filas['categoria'].'" name="categoria" ></td>   
    <td><input type="text" value="'.$filas['precio'].'" name="precio" ></td>

</form></tr>';
                 }
                 echo "</table>";
                }catch(PDOException $e){
            $e->getMessage();
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
        footer{background-color: greenyellow;margin-top: 397px;height: 30px;
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
            <form method="POST" align="center" action="conf_modificar.php">
                Para modificar el Producto pulse el Boton:<br>
                <?php
                echo '<p align="center">Cambie el contenido en la Tabla inferior</p>';
                Prodmodificar($cod);
                ?>
                <br><input type="submit" value="Actualizar" name="Actualizar">
            </form>
        <article></article>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>