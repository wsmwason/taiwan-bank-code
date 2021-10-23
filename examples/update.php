<?php

include_once('../vendor/autoload.php');

$taiwanBankCodeDataUpdate = new wsmwason\TaiwanBankCodeDataUpdate();
$taiwanBankCodeDataUpdate->updateXmlFromFisc();
$taiwanBankCodeDataUpdate->convertJsonFromXml();