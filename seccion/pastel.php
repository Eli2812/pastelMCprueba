<?php include("../template/cabecera.php") ?>


<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtpreparadoPor=(isset($_POST['txtpreparadoPor']))?$_POST['txtpreparadoPor']:"";
$txtFechaIngreso=(isset($_POST['txtFechaIngreso']))?$_POST['txtFechaIngreso']:"";
// (isset($_FILES['$txtFechaIngreso']['name']))?$_FILES['$txtFechaIngreso']['name']:"";
$txtFechaVencimiento=(isset($_POST['txtFechaVencimiento']))?$_POST['txtFechaVencimiento']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/db.php");
switch ($accion) {
    // INSERT INTO ingredientes (nombre, descripcion, fechaIngreso, fechaVencimiento) VALUES('null','Azucar Glass ', 'Azucar glass blanca', '2023-01-01 12:00:00', '2023-12-31 23:59:59'),
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO pastel (nombre, descripcion, preparadoPor, fechaIngreso, fechaVencimiento) VALUES(:nombre, :descripcion, :preparadoPor,  :fechaIngreso, :fechaVencimiento);"); 
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
        $sentenciaSQL->bindParam(':preparadoPor',$txtpreparadoPor);
        $sentenciaSQL->bindParam(':fechaIngreso',$txtFechaIngreso);
        $sentenciaSQL->bindParam(':fechaVencimiento',$txtFechaVencimiento);
        $sentenciaSQL->execute();
        
        // echo "precionado boton agregar";
        break;

    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE pastel SET nombre=:nombre, descripcion=:descripcion, preparadoPor=:preparadoPor, fechaIngreso=:fechaIngreso, fechaVencimiento=:fechaVencimiento WHERE idPastel=:idPastel");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':preparadoPor', $txtpreparadoPor);
        $sentenciaSQL->bindParam(':fechaIngreso', $txtFechaIngreso);
        $sentenciaSQL->bindParam(':fechaVencimiento', $txtFechaVencimiento); // Corregido el nombre del parámetro
        $sentenciaSQL->bindParam(':idPastel', $txtID);
        
        $sentenciaSQL->execute();
            // echo "presionado botón Modificar";
        break;
        

    case "Cancelar":


        header("Location:pastel.php");
        break;


    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM pastel WHERE idPastel=:idPastel");
        $sentenciaSQL->bindParam(':idPastel',$txtID);
        $sentenciaSQL->execute();
        $listaPatel=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$listaPatel['nombre'];
        $txtDescripcion=$listaPatel['descripcion'];
        $txtpreparadoPor=$listaPatel['preparadoPor'];

        $txtFechaIngreso=$listaPatel['fechaIngreso'];
        $txtFechaVencimiento=$listaPatel['fechaVencimiento'];



        // echo "precionado boton Seleccionar";
        break;
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("DELETE FROM pastel WHERE idPastel=:idPastel");
        $sentenciaSQL->bindParam(':idPastel',$txtID);
        $sentenciaSQL->execute();

        break;
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM pastel");
$sentenciaSQL->execute();
$listapasteles=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Pastel
        </div>

        <div class="card-body">

        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtID">ID:</label>
    <input type="text" required readonly class="form-control"  value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
    </div>


    <div class = "form-group">
    <label for="txtNombre">Nombre del Pastel:</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
    </div>


    <div class = "form-group">
    <label for="txtDescripcion">Descripcion:</label>
    <input type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion">
    </div>

    <div class = "form-group">
    <label for="txtpreparadoPor">Preparado Por:</label>
    <input type="text" required class="form-control" value="<?php echo $txtpreparadoPor; ?>" name="txtpreparadoPor" id="txtpreparadoPor" placeholder="Persona que lo preparó">
    </div>

    <div class = "form-group">
    <label for="txtFechaIngreso">Fecha ingreso:</label>
    <input type="text" required class="form-control" value="<?php echo $txtFechaIngreso; ?>" name="txtFechaIngreso" id="txtFechaIngreso" placeholder="01-01-2023">
    </div>

    <div class = "form-group">
    <label for="txtFechaVencimiento">Fecha Vencimiento:</label>
    <input type="text" required class="form-control" value="<?php echo $txtFechaVencimiento; ?>" name="txtFechaVencimiento" id="txtFechaVencimiento" placeholder="10-01-2023">
    </div>



        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
             <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>

    </form>
        </div>
    </div>


</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Preparado por</th>
                <th>Fecha Ingreso</th>
                <th>Fecha vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php foreach($listapasteles as $pastel){?>
        <tbody>
            <tr>
                <td> <?php echo $pastel['idPastel'] ?></td>
                <td><?php echo $pastel['nombre'] ?></td>
                <td><?php echo $pastel['descripcion'] ?></td>
                <td><?php echo $pastel['preparadoPor'] ?></td>
                <td><?php echo $pastel['fechaIngreso'] ?></td>
                <td><?php echo $pastel['fechaVencimiento'] ?></td>
                <td>

                <form method="post">
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $pastel['idPastel'] ?>">

                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                    
                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>



                </form>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>

</div>


<?php include("../template/pie.php") ?>