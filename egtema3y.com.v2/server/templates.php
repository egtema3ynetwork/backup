<?php



foreach (ListFiles('./client/templates', 'php') as $key => $file) {
    include("$file");
}
?>
