<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//generar informe
		if ($tipo == 'informe') {
			$cultivo = $_POST['cultivo'];
			$inicio = $_POST['inicio'];
			$fin = $_POST['fin'];
			$finca_id = $_SESSION['finca'];

			//consultamos en la base de datos
			include '../conection.php';
			$query = "SELECT id,nombre FROM labores";
			$sql_labores = mysqli_query($conection,$query);
			$data = array();
			if ($sql_labores) {
				while ($labores = mysqli_fetch_array($sql_labores)) {

					//ejecutadas
					$query = "SELECT * FROM registro_labor WHERE labor_id=".$labores['id']." AND (fecha) BETWEEN '$inicio' AND '$fin'";
					$sql = mysqli_query($conection,$query);
					if ($sql) {
						$num = mysqli_num_rows($sql);
						if ($num > 0) {
							//ejecutadas
							//valor
							$e_valor_dia = 0;
							$e_valor_contrato = 0;
							// $e_insumos = 0;
							//número de empleados
							// $e_dia = 0;
							// $e_contrato = 0;

							//presupuestadas
							//valor
							$p_valor_dia = 0;
							$p_valor_contrato = 0;
							// $p_insumos = 0;
							//número de empleados
							// $p_dia = 0;
							// $p_contrato = 0;

							//sumar los valores
							while ($row = mysqli_fetch_array($sql)) {
								//ejecutadas
								if ($row['labor'] == '1') {
									if ($row['tipo'] == '0') {//al dia

										//valor al dia
										$query = "SELECT SUM(valor) AS 'valor' FROM labor_empleado WHERE registro_id=".$row['id'];
										$val = mysqli_query($conection,$query);
										if ($val) {
											$e_valor_dia += mysqli_fetch_array($val)['valor'];
										}

										//numero de empleados
										// $query = "SELECT COUNT(id) AS 'num' FROM labor_empleado WHERE registro_id=".$row['id'];
										// $num = mysqli_query($conection,$query);
										// if ($num) {
										// 	$e_dia += mysqli_fetch_array($num)['num'];		
										// }
									}
									if ($row['tipo'] == '1') {//al contrato
										$e_valor_contrato += $row['valor'];

										//nuemro de empleados
										// $query = "SELECT * FROM labor_empleado WHERE registro_id=".$row['id'];
										// $empl = mysqli_query($conection,$query);
										// if ($empl) {
										// 	$e_contrato += mysqli_num_rows($empl);			
										// }
									}
									
									//insumos
									// $query = "SELECT SUM(valor*cantidad) AS 'valor' FROM bodega_labor WHERE registro_id=".$row['id'];
									// $insumos = mysqli_query($conection,$query);
									// if ($insumos) {
									// 	$aux_1 = mysqli_fetch_array($insumos);
									// 	if($aux_1['valor'] > 0){
									// 		$e_insumos += $aux_1['valor'];
									// 	}
									// }
								}

								//presupuestadas
								if ($row['labor'] == '0') {
									if ($row['tipo'] == '0') {//al dia
										$p_valor_dia += $row['valor'];
										// $p_dia += $row['estado'];
									}
									if ($row['tipo'] == '1') {//al contrato
										$p_valor_contrato += $row['valor'];
										// $p_contrato += $row['estado'];
									}

									//insumos
									// $query = "SELECT SUM(valor*cantidad) AS 'valor' FROM bodega_labor WHERE registro_id=".$row['id'];
									// $insumos = mysqli_query($conection,$query);
									// if ($insumos) {
									// 	$aux_1 = mysqli_fetch_array($insumos);
									// 	if($aux_1['valor'] > 0){
									// 		$p_insumos += $aux_1['valor'];
									// 	}
									// }
								}

							}
							
							if ($data == NULL) {
								$data = array();
							}

							$data[] = array(
									'nombre' => $labores['nombre'],
									'e_valor_dia' => $e_valor_dia,
									'e_valor_contrato' => $e_valor_contrato,
									// 'e_insumos' => $e_insumos,
									// 'e_dia' => $e_dia,
									// 'e_contrato' => $e_contrato,
									'p_valor_dia' => $p_valor_dia,
									'p_valor_contrato' => $p_valor_contrato,
									// 'p_insumos' => $p_insumos,
									// 'p_dia' => $p_dia,
									// 'p_contrato' => $p_contrato,
								);
						}
					}
				}
			}
			echo json_encode($data);

		}

	}

 ?>