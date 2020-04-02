
<?php 
	$lperiodos = "";
	$vperiodos = "";
	$periodo = "";
	
	$estadistica1 = new clsEstadistica();
	$resultado1 = $estadistica1->get_lecturasPorCliente($_SESSION['ClienteId']);
	while ($fila1 = $resultado1->fetch_assoc()) 
	{    
		$lperiodos .=  "\"" . $fila1['Periodo'] . "\",";
		$vperiodos .= 	"\"" . $fila1['Socios'] . "\",";
		$periodo = $fila1['Periodo'];
	}
	
	$lperiodos = substr($lperiodos, 0, -1);
	$vperiodos = substr($vperiodos, 0, -1);
	
	$resultado1->free();
	$estadistica1->closeCNX();
?>

<div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Evolución de accesos</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
			<!-- Cuadro de Datos -->
            <div style="width: 90%"><canvas id="canvas" height="450" width="600"></canvas></div>
        </div>
        <!-- /.box-body -->
</div>

<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		//labels : ["Enero","Febrero","Marzo","Abril"],
		labels : [<?php echo $lperiodos?>],
		datasets : [
			{
				fillColor : "rgba(0,217,0,1)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [<?php echo $vperiodos?>]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>