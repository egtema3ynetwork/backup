<?php


$G_js_dir = "./client/js";

if (IsMiniMode()) {
    $G_js_dir = "./client/js-min";

}
foreach (ListFiles($G_js_dir, 'js') as $key => $file) {
echo "<script src='$file'></script>";
}
?>
