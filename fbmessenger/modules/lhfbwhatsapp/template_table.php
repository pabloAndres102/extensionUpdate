<?php 

$tpl = erLhcoreClassTemplate::getInstance('lhfbwhatsapp/template_table.tpl.php');



$templateString = isset($_GET['gg']) ? $_GET['gg'] : null;




$tpl->set('templateString', $templateString);
$Result['content'] = $tpl->fetch();




?>