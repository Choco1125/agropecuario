<?php 

	session_start();
	if (!isset($_SESSION)){
    	header('location: ../../index.php');
  	}
	session_write_close();
	include "../".$_SESSION['carpeta']."/main.php";

	//consultamos la información del usuario
	include "../../php/conection.php";
	$query  ="SELECT * FROM usuarios WHERE id = ".$_SESSION['id'];
	$sql = mysqli_query($conection,$query);
	if(!$sql){
		header('location: ../../index.php');
	}
	$datos = mysqli_fetch_array($sql);
?>
	<div class="container">
		<br><br>
		<form id="data">
			<div class="form-group">
				<label for="identificacion"> Identificación </label>
				<input name="identificacion" value="<?php echo $datos['identificacion'] ?>" type="number" class="form-control" id="identificacion" placeholder="Identificación">
			</div>
			<div class="form-group">
				<label for="nombre_usuario"> Nombre de usuario </label>
				<input name="nombre_usuario" value="<?php echo $datos['nombre_usuario'] ?>" type="text" class="form-control" id="nombre_usuario" placeholder="Ingrese nombre de usuario">
			</div>
			 <div class="form-group">
				<label for="nombre"> Nombre </label>
				<input name="nombre" value="<?php echo $datos['nombre'] ?>" type="text" class="form-control" id="nombre" placeholder="Ingrese nombre" >
			</div>
			<div class="form-group">
				<label for="apellido"> Apellido </label>
				<input name="apellido" value="<?php echo $datos['apellido'] ?>" type="text" class="form-control" id="apellido" placeholder="Ingrese apellido" >
			</div>
			<div class="alert alert-primary" role="alert">
				Recuerde que para poder cambiar la contraseña debe ingresar su contraseña actual
			</div>
			<div class="form-group">
				<label for="now_pass"> Constraseña Actual </label>
				<input name="now_pass" type="password" class="form-control" id="now_pass" placeholder="Contraseña Actual" >
			</div>
			<div class="form-group">
				<label for="new_pass"> Nueva contraseña </label>
				<input name="new_pass" type="password" class="form-control" id="new_pass" placeholder="Nueva Contraseña" >
			</div>			
		</form>
		<div class="form-group text-center">
			<button onclick="guardar();" class="btn btn-success"> Guardar Cambios </button>
		</div>	
	</div>


	</body>
<?php
	include "../".$_SESSION['carpeta']."/end.php";
?>
	<script>
		//verificar la info
		function verificar(){
			var identificacion = $('#identificacion');
			var nombre_usuario = $('#nombre_usuario');
			var nombre = $('#nombre');
			var apellido = $('#apellido');
			var now_pass = $('#now_pass');
			var new_pass = $('#new_pass');

			if(identificacion.val() == ""){
				swal({
					title: "Error!",
					text: "Este Campo es obligatorio",
					icon: "error",
					button: true,
				}).then((res)=>{
					if(res){
						identificacion.focus();
					}
				});
				return false;
			}

			if(nombre_usuario.val() == ""){
				swal({
					title: "Error!",
					text: "Este Campo es obligatorio",
					icon: "error",
					button: true,
				}).then((res)=>{
					if(res){
						nombre_usuario.focus();
					}
				});
				return false;
			}

			if(nombre.val() == ""){
				swal({
					title: "Error!",
					text: "Este Campo es obligatorio",
					icon: "error",
					button: true,
				}).then((res)=>{
					if(res){
						nombre.focus();
					}
				});
				return false;
			}
			if(apellido.val() == ""){
				swal({
					title: "Error!",
					text: "Este Campo es obligatorio",
					icon: "error",
					button: true,
				}).then((res)=>{
					if(res){
						apellido.focus();
					}
				});
				return false;
			}

			if(new_pass.val() != "" || now_pass.val() != ""){
				if (now_pass.val() == "") {
					swal({
						title: "Error!",
						text: "Cuando ingresas una nueva contraseña debes de ingresar la actual",
						icon: "error",
						button: true,
					}).then((res)=>{
						if(res){
							now_pass.focus();
						}
					});
					return false;
				}
				if(new_pass.val().length < 8){
					swal({
						title: "Error!",
						text: "Se recomiendo usar contraseñas con más de 8 caracteres por cuestiones de seguridad",
						icon: "error",
						button: true,
					}).then((res)=>{
						if(res){
							new_pass.focus();
						}
					});
					return false;
				}
			}

			return true;
		}

		//modificar info de usuario
		function guardar(){
			if(verificar()){
				$.ajax({
					url: '../../php/common.php',
					type: 'POST',
					data: $('#data').serialize()
				})
				.done(function(data) {
					if (data == "1") {
						swal({
							title: "Buen trabajo!",
							text: "Los datos se Editaron correctamente",
							icon: "success",
							button: true,
						}).then((res)=>{
							if(res){
								location.reload();
							}
						});
					}else{
						swal({
							title: "Error!",
							text: data,
							icon: "error",
							button: true,
						}).then((res)=>{
							if(res){
								location.reload();
							}
						});
					}
				});
				
			}
		}

	</script>

</html>