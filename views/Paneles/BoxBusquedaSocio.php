<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Busqueda de Socios</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <!-- Cuadro de Datos -->
        <div class="box-footer no-padding">
        <!-- INICIO -->  
        <p class="login-box-msg">Ingrese los datos de búsqueda</p>

            <!--<form action="panel.php?panel=socios" method="post">-->
            <form action="panel.php?panel=socios" method="post">    
              <div class="form-group has-feedback">
                <input name="busqueda" type="busqueda" class="form-control" placeholder="Apellido Nombre">
                <span class="glyphicon glyphicon-text-size form-control-feedback"></span>
              </div>
              
              <div class="form-group has-feedback">
                <input name="numero" type="number" class="form-control" placeholder="Número de Socio o Documento" autofocus>
                <span class="glyphicon glyphicon-th-large form-control-feedback"></span>
              </div>
            
              <div class="box-footer no-padding">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">Buscar</button>
              </div>
            </form>
            
            <br/>
            
            <!-- <p class="login-box-msg"> <span class="glyphicon glyphicon-qrcode">&nbsp;</span>Busqueda por código QR</p> -->
            <div class="box-footer no-padding">
                  <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="window.location='qr/index.html'"><span class="glyphicon glyphicon-qrcode">&nbsp;</span>Buscar con código QR</button>
            </div>

            <br/>

            <!-- <p class="login-box-msg"> <span class="glyphicon glyphicon-barcode">&nbsp;</span>Busqueda por código barra</p> -->
            <div class="box-footer no-padding">
                  <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="window.location='bc/index.html'"><span class="glyphicon glyphicon-barcode">&nbsp;</span>Buscar con código de barras</button>
            </div>

            <!--
            <form action="qr/index.html" method="post">
              <div class="box-footer no-padding">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Buscar con código QR</button>
              </div>
            </form>
            -->
        <!-- FIN -->
        </div>
    </div>
</div>
