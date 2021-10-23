<?php

namespace wsmwason;

/**
 * TaiwanBankCode 台灣銀行代碼清單
 *
 * @author wsmwason
 */
class TaiwanBankCode
{

  /**
   * Json 檔名路徑
   * 
   * @var string
   */
  protected $jsonFile;

  public function __construct()
  {
    $this->jsonFile = __DIR__ . '/../../data/taiwanBankCode%s.json';
  }

  /**
   * 取得 BankCode Array List 電匯(TT)
   * 
   * @return array
   */
  public function listBankCodeTT()
  {
    return $this->listBankCode('TT');
  }

  /**
   * 取得 BankCode Array List ATM
   * 
   * @return array
   */
  public function listBankCodeATM()
  {
    return $this->listBankCode('ATM');
  }

  /**
   * 取得 BankCode Array List 跨行ATM
   * 
   * @return array
   */
  public function listBankCodeCrossATM()
  {
    return $this->listBankCode('CrossATM');
  }

  /**
   * 取得 BankCode Array List
   * 
   * @return array
   */
  protected function listBankCode($type = 'ATM')
  {
    $jsonFile = sprintf($this->jsonFile, $type);
    if (!file_exists($jsonFile)) {
      throw new \Exception($jsonFile . " not found");
    }
    $jsonString = file_get_contents($jsonFile);
    $jsonArray = json_decode($jsonString, true);
    return $jsonArray;
  }

}
