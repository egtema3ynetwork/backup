
<?php

require_once './server/site.setting.php';

$G_css_dir = "./client/css";
if (IsMiniMode()) {
    $G_css_dir = "./client/css-min";
}


foreach (ListFiles($G_css_dir, 'css') as $key => $file) {
    echo "<link href='$file' rel='stylesheet'>";
}
?>
