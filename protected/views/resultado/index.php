<?php
	/** @var EmpresaController $this */
	/** @var Empresa $model */
	$this->breadcrumbs = array(
		'Resultados',
	);
	$db_connection = mysqli_connect("localhost" , "root" , "root", "pegada_energetica"  );

?>

<script type="text/javascript">

function func(selectedValue){
    //make the ajax call
    $.ajax({
        url: 'ajax/function.php',
        type: 'POST',
        data: {option : selectedValue},
        success: function() {
            console.log("Data sent!");
        }
    });
	window.location.replace("http://localhost/footprint/index.php?r=resultado/index");
}

function func2(selectedValue){
    //make the ajax call
    $.ajax({
        url: 'ajax/function.php',
        type: 'POST',
        data: {option2 : selectedValue},
        success: function() {
            console.log("Data sent!");
        }
    });
	window.location.replace("http://localhost/footprint/index.php?r=resultado/index");
}

function func3(selectedValue){
    //make the ajax call
    $.ajax({
        url: 'ajax/function.php',
        type: 'POST',
        data: {option3 : selectedValue},
        success: function() {
            console.log("Data sent!");
        }
    });
	window.location.replace("http://localhost/footprint/index.php?r=resultado/index");
}

function func4(selectedValue){
    //make the ajax call
    $.ajax({
        url: 'ajax/function.php',
        type: 'POST',
        data: {option4 : selectedValue},
        success: function() {
            console.log("Data sent!");
        }
    });
	window.location.replace("http://localhost/footprint/index.php?r=resultado/index");
}

function func5(selectedValue){
    //make the ajax call
    $.ajax({
        url: 'ajax/function.php',
        type: 'POST',
        data: {option5 : selectedValue},
        success: function() {
            console.log("Data sent!");
        }
    });
	window.location.replace("http://localhost/footprint/index.php?r=resultado/index");
}
</script>


