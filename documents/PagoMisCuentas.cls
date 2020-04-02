VERSION 1.0 CLASS
BEGIN
  MultiUse = -1  'True
  Persistable = 0  'NotPersistable
  DataBindingBehavior = 0  'vbNone
  DataSourceBehavior  = 0  'vbNone
  MTSTransactionMode  = 0  'NotAnMTSObject
END
Attribute VB_Name = "PagoMisCuentas"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = True
Attribute VB_PredeclaredId = False
Attribute VB_Exposed = True
Option Explicit

Const MODULE_NAME = "PagoMisCuentas"

Private m_FechaVencimiento As String
Private m_FechaPresentacion As String
Private m_PeriodoHasta As String
Private m_CantidadRegistros As Long
Private m_TotalImporte As Double
Private m_NOUsaEncrypt As Boolean

Public Property Let FechaVencimiento(ByVal fecha As String)
  m_FechaVencimiento = fecha
End Property

Public Property Let FechaPresentacion(ByVal fecha As String)
  m_FechaPresentacion = fecha
End Property

Public Property Let PeriodoHasta(ByVal periodo As String)
  m_PeriodoHasta = periodo
End Property

Public Property Let cantidadRegistros(ByVal cantidad As String)
  m_CantidadRegistros = cantidad
End Property

Public Property Let totalImporte(ByVal total As String)
  m_TotalImporte = total
End Property

Public Property Let NOUsaEncrypt(ByVal noencrypt As String)
  m_NOUsaEncrypt = noencrypt
End Property

Public Function CrearArchivo(ByVal path As String, ByRef orstBancoDebito As ADODB.Recordset) As Boolean
  
  Dim file     As New ssFileManager.clsFile
  Dim fileName, pathName, servicio As String
  Dim nroCaractImpTotal As Integer 'Determina la cantidad de caracteres a utilizar para armar el IMPORTE TOTAL (Pie)
  Dim nroCaractFiller2 As Integer 'Determina la cantidad de caracteres a utilizar para armar el FILLER2 (Pie)
  
  'Header
  Dim codigoRegistro, codigoBanelco, codigoEmpresa, fechaArchivo As Long
  Dim filler As String
      
  'Detalle
  Dim codigoRegistroD, codigoMoneda As Long
  Dim filler1, filler2, nroReferencia, idFactura, nroRefernciaAnt, mensajeTicket, mensajePantalla, codigoBarras As String
  Dim fecha1Vto, fecha2Vto, fecha3Vto, importe1Vto, importe2Vto, importe3Vto As String
    
  'Trailer
  Dim codigoRegistroT As Long
  Dim cantidadRegistros, filler1T, totalImporte, filler2T As String
  
  Dim cantidad As Long
  Dim importeTotal As Double
  Dim cantCaractIdent As Integer
  Dim perDesc As String
  
  Dim TipoIdentificador As String
  TipoIdentificador = orstBancoDebito("bde_TipoIdentificador")
  
  Crear_Conexiones
  
'OBTENER INFO DE LA AUDOTORIA
  Dim orstAuditCabecera As New ADODB.Recordset
  orstAuditCabecera.Open ObtenerInfoAuditCabecera(orstBancoDebito("bdc_idBancoDebitoCabecera")), cnxBrio, adOpenForwardOnly, adLockReadOnly

  Dim orstAuditoria As New ADODB.Recordset
  orstAuditoria.Open ObtenerInfoAuditoria(orstBancoDebito("bdc_idBancoDebitoCabecera"), orstBancoDebito("bdd_idBancoDebitoEnvioDeuda")), cnxBrio, adOpenForwardOnly, adLockReadOnly
