<?php

$page = get_page();

$scripts = enqueue_scripts($page);

foreach ($scripts as $key => $value) {

    echo "<script id='js-{$key}' src='{$value}'></script>";
}

?>

</body>

</html>