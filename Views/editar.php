<?php include('header.php'); ?>
<div class="container">
	<section class="row">
		<section class="col-md-12">
			<center>
				<h1>Editar Empleado</h1>
			</center>
		</section>
	</section>
	<hr>
	<form method="post" id="formulario" action="?p=guardaredit">
	<section class="row">
		<section class="col-md-4">
			<input type="hidden" name="id" value="<?php echo $traer->id; ?>">
			<input type="text" name="Nom" id="Nom" placeholder="Nombre completo" value="<?php echo $traer->NombreEmp; ?>" class="form-control" required>
		</section>
		<section class="col-md-2">
			<input type="email" name="Ema" id="Ema" placeholder="Email" class="form-control" value="<?php echo $traer->email; ?>" required>
		</section>
		<section class="col-md-2">
				<select name="Are" id="Are" class="form-control" required>
					<option value="<?php echo $traer->area_id; ?>" style="display: none;"><?php echo $traer->areaNom ?></option>
			<?php foreach ($this->model->SelectAreas() as $row): ?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->nombre; ?></option>
			<?php endforeach; ?>
		</select>		
		</section>
		<section class="col-md-4">
			<div style="margin-top: 10px;" class="group-check2">
				<input type="radio" name="Sex" id="Sex1" value="M" <?php if ($traer->sexo=='M'){echo 'checked';} ?> required><label for="Sex1">Masculino</label>
				<input type="radio" name="Sex" id="Sex2" value="F" <?php if ($traer->sexo=='F'){echo 'checked';} ?> required><label for="Sex2">Femenino</label>
			</div>
		</section>
	</section>
	<br>
	<section class="row">
		<section class="col-md-4">
			<label>Descripción:</label>
			<textarea name="Des" id="Des" class="form-control"><?php echo $traer->descripcion; ?></textarea>
		</section>
		<section class="col-md-2">
			<input type="checkbox" name="Bol" id="Bol" value="1" style="margin-top: 30px" <?php if ($traer->boletin==1){echo 'checked';} ?>><label for="Bol">Deseo recibir boletin informativo</label>
		</section>
	</section>
	<br>
	<?php foreach ($this->model->roles() as $row): ?>
			<section class="row">
				<section class="col-md-4">
					<div class="group-check1">
						<input type="checkbox" name="Rol[]" id="Rol<?php echo $row->id; ?>" value="<?php echo $row->id; ?>" <?php if (in_array($row->id, $arreglorol)){echo 'checked';} ?>><label for="Rol<?php echo $row->id; ?>"><?php echo $row->nombre; ?></label>
					</div>
				</section>
			</section>
		<?php endforeach; ?>
		<hr>
		<section class="row">
			<section class="col-md-2">
				<button type="button" onclick="enviar_formulario()" class="btn btn-success" style="width: 100%">Actualizar</button>
			</section>
			<section class="col-md-2">
				<button type="button" onclick="window.location.href='index.php'" class="btn btn-primary" style="width: 100%">Inicio</button>
			</section>
		</section>
	</form>
</div>	
</body>
<?php include('footer.php'); ?> 
<script type="text/javascript">
	document.getElementById('nombre').innerHTML='Editar';
	document.getElementById('inicio').className = "fa fa-edit";
	function enviar_formulario(){
		const rol = !!document.querySelector(".group-check1 input[type=checkbox]:checked");
		const sexo = !!document.querySelector(".group-check2 input[type=radio]:checked");
		if (document.getElementById('Nom').value=='') {
			alert("Nombre no puede ser nulo");
		}else if(document.getElementById('Ema').value==''){
			alert("Email no puede ser nulo");
		}else if(document.getElementById('Are').value==''){
			alert("Area no puede ser nulo");
		}else if(sexo==false) {
			alert("Sexo no puede ser nulo");
		}else if(document.getElementById('Des').value==''){
			alert("Descripción no puede ser nulo");
		}else if (rol==false) {
       	alert ("rol no puede ser nulo");
       }else{
       		document.getElementById('formulario').submit();
       }
}
</script>
</html>