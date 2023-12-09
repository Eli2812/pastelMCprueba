<?php include("../template/cabecera.php") ?>
<?php
print_r($_POST);
?>


<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Datos del pastel
        </div>

        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtID">ID:</label>
    <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
    </div>


    <div class = "form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" class="form-control" name="txtName" id="txtNombre" placeholder="Nombre">
    </div>


    <div class = "form-group">
    <label for="txtDescripcion">Descripcion:</label>
    <input type="text" class="form-control" name="txtDescripcion" id="txtDescripcion" placeholder="Descripcion">
    </div>


    <div class = "form-group">
    <label for="txtImagen">Imagen:</label>
    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
    </div>

            <div class="btn-group" role="group" aria-label="">
                <button type="button" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="button" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="button" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
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
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2</td>
                <td>Hola</td>
                <td>Aprende de pasteles</td>
                <td>imagen.jpg</td>
                <td>Seleccionar | Borrar</td>
            </tr>
        </tbody>
    </table>

</div>


<?php include("../template/pie.php") ?>