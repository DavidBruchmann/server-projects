<?php

require_once('configDomains.php');
require_once('class.localDomain.php');
require_once('class.localDomains.php');

$obj_localDomains = new localDomains($arr_domains);
$obj_localDomains->parse();

?>