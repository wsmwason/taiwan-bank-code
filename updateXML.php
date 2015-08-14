<?php
/**
 * 更新 XML from [財金資訊股份有限公司 開放資料](http://www.fisc.com.tw/)
 * 並轉換更新 JSON
 */

include('TaiwanBankCode.php');

$taiwanBankCode = new TaiwanBankCode();

// Update XML
$taiwanBankCode->updateXmlFromFisc();

// Convert to Json
$taiwanBankCode->convertJsonFromXml();
