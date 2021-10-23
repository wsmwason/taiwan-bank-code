<?php

include_once('../src/wsmwason/TaiwanBankCode.php');

$bc = new wsmwason\TaiwanBankCode();
print_r($bc->listBankCodeATM());