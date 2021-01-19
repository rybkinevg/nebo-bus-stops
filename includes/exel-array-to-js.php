<?php

require('SimpleXLSX.php');

$file_path = './files/' . $file;

?>

<script>
    <?php

    if ($xlsx = SimpleXLSX::parse($file_path)) {

        $rows = $xlsx->rows();

    ?>

        const uploadedPoints = [

            <?php

            for ($i = 1; $i != count($rows); $i++) {

            ?>

                {
                    id: <?= "'" . $rows[$i][0] . "'" ?>,
                    latitude: <?= $rows[$i][1] ?>,
                    longitude: <?= $rows[$i][2] ?>,
                },

            <?php

            }

            ?>

        ];

    <?php

    } else {

    ?>

        console.log(<?= SimpleXLSX::parseError() ?>);

    <?php

    }

    ?>
</script>