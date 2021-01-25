<div class="footer">
    <div class="pull-right hide-phone">
        v. <strong class="text-custom">1.0.1</strong>
    </div>
    <div>
        <strong>Интерактивный помощник</strong>
    </div>
</div>

</div> <!-- content -->

</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php

$page = get_page();

$scripts = enqueue_scripts($page);

foreach ($scripts as $key => $value) {

    echo "<script id='js-{$key}' src='{$value}'></script>";
}

?>

</body>

</html>