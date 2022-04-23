<head>
	<title>Bibliotech | {{ $titulo }}</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/logo.svg">

	<!-- Estilos Bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
		integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Estilos propios -->
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/{{ $estilo }}">
    
    <!-- Glider - https://nickpiscitelli.github.io/Glider.js/ -->
	<link rel="stylesheet" href="css/lib/glider.min.css">

	@isset($jaxon)
	<?php echo $jaxon->getCss() ?>
	@endisset
</head>

@include('plantillas.alert')