'****************************
  
  cantidad = orstAuditCabecera("bdc_cantidadregistros")
  importeTotal = orstAuditCabecera("bdc_importetotal")
  
  codigoEmpresa = orstBancoDebito("bde_Campo1")
  nroCaractImpTotal = orstBancoDebito("bde_Campo2")
  cantCaractIdent = orstBancoDebito("bde_Campo3")
  
  nroCaractFiller2 = 250 - nroCaractImpTotal
  fileName = "FAC" & codigoEmpresa & "." & Format(Now, "DDMMYY")
  pathName = IIf(path = "", App.path & "\log", path)
  
  'Crea el archivo
  file.Crear pathName, fileName, False, True
  'Abre el archivo
  file.Abrir pathName, fileName, eSoloEscritura
  
  'ASIGNA LOS VALORES A LAS VARIABLE DEL HEADER
  codigoRegistro = 0
  codigoBanelco = 400
  'codigoEmpresa ya se definió cuando se creo el nombre del archivo
  fechaArchivo = Format(Now, "YYYYMMDD")
  filler = Rellena(filler, 264, 48, eIzquierda)
   
  'ESCRIBE HEADER
  file.Escribir codigoRegistro & codigoBanelco & codigoEmpresa & fechaArchivo & filler + vbCrLf
   
  'ESCRIBE CUERPO
  orstAuditoria.MoveFirst
  Do While Not orstAuditoria.EOF
      
    'ASIGNA LOS VALORES A LAS VARIABLE DEL DETALLE
    codigoRegistroD = 5
    nroReferencia = Rellena(orstAuditoria(TipoIdentificador), cantCaractIdent, 48, eDerecha)
    nroReferencia = Rellena(nroReferencia, 19, 32, eIzquierda)
    idFactura = Rellena(orstAuditoria("per_idperiodo"), 20, 32, eIzquierda)
    codigoMoneda = 0
    fecha1Vto = Mid(m_FechaVencimiento, 7, 4) + Mid(m_FechaVencimiento, 4, 2) + Mid(m_FechaVencimiento, 1, 2)
    importe1Vto = Rellena(CStr(Replace(Replace(FormatNumber(orstAuditoria("bdd_importe"), 2), ".", ""), ",", "")), 11, 48, eDerecha)
    fecha2Vto = Rellena(fecha2Vto, 8, 48, eIzquierda)
    importe2Vto = Rellena(importe2Vto, 11, 48, eIzquierda)
    fecha3Vto = Rellena(fecha3Vto, 8, 48, eIzquierda)
    importe3Vto = Rellena(importe2Vto, 11, 48, eIzquierda)
    filler1 = Rellena(filler1, 19, 48, eIzquierda)
    nroRefernciaAnt = nroReferencia
    perDesc = orstAuditoria("per_descripcion")
    perDesc = Mid(perDesc, 5, 2) & "-" & Mid(perDesc, 1, 4)
    mensajeTicket = UCase(Rellena("CUOTA " + perDesc, 40, 32, eIzquierda))
    mensajePantalla = UCase(Rellena("CUOTA " + perDesc, 15, 32, eIzquierda))
    codigoBarras = Rellena(codigoBarras, 60, 32, eIzquierda)
    filler2 = Rellena(filler2, 29, 48, eIzquierda)
    
    file.Escribir codigoRegistroD & nroReferencia & idFactura & codigoMoneda & fecha1Vto & importe1Vto & fecha2Vto & importe2Vto & fecha3Vto & importe3Vto & filler1 & nroRefernciaAnt & mensajeTicket & mensajePantalla & codigoBarras & filler2 + vbCrLf
    orstAuditoria.MoveNext
  Loop
  
  'ASIGNA LOS VALORES A LAS VARIABLE DEL TRAILER
  codigoRegistroT = 9
  cantidadRegistros = Rellena(cantidad, 7, 48, eDerecha)
  filler1T = Rellena(filler1T, 7, 48, eIzquierda)
  
  'NAUTICO NORTE USA ESTA ESTRUCTURA DE 16 Y 234 CARACTERES PARA ESTOS ULTIMOS DOS CAMPOS
  'QUE SEAN TAMAÑOS QUE PODAMOS REGISTRAR EN LOS BANCODEBITO
  totalImporte = Rellena(CStr(Replace(Replace(FormatNumber(importeTotal, 2), ".", ""), ",", "")), nroCaractImpTotal, 48, eDerecha)
  
  filler2T = Rellena(filler2T, nroCaractFiller2, 48, eIzquierda)
  
  'ESCRIBE TRAILER
  file.Escribir codigoRegistroT & codigoBanelco & codigoEmpresa & fechaArchivo & cantidadRegistros & filler1T & totalImporte & filler2T + vbCrLf
  
  'Cierra archivo
  file.Cerrar
   
  CrearArchivo = True
End Function

'NUEVO METODO DE LECTURA
Public Function LeerArchivo(ByVal path As String) As ADODB.Recordset
  Dim orst As New ADODB.Recordset
  Dim Linea As String
  Dim periodo As String
  Dim codigoBco As String
  Dim total As Double
  
  Dim TipoIdentificador As String
  TipoIdentificador = DevuelveTipoIdentificador(ePagoMisCuentas)

  'LLENA EL RECORDSET CON LOS CAMPOS
  CrearCamposRecordSet orst
  
  orst.Open
  'Recorre archivo para traspasar datos
  Open path For Input As #1
  Line Input #1, Linea 'Primer Linea Correspondiente a la cabecera
    
  While Not EOF(1)
    Line Input #1, Linea
    If Not Mid(Linea, 1, 1) = 9 Then
      orst.AddNew
      orst!estado = 1 'Indica la luz verde, en la pantalla de exportacion (este servicio no trabaja con rechazos, por eso se clava 1 directa//).
      orst!idSocio = BuscarCampoTabla("socio", "soc_idsocio", "" + TipoIdentificador + "", Trim(Mid(Linea, 2, 18)), True)
      orst!NroSocio = BuscarCampoTabla("socio", "soc_nrosocio", "" + TipoIdentificador + "", Trim(Mid(Linea, 2, 18)), True)
      orst!nombre = BuscarCampoTabla("socio", "soc_apellidoynombre", "" + TipoIdentificador + "", Trim(Mid(Linea, 2, 18)), True)
      orst!cbu = "---"
      orst!importe = CDbl(Trim(Mid(Linea, 58, 9) + "." + Right(Mid(Linea, 67, 2), 2))) ' Importe
      total = total + orst!importe
      orst!fechaVenc = Trim(Mid(Linea, 45, 2) + "/" + Mid(Linea, 43, 2) + "/" + Mid(Linea, 41, 4))
      orst!codigoBco = "00" '0" solo deben ser 2 caracteres, porque asi lo trabaja donde se carga el archivo
      orst!TipoRegistro = ""
      orst!servicio = ""
      orst!idDebito = ""
      orst!periodo = Trim(Mid(Linea, 41, 6))
      orst!idPeriodo = BuscarCampoTabla("Periodo", "per_idPeriodo", "per_descripcion", orst!periodo, True)
      'No usamos 'DescRechazo': Los Serv. masivos no lo devuelven
      orst!idCuotaDetalle = "0"
      orst.Update
    End If
  Wend
  Close

  Set LeerArchivo = orst
End Function

