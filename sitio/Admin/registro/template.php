<?php 
	include "main.php";
 ?>
<style>
	.card{
		margin : 10px;
		height: 250px;
		width: auto;
		padding: 10px;
		text-decoration: none;
		background: #28a745;
		color: white;
		cursor: pointer;
        transition: 1s;
        border: 2px solid #28a745;
	}

	.card:hover{
        transition: 1s;
        color: #28a745;
		background: white;
	}

	.icon{
		padding-top: 25px;
		height: 200px;
		font-size: 140px;
	}

</style>
	<div class="container">
        <br>
	    <h1 class="text-center">Presupuesto</h1>
        <br>
		
	</div>


</body>

<?php 
	include "end.php";
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.card').click(function(e) {
			let ruta = $(this).attr('data');
			if (ruta != undefined) {
				location.replace(ruta);				
			}
		});
	});
</script>

</html>
