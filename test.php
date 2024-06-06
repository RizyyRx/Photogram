<pre>
<?php
include "libs/load.php";
print("hi");
$p = new Post(1);
print($p->getPostText());
print($p->getImageUri());
print_r($_SERVER);
?>
</pre>

