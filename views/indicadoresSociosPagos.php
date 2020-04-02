<?php
    require_once("../models/clsPanelGlobal.php");
    $indicador = new clsPanelGlobal(); 
  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Formas de Pago
        <small>Información sobre como pagan los socios</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Información forma de pago</a></li>
        <li class="active">-</li>
      </ol>
    </section>


<section class="content">

      <!-- ******************************************************************************************************************************** -->

      <section class="content">
      <div class="row">
        <div class="col-md-6">
            <?php 
              //Grafico de Donas CharJS
              include "Paneles/CharJS.Donut.Pagos.php"; 
            ?>  
        </div>

        <div class="col-md-6">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Adheridos al Debito Directo</span>
                <span class="info-box-number">190</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 4%"></div>
                </div>
                <span class="progress-description">3.5% del total adheridos al debito directo</span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>

        <div class="col-md-6">
          <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Medios de Pago Utilizados</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Cuadro de Datos -->
                    <div class="box-footer no-padding">
                          <ul class="nav nav-pills nav-stacked">
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Argencard<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Becas Banco Nación<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Efectivo<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Jerárquicos<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Maestro<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Master Debit<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Mastercard<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Visa Credito<span class="pull-right">&nbsp;&nbsp;</span></li>
                            <li><i class="fa fa-circle-o text-orange">&nbsp;</i>Visa Debito<span class="pull-right">&nbsp;&nbsp;</span></li>

                            
                          </ul>
                    </div>
                </div>
                  <!-- /.box-body -->
            </div>
        </div>

       </div>

      
      <!-- /.row (main row) -->

    
    </section>
       