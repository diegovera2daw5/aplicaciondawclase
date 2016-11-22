<?php
session_start();

$limite = 10;
$pagina = isset($_GET['pagina'])?$_GET['pagina']:0;
$inicio = $pagina * $limite;
function sabertotal(){
    try {
    
    $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $con->prepare('select * from productos');
    $stmt->execute();
    $total=$stmt->rowCount();
         
 }catch(PDOException $e){
     $e->getMessage();
 }
    return $total;
}

function Mostrarproductos() {
 
 
 try {

    $conn=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('select * from productos');
    $stmt->execute();
    
         echo '<table border align="center">';
         echo '<tr><th>Codigo</th><th>Producto</th><th>Codigo del Proveedor</th><th>Proveedor</th><th>Categoria</th><th>Precio</th></tr>';
         while($filas=$stmt->fetch(PDO::FETCH_ASSOC)){
             echo "<tr><td>".$filas['cod_producto']."</td><td>".$filas['nombre_producto'].
                  "</td><td>".$filas['proveedor']."</td><td>".$filas['nom_prov'].
                  "</td><td>".$filas['categoria']."</td><td>".$filas['precio']."</tr>";
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
        footer{background-color: greenyellow;margin-top: 270px;height: 30px;
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
            <p align="center">Nuestros Productos:</p>
              <?php Mostrarproductos()?>
            <article><a href="Consultar.php">Volver</a></article>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>
