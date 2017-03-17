taiwan-bank-code 台灣銀行代碼清單
===

提供台灣的銀行代碼清單 json 格式，資料來源為 [財金資訊股份有限公司](http://www.fisc.com.tw/TC/Default.aspx)
的 [開放資料](http://www.fisc.com.tw/tc/knowledge/opendata.aspx) XML 檔案，
透過 PHP 將 XML 轉換為 JSON 格式方便運用。

### 關於此程式

雖然 [財金資訊股份有限公司](http://www.fisc.com.tw/TC/Default.aspx)
的 [開放資料](http://www.fisc.com.tw/tc/knowledge/opendata.aspx)
有提供完整的 XML 或 CSV 格式的清單，
但其實內容包含了 `全國性繳費/稅業務-活期性帳戶繳費作業`、`外幣結算平台-美元`、 `通匯業務-證券匯款` 等各種不同類型的銀行代碼清單，
一般情況下我們只會需要 `網路ATM` 或 `通匯業務-入戶電匯` 的類型即可，
因此此程式擷取 XML 後只會將這兩個類型的清單處理為 JSON 格式的檔案。

### 簡易使用方式

 * listBankCodeATM()
 * listBankCodeTT()

只要 `data/` 目錄內含有 JSON 檔案，
就能透過 `listBankCodeATM()` 或 `listBankCodeTT()` 取得銀行代碼清單。

```php
$taiwanBankCode = new TaiwanBankCode();
$bankCodeATM = $taiwanBankCode->listBankCodeATM();
```

可取得 ATM 的 Array：

	Array
	(
	    [0] => Array
	        (
	            [code] => 004
	            [name] => 臺灣銀行
	        )

	    [1] => Array
	        (
	            [code] => 005
	            [name] => 臺灣土地銀行
	        )
		...
    )

或是自己把 `data/` 目錄的 `taiwanBankCodeATM.json` 或 `taiwanBankCodeTT.json` 拿來用。

### 透過 Composer 安裝

	"wsmwason/taiwan-bank-code": "*"

### 更新來源 XML

為了確保台灣銀行有變動時可以獲取最新資訊，Source Code 裡面不包含開放資料的 XML 檔案，
要更新 XML 可透過 `updateXmlFromFisc()` 進行獲取更新，並透過 `convertJsonFromXml()`
來轉換為最新的 JSON 格式檔案。

```php
$taiwanBankCode = new TaiwanBankCode();

// Update XML
$taiwanBankCode->updateXmlFromFisc();

// Convert to Json
$taiwanBankCode->convertJsonFromXml();
```

### License

The MIT License (MIT)