
<?php

$G_css_dir = "./client/css";
if ($__['useMiniCSS']) {
    $G_css_dir = "./client/css-min";
}


foreach (ListFiles($G_css_dir, 'css') as $key => $file) {
    echo "<link href='$file' rel='stylesheet'>";
}
?>
