<?php


$G_js_dir = "./client/js";

if ($__['useMiniJS']) {
    $G_js_dir = "./client/js-min";
    ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        (window.jQuery || document.write('<script src="/js-min/level 0/jquery-1.10.2-min"><\/script>'));
    </script>


    <?php

    echo '<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>';
}



foreach (ListFiles($G_js_dir, 'js') as $key => $file) {
	
   echo "<script src='$file'></script>";

}
?>
