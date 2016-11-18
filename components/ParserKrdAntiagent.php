<?php

namespace app\components;

use Yii;
use \yii\base\Object;
use app\models\AntiagentAds;

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
     * @var DOMDocument object 
     */
    private $_dom;
    
    /**
     * @var DOMXPath object 
     */
    private $_xpath;
    
    /**
     * @var string загруженные данные страницы
     */
    private $_content;
    
    /**
     * @var array
     */
    private $_items;
    
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

    /**
     * @return \app\components\ParserKrdAntiagent
     */
    public function endParse()
    {
        if (isset($this->_content)) {
                Yii::info(Yii::t('app', 'End parse'));
        } else {
                Yii::info(Yii::t('app', 'Some data were not received'));
        }

        return $this;
    }    
    
    /**
     * @return string content
     */
    public function getContent()
    {
        return $this->_content;
    }

    
    public function parseAdsInPage()
    {
	$this->_items = [];
        
        $xpathQuery = "//div[@class='b-serp-item b-ugc-item']";
	$nodes = $this->_xpath->query($xpathQuery, $this->_dom);
	if ($nodes->length === 0) {
		Yii::info(Yii::t('app', 'Error parse content'));
		return $this;
	}

        $num = 0;
        foreach($nodes as $node) {
            $id = $node->getAttribute('id');
            $nodes1 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__price']//span[@class='b-serp-item__amount']", $this->_dom);
            $nodes2 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__price']//a//img//@src", $this->_dom);
            $nodes3 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__header']//a[@class='b-link b-link_redir_yes b-serp-item__offer-link']", $this->_dom);
            $nodes4 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__address']//div[@class='b-serp-item__address-text']", $this->_dom);
            
            $this->_items[] = [
                'ads_id' => $id,
                'ads_price' => str_replace(' ', '', $nodes1->item(0)->nodeValue),
                'ads_img_link' => $nodes2->item(0)->nodeValue,
                'ads_header' => $nodes3->item(0)->nodeValue,
                'ads_link' => $nodes3->item(0)->getAttribute('href'),
                'ads_text' => $nodes4->item(0)->nodeValue,
            ];
        }
        
        print_r($this->_items);
        
        //$this->_content = $nodes->item(0)->nodeValue;

	Yii::info(Yii::t('app', 'Parse ads in page'));

	return $this;        
    }

    public function parseAdsItemsPage()
    {
        foreach ($this->_items as $key => $value) {
            // Если нет ссылки - проходим мимо
            if (($value['ads_link'] === NULL) || ($value['ads_link'] == '')) {
                continue;
            }
            
            // Получаем страницу конкретного объявления
            $this->loadUsingCurl($value['ads_link'])
                ->createDomDocument()
                ->createDomXpath();
            
            $xpathQuery = "//div[@class='b-card__content']/div/";
            $nodes = $this->_xpath->query($xpathQuery, $this->_dom);
            if ($nodes->length === 0) {
                Yii::info(Yii::t('app', 'Error parse content page '.$value['ads_link']));
                continue;
            }
            
        }
        
	Yii::info(Yii::t('app', 'Parse ads items page'));

	return $this;        
        
    }
    
    public function saveAdsItemsToTable()
    {
        foreach ($this->_items as $key => $value) {
            if (($model = AntiagentAds::findOne($value['ads_id'])) !== null) {
                $save_flag = 'update';
            } else {
                $save_flag = 'insert';
                $model = new AntiagentAds();
            }
            
            $model->id = $value['ads_id'];
            $model->ads_id = $value['ads_id'];
            $model->ads_price = $value['ads_price'];
            $model->ads_img_link = $value['ads_img_link'];
            $model->ads_header = $value['ads_header'];
            $model->ads_link = $value['ads_link'];
            $model->ads_text = $value['ads_text'];
            
            $save_flag == 'update' ? $model->update() : $model->insert();
        }
        
	Yii::info(Yii::t('app', 'Save parse item to table'));

	return $this;        
    }
    
}
