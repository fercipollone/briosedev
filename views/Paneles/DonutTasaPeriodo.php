<?php 
  	
	$est = new clsEstadistica();
	$est->get_TasaPeriodo($_SESSION['ClienteId'],$pendiente, $cobrado);
  $est->closeCNX();

  $total = $pendiente + $cobrado;
  $PorcPendiente = number_format(($pendiente*100)/$total,2);
  $PorcCobrado = 100 - $PorcPendiente;
?>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tasa de Cobranza</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <!-- Panel aqui -->
        <div class="box-body">
					<div class="chart">
							<canvas id="pieChart" style="height:250px"></canvas>
					</div>
        </div>
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><i class="fa fa-circle-o text-green">&nbsp;</i>Cobrado<span class="pull-right badge bg-green"><?php echo $PorcCobrado;?>%</span><span class="pull-right">$&nbsp;<?php echo number_format($cobrado);?>&nbsp;&nbsp;</span></li>
                <li><i class="fa fa-circle-o text-red">&nbsp;</i>Pendiente<span class="pull-right badge bg-red"><?php echo $PorcPendiente;?>%</span><span class="pull-right">$&nbsp;<?php echo number_format($pendiente);?>&nbsp;&nbsp;</span></li>
              </ul>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
<script>
	$(function () {
		//-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : <?php echo $pendiente;?>,
        color    : 'red',
        highlight: 'red',
        label    : 'Pendiente'
      },
      {
        value    : <?php echo $cobrado;?>,
        color    : 'green',
        highlight: 'green',
        label    : 'Cobrado'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
	})

	</script>