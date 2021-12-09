<?php
include('../../pages/conexion.php');

if (isset($_POST['enviarform'])) {
    if (
        strlen($_POST['proveedor']) >= 1 &&
        strlen($_POST['monto']) >= 1 &&
        strlen($_POST['igv']) >= 1)
        {
        $doc=$_POST['docrecepcion'];
        $proveedor=$_POST['proveedor'];
        $monto=$_POST['monto'];
        $igv=$_POST['igv'];
        $numpago=$_GET["numpago"];
        $boleta = $_FILES["boleta"]["name"];
        $ruta = $_FILES["boleta"]["tmp_name"];
        $destino = "../boleta/" . $boleta;
        copy($ruta, $destino);

        $consulta = "INSERT INTO ordendepagoproductosrequeridos VALUES ('$numpago','$doc','$proveedor','$monto','$igv',CURDATE(),'$destino',1)";
        $resultado = mysqli_query($conex, $consulta);

        $consulta2 = "update recepcionproductosrequeridos set estado=2 where idrecepcion='$doc'";
        $resultado2 = mysqli_query($conex, $consulta2);

        if ($resultado) {
            header('Location:../paginas/212.php');
        } else {
        ?>
            <h3> <? echo ($numpago+$proveedor+$monto+$igv);?>Ups Error</h3>
        <?php
        }
    } else {
        ?>
        <h3><? echo ($numpago+$proveedor+$monto+$igv);?> COmplete Campos</h3>
<?php
    }
}
?>