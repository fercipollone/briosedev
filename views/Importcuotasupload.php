<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
    $Mensaje = "";
    ini_set('upload-max-filesize', '10M');
    ini_set('post_max_size', '64M');
    ini_set('upload_max_filesize', '64M');
  ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      <h1>
      <i class="fa fa-users"></i>
      &nbsp;&nbsp;Importación de Cuotas 
        <small>Sede Virtual - SV</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Actualizacion de Información</a></li>
        <li class="active">-</li>
      </ol>
    </section>

    <section class="content">          
      <div class="row">
          <form method="POST" action="uploadfile.php" enctype="multipart/form-data">
            <div>
              <span>Upload a File:</span>
              <input type="file" name="uploadedFile" />
            </div>
            <input type="submit" name="uploadBtn" value="Upload" />
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            
            <?php #include "ImportXml.php";  ?>
        </div>
      </div>
            
      <?php echo '<script language="javascript">document.getElementById("information").innerHTML="Proceso finalizado"</script>';?>
    </section>
  </div>       