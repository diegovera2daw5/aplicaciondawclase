<?php
session_start();
function Modificar(){
    if(isset($_POST['Actualizar'])){
                $cod= isset($_POST['codigo'])? $_POST['codigo']:"";
                $nom= isset($_POST['nombre'])? $_POST['nombre']:"";
                $cat= isset($_POST['categoria'])? $_POST['categoria']:"";
                $precio= isset($_POST['precio'])? $_POST['precio']:"";
                
        try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $stmt3=$con->prepare('Update productos set
                                    nombre_producto=:nom,
                                    categoria=:cat,
                                    precio=:precio
                                    where cod_producto=:cod ');
            $stmt3->execute(array(':cod'=>$cod,':nom'=>$nom,':cat'=>$cat,
                ':precio'=>$precio));

            if($stmt3==true){
                echo '<p align="center">Modificacion Correcta del Producto</p>';
            }
        }catch (PDOException $ex){
            $ex->getMessage();
        }   
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
        footer{background-color: greenyellow;margin-top: 560px;height: 30px;
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
            <article><?php  Modificar();?><br><a href="menu2.php" align="center">Volver al Inicio</a></article>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>