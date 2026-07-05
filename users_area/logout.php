<?php

session_start();
session_unset();
session_destroy();
echo "<scrusernamet>window.open('../index.php','_self')</scrusernamet>";

?>