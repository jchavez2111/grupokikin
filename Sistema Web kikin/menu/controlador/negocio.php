<?php
include_once '../../pages/conexion.php';
date_default_timezone_set('UTC');
date_default_timezone_set("America/Bogota");

class Negocio
{
    //PARA 209 Y 210
    function  lisProductos()
    {
        $sql = "SELECT * FROM `inventario` WHERE Categoria=1";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    //PARA 209 Y 210
    function lisEnvases()
    {
        $sql = "SELECT * FROM `inventario` WHERE Categoria=2";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    //PARA 209 Y 210
    function lisPlatos()
    {
        $sql = "SELECT idplato, nombre FROM platos ORDER BY nombre ASC ";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }


    function lisProdRequeridosN()
    {
        $vec = array();
        $sql = "select `idOrdendePedido` from `ordenpedidoproductorequeridos` order by idOrdendePedido desc limit 1";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    //PARA 209
    function disminuirInventario($id, $cant)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update inventario set stock=stock-'$cant' where idProductos='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function actualizarPlato($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update platos set actualizacion=CURDATE() where idPlato='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }
    function actualizarStockPlato($id, $cant)
    {
        $vec = array();
        $fecha = date("Y-n-t");
        $con = new Conexion();
        $sql = "update platos set cantidadPlatos='$cant' where idPlato='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function aumentarProducto($id, $cant)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update producto set stock=stock+'$cant' where idProductos='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

     //PARA 209
    function grabardetalleIngredientes($idplato,$idproductos,$cant)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into detalleplato values($idplato,$idproductos,$cant,CURDATE())";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    //210 ORDEN DE PRODUCTOS REQUERIDOS
    function crearordenprodreq($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into ordenpedidoproductorequeridos values($id,1,CURDATE())";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }


    function grabardetalleordenprodreq($id, $idprod, $cant)
    { //lista especialiadades
        $vec = array();
        $con = new Conexion();
        $sql = "insert into detalleordenprodrequeridos values($id,$idprod,$cant,1)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    //211 RECEPCIONAR PRODUCTOS REQUERIDOS
    function  lisOrdenFiltro($min, $max)
    {
        $sql = "SELECT * FROM `ordenpedidoproductorequeridos`
        WHERE estado=1
        AND fechaCreacion>='$min'
        AND fechaCreacion<='$max'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  lisOrdenPagosFiltro($min, $max)
    {
        $sql = "SELECT idordendepago,nombreproveedor,monto+igv,fechaorden FROM `ordendepagoproductosrequeridos`
        WHERE estado=1
        AND fechaOrden>='$min'
        AND fechaOrden<='$max'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    
    function lisdetordprodreq($id)
    {
        $sql = "SELECT D.idProductos as Producto,P.nombre as Nombre,P.descripcion as Descripcion,D.cantidad as Cantidad
        FROM ordenpedidoproductorequeridos L, detalleordenprodrequeridos D, inventario P
        WHERE L.idOrdendePedidoProdR=D.idOrdenPedidoProdR AND D.idproductos= P.idproductos AND L.idOrdendePedidoProdR='$id'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function grabarRecepcion($id, $idprod, $cant,$fecha)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into detallerecepcionproductosrequeridos values($id,$idprod,$cant,'$fecha')";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function actualizarProducto($id, $cant,$fecha)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update inventario set stock=stock+'$cant' where idProductos='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
        $sql2 = "update inventario set fechadevenc='$fecha' where idProductos='$id'";
        $res = mysqli_query($con->abre(), $sql2) or
            die(mysqli_error($con->abre()));
    }

    function actualizarestadoorden($id,$prod)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update detalleordenprodrequeridos set estadoproducto=2 where idProductos='$prod' and idOrdenPedidoProdR='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function crearordenrecepcion($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into recepcionproductosrequeridos values($id,CURDATE(),1)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function actualizarorden($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update ordenpedidoproductorequeridos set estado=2 where idOrdendePedidoProdr='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }


    function lisProducT()
    {
        $vec = array();
        $sql = "SELECT * FROM `inventario`";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  lisRecepcion()
    {
        $sql = "SELECT * FROM `recepcionproductosrequeridos`
        WHERE estado=1";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  detalleRecepcion($id)
    {
        $sql = "SELECT P.nombre, P.descripcion, D.cantidad, D.fechaVen FROM detallerecepcionproductosrequeridos D,inventario P,recepcionproductosrequeridos R WHERE D.idProductos=P.idproductos AND D.Idrecepcion=R.Idrecepcion AND D.idrecepcion=$id";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  lisOrdenPagoFiltro($min, $max)
    {
        $sql = "SELECT idOrdendePago,nombreProveedor,monto+igv,FechaOrden
        FROM `ordendepagoproductosrequeridos`
        WHERE estado=1
        AND fechaOrden>='$min'
        AND fechaOrden<='$max';";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  detalleComprobante($id)
    {
        $sql = "SELECT o.idordendepago,fechaorden,monto, igv ,monto+igv,documentoSalida
        FROM ordendepagoproductosrequeridos O
        WHERE idOrdendePago='$id';";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }


    function actualizarOrdenPago($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update ordendepagoproductosrequeridos set estado='2' where idOrdendePago='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    
    function insertarComprobante($idc,$id,$idr,$monto)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into comprobantedepagodeproductosrequeridos values($idc,$id,$idr,$monto,CURDATE())";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function  lisMesa()
    {
        $sql = "SELECT idMesa,Descripcion from mesa where estado=1 and idmesa>0";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  liscadaPlato()
    {
        $sql = "SELECT idPlato,nombre,descripcion,precioU,cantidadPlatos from platos order by nombre asc;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }
    function  detallecadaPlato($id)
    {
        $sql = "SELECT idplato,nombre,precioU,cantidadPlatos from platos where idplato='$id'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function actualizarMesa($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update mesa set estado=0 where idmesa='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function crearnuevopedido($id,$mesa)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into pedido values($id,100,$mesa,1,'EN LOCAL',CURDATE(),NOW(),1)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function disminuirCantPlatos($id, $cant)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update platos set cantidadplatos=cantidadplatos-'$cant' where idPlato='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function grabardetallepedido($id,$idplato,$cantidad,$precio)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into detallepedido values($id,$idplato,$cantidad,$precio)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function  listapedidospendientes()
    {
        $sql = "SELECT idpedido,tipoentrega,IF(idMesa=0,'DELIVERY',CONCAT('MESA',' ',idmesa)),HoraPedido FROM pedido WHERE estado=1;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  listadetallepedidospendientes($id)
    {
        $sql = "SELECT nombre,cantidad,monto FROM Pedido P, detallepedido D, platos C WHERE P.idPedido=D.idPedido AND D.idPlato=C.idPlato AND D.idPedido='$id'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  listaayudantescocina()
    {
        $sql = "SELECT A.idayudantedecocina as 'Empleado', count(C.idpedido) as 'Departamento', CONCAT(A.nombre,' ',A.apellido) 
        FROM ayudantedecocina A 
        LEFT JOIN colapreparacion C ON A.idayudantedecocina=C.idayudantedecocina AND C.estadoPreparacion=1
        GROUP BY A.idAyudantedeCocina;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function actualizarpedpreparacion($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update pedido set estado=2 where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function asignarpedidoayudante($pedido,$ayudante)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into colapreparacion values($pedido,$ayudante,1)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function  listapedidospreparacion()
    {
        $sql = "SELECT P.idpedido,P.tipoentrega,CONCAT('MESA',' ',IF(P.idmesa=0,'APP',P.idmesa)),concat(a.nombre,' ',a.apellido),P.HoraPedido FROM pedido P,colapreparacion C,ayudantedecocina A WHERE p.idpedido=c.idpedido AND C.idayudantedecocina=A.idayudantedecocina AND P.estado=2;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function  listamozos()
    {
        $sql = "SELECT
        P.DNI, COUNT(M.DNI),CONCAT(P.nombrepersona,' ',P.apellidopaterno,' ',P.apellidomaterno)
      FROM persona p
      LEFT JOIN colaborador c ON c.dni=p.dni
      LEFT JOIN rol r ON r.idrol =c.idrol
      LEFT JOIN colamozo M ON M.dni=p.dni AND M.estado=1
      WHERE r.idRol=106
      GROUP BY p.DNI;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function actualizarpedterminado($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update pedido set estado=3 where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
        $sql2 = "update colapreparacion set estadoPreparacion=2 where idpedido='$id'";
            $res = mysqli_query($con->abre(), $sql2) or
                die(mysqli_error($con->abre()));
    }

    function asignarpedidomozo($pedido,$mozo)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into colamozo values($pedido,$mozo,1)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function pedidoter() {
        $sql = "SELECT p.idPedido,if(p.tipoEntrega = 1,'Local','Delivery') as tipoEntrega,p.direccion ,p.horapedido,a.nombre,a.apellido
       FROM pedido p,ayudantedecocina a,colaPreparacion c
       WHERE p.idPedido =c.idPedido 
        AND a.idAyudantedeCocina=c.idAyudantedeCocina
        and P.estado=3";

        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function detped($id) {
        $sql = "SELECT nombre,cantidad,monto 
                FROM Pedido P, detallepedido D, platos C 
                WHERE P.idPedido=D.idPedido 
                AND D.idPlato=C.idPlato AND D.idPedido='$id'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function imprimirprecio($id) {
        $sql = "SELECT sum(dp.cantidad*pla.PrecioU), p.idcomensal as total
                FROM platos pla,detallePedido dp, pedido p
                WHERE p.idPedido=dp.idPedido 
                AND dp.idPlato=pla.idPlato
                AND p.idPedido='$id'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function actualizarPedidoPagadoMozo($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update pedido set estado=4 where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
        $sql2 = "update colamozo set estado=2 where idpedido='$id'";
            $res = mysqli_query($con->abre(), $sql2) or
                die(mysqli_error($con->abre()));
    }

    function insertarComprobantePedido($comp,$ped,$com,$sub,$igv,$total)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into comprobantedepago values($comp,$ped,$com,CURDATE(),'1',$sub,$igv,$total)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function  listapedidospagados()
    {
        $sql = "SELECT P.idpedido,P.direccion,P.HoraPedido FROM pedido p where P.estado=4 and P.tipoentrega=2;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    

    function  listarepartidores()
    {
        $sql = "SELECT
        r.idRepartidor, COUNT(c.idRepartidor),CONCAT(P.nombrepersona,' ',P.apellidopaterno,' ',P.apellidomaterno)
       FROM repartidor r
       LEFT JOIN persona p ON p.DNI=r.DNI
       LEFT JOIN colaenvio c ON c.idRepartidor=r.idRepartidor AND c.estadoEnvio=1
       GROUP BY R.idrepartidor;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function actualizarpedporentregar($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update pedido set estado=5 where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function asignarpedidorepartidor($pedido,$repartidor)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into colaenvio values($pedido,$repartidor,NULL,1)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    
    function finalizarpedido($id,$comentario,$estado)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update pedido set estado=$estado where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
        $sql2 = "update colaenvio set estadoEnvio=2 where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql2) or
                die(mysqli_error($con->abre()));
        $sql3 = "update colaenvio set comentarioreparto='$comentario' where idpedido='$id'";
        $res = mysqli_query($con->abre(), $sql3) or
                        die(mysqli_error($con->abre()));
    }

    function  listapedidosfinalizar($id)
    {
        $sql = "SELECT P.idPedido,P.direccion,C.celular,pag.Total FROM pedido P,comensal C, comprobantedepago pag, colaenvio E WHERE P.idcomensal=C.idcomensal AND pag.idPedido=P.idpedido AND E.idPedido=P.idPedido AND E.estadoenvio=1 AND E.idrepartidor='$id'";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function actualizarvueltamesa($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update mesa set estado=1 where idmesa='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function  pedidosparareclamo()
    {
        $sql = "SELECT P.idPedido,P.HoraPedido,Concat('Mesa',' ',P.idMesa) AS Mesa,CONCAT(S.nombrepersona,' ',S.apellidopaterno, ' ', S.apellidomaterno) AS Mozo,CONCAT(C.nombre,' ',c.apellido) AS Ayudante, TRUNCATE(SUM(D.monto)*1.18,2) as Monto
        FROM Pedido P,detallePedido D, colamozo M, colapreparacion A, ayudantedecocina C, persona S
        WHERE P.idPedido not in(Select idpedido from reclamo)
        AND P.idpedido=D.idpedido
                AND P.tipoentrega=1
                AND P.estado=4
                AND P.idPedido=M.idPedido
                AND P.idPedido=A.idPedido
                AND A.idAyudantedeCocina=C.idAyudantedeCocina
                AND M.DNI=S.DNI
                GROUP BY D.Idpedido;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function insertarreclamo($rec,$ped,$com,$tipo)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into reclamo values($rec,$ped,'$com',CURDATE(),$tipo,'1')";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function listareclamos()
    {
        $sql = "SELECT idReclamo,CONCAT('P000',idPedido) as Pedido, tipoReclamo,fechaReclamo
        FROM reclamo
        WHERE estado=1;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function detallereclamo($id)
    {
        $sql = "SELECT detallereclamo FROM reclamo
        WHERE idReclamo=$id;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function evaluarreclamo($rec,$ped,$com,$tipo)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into evaluacionreclamo values($rec,$ped,'$com',$tipo)";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function actualizarreclamo($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update reclamo set estado=2 where idreclamo='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function reclamosaprobado()
    {
        $sql = "SELECT R.idreclamo, R.idpedido, R.tiporeclamo,E.estado,R.fechareclamo
        FROM Reclamo R, evaluacionreclamo E
        WHERE R.idreclamo=E.idreclamo 
        AND E.estado=1
        AND R.Estado=2;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function detallereclamonota($id)
    {
        $sql = "SELECT SUM(D.Monto),R.fechareclamo,E.detalle
        FROM reclamo R,evaluacionreclamo E,pedido P, detallepedido D
        WHERE P.idpedido=D.idPedido
        AND P.idpedido=R.idpedido
        AND R.idreclamo=E.idreclamo
        and E.estado=1
        AND R.idreclamo=$id
        group by D.idPedido;";
        $con = new Conexion();
        $res = mysqli_query($con->abre(), $sql) or die(mysqli_error($con->abre()));
        $vec = array();
        while ($f = mysqli_fetch_array($res)) {
            $vec[] = $f;
        }
        $con->cierra();
        return $vec;
    }

    function insertarNota($nc,$reclamo,$monto,$fecha)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "insert into notacredito values($nc,$reclamo,$monto,CURDATE(),'$fecha')";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }

    function actualizarreclamo2($id)
    {
        $vec = array();
        $con = new Conexion();
        $sql = "update reclamo set estado=3 where idreclamo='$id'";
        $res = mysqli_query($con->abre(), $sql) or
            die(mysqli_error($con->abre()));
    }


}
