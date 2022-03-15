<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Red de Trueque</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />

<!-- Theme style -->
<link rel="stylesheet" href="<?=getFile('dist/css/adminlte.min.css')?>">

<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?=getFile('dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">

<!-- Pace Style-->
<link rel="stylesheet" href="<?=getFile('dist/plugins/pace-progress/themes/center-radar.css')?>">

<!--DataTables-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

<!-- DataTables || Select -->
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">

<!-- Estilos personalizados-->
<link rel="stylesheet" href="<?=getFile('styles/estilos.css')?>">

<!-- Icono del mercadito -->
<link rel="shortcut icon" href="<?= getFile('images/logo feria.png')?>" type="image/x-icon">

<?php 
    if(isset($head))
        echo $head;
?>