taiwan-bank-code 台灣銀行代碼清單

## 主要用途

提供台灣的銀行代碼清單 JSON 格式，資料來源為 [財金資訊股份有限公司](https://www.fisc.com.tw/TC/Default.aspx)
的 [開放資料](https://www.fisc.com.tw/tc/knowledge/opendata.aspx) XML 檔案，
透過 PHP 將 XML 轉換為 JSON 格式方便運用。

## 關於此程式

雖然 [財金資訊股份有限公司](https://www.fisc.com.tw/TC/Default.aspx)
的 [開放資料](http://www.fisc.com.tw/tc/knowledge/opendata.aspx)
有提供完整的 XML 或 CSV 格式的清單，
但其實內容包含了各種不同類型的銀行代碼清單：

  * 全國性繳費/稅業務-活期性帳戶繳費作業
  * 外幣結算平台-美元
  * 通匯業務-證券匯款
  * 通匯業務-公庫匯款
  * ...

一般情況下我們只會需要 `網路ATM`、`通匯業務-入戶電匯` 或 `跨行自動化服務機器業務(金融卡)` 的類型即可，
因此此程式下載 XML 後只會將這幾個類型的清單處理為 JSON 格式的檔案。

## 安裝

透過 Composer 安裝

	composer require wsmwason/taiwan-bank-code

## 簡易使用方式

取得 `網路ATM` 銀行代碼清單

```php
$taiwanBankCode = new wsmwason\TaiwanBankCode();
$bankCodeList = $taiwanBankCode->listBankCodeATM();
```

取得 `通匯業務-入戶電匯` 銀行代碼清單

```php
$taiwanBankCode = new wsmwason\TaiwanBankCode();
$bankCodeList = $taiwanBankCode->listBankCodeTT();
```

取得 `跨行自動化服務機器業務(金融卡)` 銀行代碼清單

```php
$taiwanBankCode = new wsmwason\TaiwanBankCode();
$bankCodeList = $taiwanBankCode->listBankCodeCrossATM();
```

只要 `data/` 目錄內含有 JSON 檔案，
就能透過 `listBankCodeATM()` 或 `listBankCodeTT()` 取得銀行代碼清單。

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

或是自己把 `data/` 目錄的 JSON 直接讀取來用。

## 更新來源

本來是不想把 XML 放在專案內，
不過台灣的銀行代碼異動應該不算是太頻繁，
如果有更新時之後會再發布新版來更新 JSON 內容。

不過如果真的想直接更新的話，還是可以用 `TaiwanBankCodeDataUpdate` 來下載 XML 以及轉換 JSON 格式檔案，
如果真的有更新可以順手發個 PR 發布新版。

執行下載 XML 及轉換 JSON

```php
$taiwanBankCodeDataUpdate = new wsmwason\TaiwanBankCodeDataUpdate();

// Download XML
$taiwanBankCodeDataUpdate->updateXmlFromFisc();

// Convert to Json
$taiwanBankCodeDataUpdate->convertJsonFromXml();
```

## 版本紀錄

  **1.0.0**
  正式釋出

## License

The MIT License (MIT)