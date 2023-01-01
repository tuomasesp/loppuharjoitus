<?php
require('./headers.php');
session_start();
session_destroy();
unset($_SESSION["knimi"]);

http_response_code(200);
echo "Kirjauduit ulos";