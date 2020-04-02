    SELECT 
        `socio`.`soc_idsocio` AS `soc_idsocio`,
        `socio`.`cli_idCliente` AS `cli_idcliente`,
        `cliente`.`cli_nombre` AS `cli_nombre`,
        `socio`.`soc_sexo` AS `soc_sexo`,
        `socio`.`tid_idtipodocumento` AS `tid_idtipodocumento`,
        `socio`.`soc_documento` AS `soc_documento`,
        `socio`.`soc_apellidoynombre` AS `soc_apellidoynombre`,
        `vw_usuarios`.`usr_idUsuario` AS `usr_idUsuario`,
        `vw_usuarios`.`usr_Nombre` AS `usr_Nombre`,
        `vw_usuarios`.`usr_Email` AS `usr_Email`,
        `vw_usuarios`.`usr_Clave` AS `usr_Clave`,
        `vw_usuarios`.`cli_Logo` AS `cli_Logo`,
        `vw_usuarios`.`cli_FotoPath` AS `cli_FotoPath`,
        `vw_usuarios`.`cli_XMLFileName` AS `cli_XMLFileName`,
        `vw_usuarios`.`usr_SuperUsuario` AS `usr_SuperUsuario`,
        `vw_usuarios`.`hab_nombre` AS `hab_nombre`,
        `vw_usuarios`.`hab_habilitado` AS `hab_habilitado`,
        `vw_usuarios`.`hab_idHabilitacion` AS `hab_idHabilitacion`
    FROM
        (`socio`
        LEFT JOIN `vw_usuarios` ON ((`vw_usuarios`.`cli_idCliente` = `socio`.`cli_idCliente`) and (`vw_usuarios`.`soc_idsocio` = `socio`.`soc_idsocio`))
        JOIN `cliente` ON ((`cliente`.`cli_idCliente` = `socio`.`cli_idCliente`)))
	
    WHERE 
		`socio`.`soc_documento` = 26461153
        
        