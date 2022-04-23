<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/bootstrap.bundle.min.js"></script>
<script src="js/lib/glider.min.js"></script>
<script src="js/lib/chart.min.js"></script>

<script>
    setTimeout(function() {
        $(".alert-dismissible").alert('close');
    }, 4000);
</script>

@isset($jaxon)
<?php echo $jaxon->getJs() ?>
<?php echo $jaxon->getScript() ?>
@endisset