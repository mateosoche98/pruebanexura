<?php include('header.php'); ?>
<div class="container">
	<section class="row">
		<section class="col-md-12">
			<center>
				<h1>Listado De Empleados</h1>
			</center>
		</section>
	</section>
	<hr>
	<section class="row">
		<section class="col-md-12">
			<table id="example" class="table table-bordered table-striped">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Sexo</th>
					<th>Area</th>
					<th>Rol</th>
					<th>Boletin</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					<?php foreach ($this->model->listar() as $row): ?>
						<tr>
							<td><?php echo $row->id; ?></td>
							<td><?php echo $row->NombreEmp; ?></td>
							<td><?php echo $row->email; ?></td>
							<td><?php 
									switch ($row->sexo) {
										case 'M':
											echo 'Masculino';
										break;
										case 'F':
											echo 'Femenino';
										break;
										}
								?>
							</td>
							<td><?php echo $row->areaNom; ?></td>
							<td><?php echo $row->Nomrol; ?></td>
							<td><?php 
									switch ($row->boletin) {
										case 0:
											echo 'No';
										break;
										case 1:
											echo 'Si';
										break;
										}
								?>
							<td><a href="?p=viewedit&id=<?php echo $row->id; ?>" class="btn btn-warning"><span class="fa fa-edit"></span></a></td>
							<td><a href="?p=eliminar&id=<?php echo $row->id; ?>" class="btn btn-danger" onclick="return confirm('¿Seguro de eliminar este registro?');"><span class="fa fa-trash"></span></a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	</section>
	<section class="row">
		<section class="col-md-2">
			<button onclick="window.location.href='?p=nuevo'" class="btn btn-primary">Nuevo</button>
		</section>
	</section>
</div>
</body>
<?php include('footer.php'); ?>
<style type="text/css">
	div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
<script type="text/javascript">
	document.getElementById('nombre').innerHTML='Inicio';
	document.getElementById('inicio').className = "fa fa-home";
	$(document).ready(function() {
    $('#example').DataTable( {
        "scrollY": 450,
        "scrollX": true
    } );
} );
</script>
</html>