<?php
	session_start();
	$role = Rights::getAssignedRoles(Yii::app() -> user -> Id);
	$user = Yii::app()->user->getName();
	foreach ($role as $role)
                $role -> name;
	if($role -> name == 'Cliente') {

		echo "
		<style>
			#content {
				width:100%;
			}
		</style>
		";

		echo "
		<style>
			#left_div {
				float:left;width:100px;
			}
		</style>
		";

		echo "\t<div id='left_div'>\n";

		$cae = "SELECT * FROM cae";
		$result_cae = mysqli_query($db_connection, $cae);

		echo "\tCAE:<br>\n";
		
		echo "\t<select onchange=\"func2(this.value)\">\n";
		echo"\t<option value='0'></option>\n";
		while ($row = mysqli_fetch_array($result_cae))
		{
			$id = $row['id'];
			$rep = $row ['descricao'];
			echo"\t<option value='$id'>$rep</option>\n";
		}
		echo "\t</select>\n";
		
		echo "\t<br>EMPRESA:<br>\n";

		$empresa = "SELECT * FROM empresa";
		$result_empresa = mysqli_query($db_connection, $empresa);

		
		echo "\t<select onchange=\"func3(this.value)\">\n";
		echo"\t<option value='0'></option>\n";
		while ($row = mysqli_fetch_array($result_empresa))
		{
			$id = $row['id'];
			$rep = $row ['nome'];
			echo"\t<option value='$id'>$rep</option>\n";
		}
		echo "\t</select>\n";
		
		echo "\t<br>EQUIPAMENTO:<br>\n";

		$equipamento = "SELECT * FROM equipamento";
		$result_equipamento = mysqli_query($db_connection, $equipamento);

		
		echo "\t<select onchange=\"func4(this.value)\">\n";
		echo"\t<option value='0'></option>\n";
		while ($row = mysqli_fetch_array($result_equipamento))
		{
			$id = $row['id'];
			$rep = $row ['nome'];
			echo"\t<option value='$id'>$rep</option>\n";
		}
		echo "\t</select>\n";
		
		echo "\t<br>POTENCIA:<br>\n";

		$potencia = "SELECT * FROM potencia";
		$result_potencia = mysqli_query($db_connection, $potencia);

		
		echo "\t<select onchange=\"func5(this.value)\">\n";
		echo"\t<option value='0'></option>\n";
		while ($row = mysqli_fetch_array($result_potencia))
		{
			$id = $row['id'];
			$rep = $row ['potencia'];
			echo"\t<option value='$id'>$rep</option>\n";
		}
		echo "\t</select>\n";

		echo "\t</div>\n";
		
		echo "
		<style>
			#center_div {
				margin:0 auto;width:400px;
			}
		</style>
		";
		
		echo "\t<div id='center_div'>\n";
		
		$cae_display=$empresa_display=$equipamento_display=$potencia_display=$simulacao_display="";
		if(!isset($_SESSION['cae_cliente'])){
			$cae_display = "0";
		}
		else{
			$cae_display = $_SESSION['cae_cliente'];
			//echo $equipamento_display;
		}
		
		echo "\tEMPRESA->CAE:<br>\n";
		$empresa_cae = "SELECT empresa.nome as name FROM empresa,cliente,cae WHERE empresa.cae=$cae_display and cliente.nome='$user' and empresa.cae = cae.id and cliente.empresa=empresa.id";
		$result_empresa_cae = mysqli_query($db_connection, $empresa_cae);
		
		while ($row = mysqli_fetch_array($result_empresa_cae))
		{
			$rep = $row ['name'];
			echo"\t$rep<br>\n";
		}
		
		if(!isset($_SESSION['empresa_cliente'])){
			$empresa_display = "0";
		}
		else{
			$empresa_display = $_SESSION['empresa_cliente'];
			//echo $equipamento_display;
		}
		
		echo "\tSIMULACAO->EMPRESA:<br>\n";
		$simulacao_empresa = "SELECT consumo_total FROM simulacao,empresa,cliente WHERE simulacao.empresa=$empresa_display and simulacao.empresa=empresa.id and cliente.nome='$user' and empresa.id=cliente.empresa";
		$result_simulacao_empresa = mysqli_query($db_connection, $simulacao_empresa);
		
		while ($row = mysqli_fetch_array($result_simulacao_empresa))
		{
			$rep = $row ['consumo_total'];
			echo"\t$rep<br>\n";
		}
		
		if(!isset($_SESSION['equipamento_cliente'])){
			$equipamento_display = "0";
		}
		else{
			$equipamento_display = $_SESSION['equipamento_cliente'];
			//echo $equipamento_display;
		}
		
		echo "\tSIMULACAO->EQUIPAMENTO:<br>\n";
		$simulacao_equipamento = "SELECT consumo_total FROM simulacao_equipamento,simulacao,equipamento,cliente,empresa WHERE simulacao_equipamento.equipamento=$equipamento_display and simulacao_equipamento.simulacao=simulacao.id and simulacao_equipamento.equipamento=equipamento.id and cliente.nome = '$user' and cliente.empresa=empresa.id and simulacao.empresa=empresa.id";
		$result_simulacao_equipamento = mysqli_query($db_connection, $simulacao_equipamento);
		
		while ($row = mysqli_fetch_array($result_simulacao_equipamento))
		{
			$rep2 = $row ['consumo_total'];
			echo"\t$rep2<br>\n";			
		}
		
		if(!isset($_SESSION['potencia_cliente'])){
			$potencia_display = "0";
		}
		else{
			$potencia_display = $_SESSION['potencia_cliente'];
			//echo $equipamento_display;
		}
		
		echo "\tEQUIPAMENTO->POTENCIA:<br>\n";
		$equipamento_potencia = "SELECT equipamento.nome as name FROM simulacao_equipamento,simulacao,equipamento,cliente,empresa,potencia WHERE simulacao_equipamento.simulacao=simulacao.id AND equipamento.potencia=potencia.id AND simulacao_equipamento.equipamento=equipamento.id AND cliente.nome = '$user' AND cliente.empresa=empresa.id AND simulacao.empresa=empresa.id AND potencia.id=$potencia_display";
		$result_equipamento_potencia = mysqli_query($db_connection, $equipamento_potencia);
		
		while ($row = mysqli_fetch_array($result_equipamento_potencia))
		{
			$rep = $row ['name'];
			echo"\t$rep<br>\n";
		}
		
		echo "\tSIMULACAO->(EQUIPAMENTO,EMPRESA):<br>\n";
		$simulacao_double = "SELECT consumo_total FROM simulacao_equipamento,simulacao,equipamento,cliente,empresa WHERE simulacao.empresa=$empresa_display and simulacao_equipamento.equipamento=$equipamento_display AND simulacao_equipamento.simulacao=simulacao.id AND simulacao_equipamento.equipamento=equipamento.id AND cliente.nome = '$user' AND cliente.empresa=empresa.id AND simulacao.empresa=empresa.id";
		$result_simulacao_double = mysqli_query($db_connection, $simulacao_double);
		
		while ($row = mysqli_fetch_array($result_simulacao_double))
		{
			$rep = $row ['consumo_total'];
			echo"\t$rep<br>\n";
		}
		
		echo "\t</div>\n";
	}
?>