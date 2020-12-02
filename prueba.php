<?php ob_start();
	// include autoloader
	require_once 'vendor/autoload.php';

	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	session_start();
	$_SESSION['data'] = "hola bebé";
?>
<html>
	<style>
		h3{
			text-align: center;
			color: green;
		}
	</style>
	<body>
		<h3><?php echo $_SESSION['data'];  ?></h3>
		<table></table>
	</body>
</html>

<?php

	// $fileContent = file_get_contents( './html.php' ) ;
	// echo $fileContent;
	// return;

	// instantiate and use the dompdf class
	$dompdf = new DOMPDF(['isHtml5ParserEnabled' => true]);
	$dompdf->load_html(ob_get_clean());

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	$pdf = $dompdf->output();

	// Output the generated PDF to Browser
	// $dompdf->stream();
	$dompdf->stream("sample.pdf", array("Attachment"=>0));
?>