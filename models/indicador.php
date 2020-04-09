<?php

class indicador
{
    
    //Class: 
    //small-box bg-aqua
    //small-box bg-green
    //small-box bg-yellow
    //small-box bg-red


    //Icon: 
    // Compras   ion ion-bag     
    // Barras    ion-stats-bars  
    // Persona   ion ion-person
    // Personas  fa fa-users
    // Persona Nueva ion ion-person-add
    // Pie ion ion-pie-graph
    // Link  fa fa-link
        

    public function Box($Valor, $Porcentaje, $Titulo, $Class, $Icon, $Comentario)
        {
            $code =  "<div class= \"{$Class}\">";
            $code .= "<div class=\"inner\">";
            $code .= "<h3>{$Valor}</h3>";
            $code .= "<p>{$Titulo}</p>";
            $code .= "</div>";
            $code .= "<div class=\"icon\">";
            $code .= "<i class=\"{$Icon}\"></i>";
            $code .= "</div>";
            //$code .= "<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            $code .= "<a href=\"#\" class=\"small-box-footer\">{$Comentario}&nbsp;&nbsp;<i class=\"fa fa-arrow-circle-right\"></i></a>";
            $code .= "</div>";

            return $code; 
        }

    public function TableBox($Titulo, $resultado)
        {
            $code = "<div class=\"box box-primary\">";
            $code .= "<div class=\"box-header with-border\">";
            $code .= "<h3 class=\"box-title\">{$Titulo}</h3>";
            $code .= "<div class=\"box-tools pull-right\">";
            $code .= "<button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>";
            $code .= "</div>";
            $code .= "</div>";
            $code .= "<div class=\"box-body\">";
            $code .= "<div class=\"box-footer no-padding\">";
            $code .= "<ul class=\"nav nav-pills nav-stacked\">";

            //Aca debe iterar para mostrar el contenido 
            while ($fila = $resultado->fetch_assoc()) 
            {    
                $code .= "<li><i class=\"fa fa-circle-o text-green\">&nbsp;</i>{$fila['cli_Nombre']}<span class=\"pull-right badge bg-green\">30%</span><span class=\"pull-right\">{$fila['cli_idCliente']}&nbsp;&nbsp;</span></li>";
            }                                    
            $code .= "</ul>";
            $code .= "</div>";
            $code .= "</div>";
            $code .= "</div>";

            return $code; 
        }
}
?>
