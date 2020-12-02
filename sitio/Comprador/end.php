<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/sweetalert.min.js"></script>
<script>
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
<script src="../../js/datatables.min.js"> </script>
<script>
</script>
<?php 
  if (isset($conection)) {
    mysqli_close($conection);   
  }
 ?>