<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/bootstrap.bundle.min.js"></script>
<script src="js/lib/glider.min.js"></script>
<script src="js/lib/chart.min.js"></script>

<script src="js/general.js"></script>

@isset($jaxon)
<?php echo $jaxon->getJs() ?>
<?php echo $jaxon->getScript() ?>
@endisset