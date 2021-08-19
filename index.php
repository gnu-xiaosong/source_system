<?php
//define evirmoment console
define('XS_ENTER','/public/index.php');
define("XS_PHP_VERSION_HINT","<script>alert(\"您php版本过小，请调节至大于7.0\");</script>");
//php version check
if(PHP_VERSION<5.6){
echo XS_PHP_VERSION_HINT;
die;
}
//define progress enter
header("Location:".XS_ENTER);
//

?>