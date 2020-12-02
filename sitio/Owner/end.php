<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/popper.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert.min.js"></script>
<script>

//Tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


//Logout
function logout(){
swal({
	title: "Advertencia",
	text: "¿Seguro de querer cerrar sesión?",
	icon: "warning",
	buttons: true,
}).then((res)=>{
	if(res){
		$.ajax({
			url: '../../php/log/logout.php',
			type: 'POST'
		})
		.done(function(data) {
			if(data == 1){
				location.replace('../../index.php');
			}
		});
	}
});
}

</script>
<?php 
	if (isset($conection)) {
		mysqli_close($conection);		
	}
 ?>