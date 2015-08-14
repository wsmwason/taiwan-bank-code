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

### 關於 財金資訊股份有限公司 開放資料 的 HTML

有些平台提供的檔案可能是因為 Windows .NET 平台的關係，提供連結的路徑是 "\" 反斜線，
雖然 IE 跟 Chrome 都能正常轉為斜線並下載到檔案，
但 Firefox 如果點了這個連結，只會原始的呈現為 `/\TC\OPENDATA\Comm1_MEMBER.csv`，
最後的結果就是 404 找不到網頁，如果能遵循標準的 "/" 來放連結不是很好嗎？

	<tr class="bg_01">
		<td class="docName">跨行業務參加金融機構一覽</td>
		<td><a class="doc-dl xls" title="下載 Excel" href="\TC\OPENDATA\Comm1_MEMBER.xls">Excel</a></td>
		<td><a class="doc-dl pdf" title="下載 PDF" href="\TC\OPENDATA\Comm1_MEMBER.pdf">pdf</a></td>
		<td><a class="doc-dl csv" title="下載 CSV" href="\TC\OPENDATA\Comm1_MEMBER.csv">csv</a></td>
		<td><a class="doc-dl xml" title="下載 XML" href="\TC\OPENDATA\Comm1_MEMBER.xml">xml</a></td>
	</tr>

### License

The MIT License (MIT)