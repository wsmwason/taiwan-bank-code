<?php
/**
 * TaiwanBankCode 台灣銀行代碼清單
 *
 * @version v0.1
 * @author wsmwason
 */
class TaiwanBankCode {

  /**
   * 財金資訊股份有限公司 開放資料 XML 網址
   * @var string
   */
  protected $fiscXmlUrl = 'http://www.fisc.com.tw/TC/OPENDATA/Comm1_MEMBER.xml';

  /**
   * 開放資料 XML 檔名路徑
   * @var string
   */
  private $fiscXmlFile;

  /**
   * Json 檔名路徑
   * @var string
   */
  private $jsonFile;

  function __construct()
  {
    $this->fiscXmlFile = __DIR__.'/data/fiscATM.xml';
    $this->jsonFile = __DIR__.'/data/taiwanBankCode%s.json';
  }

  /**
   * 取得 BankCode Array List 電匯(TT)
   * @return array
   */
  public function listBankCodeTT()
  {
    return $this->listBankCode('TT');
  }

  /**
   * 取得 BankCode Array List ATM
   * @return array
   */
  public function listBankCodeATM()
  {
    return $this->listBankCode('ATM');
  }

  /**
   * 取得 BankCode Array List 電匯(TT)
   * @return array
   */
  protected function listBankCode($type = 'ATM')
  {
    $jsonFile = sprintf($this->jsonFile, $type);
    if(!file_exists($jsonFile)){
      throw new Exception($jsonFile." not found");
    }
    $jsonString = file_get_contents($jsonFile);
    $jsonArray = json_decode($jsonString, true);
    return $jsonArray;
  }

  /**
   * 將 fiscATM.xml 轉為 json
   */
  public function convertJsonFromXml()
  {
    $xml = simplexml_load_file($this->fiscXmlFile);
    if(!$xml instanceof SimpleXMLElement){
      throw new Exception($this->fiscXmlFile." not valid XML file");
    }
    $jsonArray = array();
    foreach($xml->record as $record){
      switch((string) $record->{'業務別'}){
        case '通匯業務-入戶電匯':
          $type = 'TT';
          break;
        case '網路ATM':
          $type = 'ATM';
          break;
        default:
          $type = '';
      }
      if(!empty($type)){
        if(!isset($jsonArray[$type])){
          $jsonArray[$type] = array();
        }
        $jsonArray[$type][] = array(
          'code' => (string) $record->{'銀行代號BIC'},
          'name' => (string) $record->{'金融機構名稱'},
        );
      }
    }
    foreach($jsonArray as $type => $jsonData){
      $saveJsonFile = sprintf($this->jsonFile, $type);
      file_put_contents($saveJsonFile, json_encode($jsonData, JSON_UNESCAPED_UNICODE));
      echo "Convert ".$saveJsonFile." success\n";
    }
  }

  /**
   * 更新 XML from http://www.fisc.com.tw/
   * 財金資訊股份有限公司 開放資料
   */
  public function updateXmlFromFisc()
  {
    $xmlString = file_get_contents($this->fiscXmlUrl);

    if(empty($xmlString)){
      throw new Exception("Can not read ".$this->fiscXmlUrl);
    }

    if(!is_writable(dirname($this->fiscXmlFile))){
      throw new Exception("data/ not writable");
    }

    if(file_put_contents($this->fiscXmlFile, $xmlString)){
      echo "Update ".$this->fiscXmlFile." success\n";
    }else{
      echo "Update ".$this->fiscXmlFile." failed\n";
    }
  }

}
