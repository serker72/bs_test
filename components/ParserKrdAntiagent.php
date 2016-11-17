<?php

namespace app\components;

use Yii;
use \yii\base\Object;

/**
 * Description of ParserKrdAntiagent
 *
 * @author kerimov
 */
class ParserKrdAntiagent extends Object {
    /**
     * @var string загруженные данные страницы
     */
    private $_data;
    /**
     * @var string хост форума
     */
    public $host;
    /**
     * @var array конфигурация cURL
     */
    public $curlOpt;
 
    protected function getCurlOpt($nameOpt)
    {
        if ($nameOpt !== 'userAgent' && $nameOpt !== 'header') {
                return false;
        }
        return $this->curlOpt[$nameOpt];
    }

    public function loadUsingCurl($url)
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getCurlOpt('header'));
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->getCurlOpt('userAgent'));
        
        $this->_data = curl_exec($ch);
        
        if (curl_exec($ch) === false) {
                throw new \Exception(curl_errno($ch) . ': ' . curl_error($ch));
        }
        curl_close($ch);

        Yii::info(Yii::t('app', 'Loading data page'));

        return $this;
    }

    public function createDomDocument()
    {
            $this->_dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            if ($this->_dom->loadHTML($this->_data)) {
                    Yii::info(Yii::t('app', 'Create DomDocument'));
            } else {
                    Yii::info(Yii::t('app', 'An error occurred when creating an object of class DOMDocument'));
            }
            libxml_use_internal_errors(false);

            return $this;
    }    
    
    public function createDomXpath()
    {
            $this->_xpath = new \DOMXPath($this->_dom);

            Yii::info(Yii::t('app', 'Create DomXpath'));

            return $this;
    }

    
    
}
