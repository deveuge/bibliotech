<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/bootstrap.bundle.min.js"></script>
<script src="js/lib/glider.min.js"></script>
<script src="js/lib/chart.min.js"></script>
<script src="js/lib/jquery.validate.min.js"></script>

<script src="js/general.js"></script>
<script>
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida.",
        date: "El valor debe ser una fecha válida.",
        number: "El valor debe ser un número entero.",
        digits: "El valor debe contener solo dígitos.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "El valor debe contener una extensión aceptada.",
        maxlength: jQuery.validator.format("El valor no debe tener más de {0} caracteres."),
        minlength: jQuery.validator.format("El valor debe tener al menos {0} caracteres."),
        rangelength: jQuery.validator.format("El valor debe tener entre {0} y {1} caracteres."),
        range: jQuery.validator.format("El valor debe estar entre {0} y {1}."),
        max: jQuery.validator.format("El valor debe ser menor o igual a {0}."),
        min: jQuery.validator.format("El valor debe ser mayor o igual a {0}.")
    });
</script>

@isset($jaxon)
<?php echo $jaxon->getJs() ?>
<?php echo $jaxon->getScript() ?>
@endisset