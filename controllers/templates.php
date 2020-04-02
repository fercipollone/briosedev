<?php 
class TemplateController { 
    public function template()
			{
				include "views/template.php";
			}
} 

$template = new TemplateController; 
?> 