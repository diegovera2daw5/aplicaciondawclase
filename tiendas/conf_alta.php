<?php
session_start();
?>
<html>
    <head><meta charset="utf-8">
        <style type="text/css">
            body{width:800px;height:768px;}
            h3,footer{text-align:center}
            header{background-color:gainsboro;}
        header ul{width:600px;height:50px;background-color: greenyellow;
            margin-left: 80px;margin-top: 20px}
        header ul li{float:left; width:100px;height:20px;margin-left:20px;
                     list-style-type: none}   
        section{clear: both}
        section table{margin-top:20px}
        footer{background-color: greenyellow;margin-top: 592px;height: 30px;
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
            <li><a href="Baja_producto.php">Baja</a></li>
            <li><a href="Modificacion.php">Modificacion</a></li>
            <li><a href="menu2.php">Ir al inicio</a></li>
        </ul>
        </header>
        <section align="center">
<?php
function nombreproveedor($prov){
$con2=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
$con2->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
$stmt2=$con2->prepare('select * from productos where proveedor=:prov');
                $stmt2->execute(array(':prov'=>$prov));
                $np=$stmt2->fetch(PDO::FETCH_ASSOC);
                $nombreprov=$np['nom_prov'];
                return $nombreprov;
}

if(isset($_POST['Aceptar'])){
                $cod= isset($_POST['codigo'])? $_POST['codigo']:"";
                $nom= isset($_POST['nombre'])? $_POST['nombre']:"";
                $cat= isset($_POST['categoria'])? $_POST['categoria']:"";
                $precio= isset($_POST['precio'])? $_POST['precio']:"";
                $prov= isset($_POST['prov'])? $_POST['prov']:"";
                $nom_prov= isset($_POST['nom_prov'])? $_POST['nom_prov']:"";
                $tipo= isset($_POST['tipo'])? $_POST['tipo']:"";
               
                
                
            try{
            $con=new PDO('mysql:dbname=tiendas;host=localhost;charset=utf8','tiendas','tiendas');
            $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE);
            $datos=array($cod,$nom,$cat,$precio,$prov,$nom_prov);
            if($tipo==2){
                $stmt2=$con->prepare('insert into productos
                (cod_producto,nombre_producto,categoria,precio,proveedor,nom_prov) 
                values(?,?,?,?,?,?)');
                $stmt2->execute($datos);

                 if($stmt2->rowCount()==1){
                     echo "Se ha insertado correctamente con el nuevo proveedor";
                 }else{
                     echo "no insertado";
                 }

            }else{
              $nomprov=nombreproveedor($prov);          
             
             $datos=array($cod,$nom,$cat,$precio,$prov,$nomprov);
            $stmt3=$con->prepare('insert into productos
             (cod_producto,nombre_producto,categoria,precio,proveedor,nom_prov) 
             values(?,?,?,?,?,?)');
                $confirmacion=$stmt3->execute($datos);

                 if($confirmacion==true){
                     echo "Se ha insertado correctamente con el proveedor existente";
                 }else{
                     echo "no insertado 2<br>";
                    
                 }

            }

            }catch (PDOException $ex){
            $ex->getMessage();
            } 
        }
?>
            <br>
            <a href="menu2.php">Volver al Inicio</a>
        </section>
        <footer>Diego Vera 2º Desarrollo aplicaciones WEB</footer>
    </body>
</html>



