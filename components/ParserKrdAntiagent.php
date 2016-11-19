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
    private $_items = [];
    
    /**
     * @var string хост
     */
    public $host;
    
    /**
     * @var string link
     */
    public $link;
    
    /**
     * @var string page_prefix
     */
    public $page_prefix = '&page=';
    
    /**
     * @var string current_page
     */
    public $current_page = 1;
    
    /**
     * @var string current_page
     */
    public $last_page = 1;
    
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

    /*
     * @param integer $page
     */
    protected function getPageUrl($page=1)
    {
        if ($page > $this->last_page) {
            $this->current_page = $this->last_page;
        } else if ($page < 1) {
            $this->current_page = 1;
        } else {
            $this->current_page = $page;
        }
        
	return $this->host . $this->link . ($this->current_page > 1 ? $this->page_prefix . $this->current_page : '');
    }

    public function loadUsingCurl($url=NULL)
    {
        $ch = curl_init();
        
        if ($url === NULL) $url = $this->getpageUrl();
        
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

        Yii::info(Yii::t('app', 'Loading data page') . ' ' . $url, 'parserInfo');

        return $this;
    }

    public function createDomDocument()
    {
        $this->_dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        if ($this->_dom->loadHTML($this->_data)) {
                Yii::info(Yii::t('app', 'Create DomDocument'), 'parserInfo');
        } else {
                Yii::info(Yii::t('app', 'An error occurred when creating an object of class DOMDocument'), 'parserInfo');
        }
        libxml_use_internal_errors(false);

        return $this;
    }    
    
    public function createDomXpath()
    {
        $this->_xpath = new \DOMXPath($this->_dom);

        Yii::info(Yii::t('app', 'Create DomXpath'), 'parserInfo');

        return $this;
    }

    /**
     * @return \app\components\ParserKrdAntiagent
     */
    public function endParse()
    {
        //if (isset($this->_content)) {
        if (count($this->_items) > 0) {
                Yii::info(Yii::t('app', 'End parse'), 'parserInfo');
        } else {
                Yii::info(Yii::t('app', 'Some data were not received'), 'parserInfo');
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

    /**
     * Парсинг необходимого количества страниц
     * @param type $start_page - стартовая страница
     * @param type $pages - количество страниц:
     *    0 - одна страница, 
     *   >0 - количество страниц вправо, начиная с заданной
     *   <0 - количество страниц влево, начиная с заданной
     */
    public function parseAdsPages($start_page=1, $pages=0)
    {
        if ($start_page == 0) $start_page = 1;
        
        // Найдем номер последней страницы
        $xpathQuery = "//div[@class='b-pager__pages']//a[@class='b-pager__page' and position()=last()]";
	$nodes = $this->_xpath->query($xpathQuery, $this->_dom);
	if ($nodes->length === 0) {
            Yii::info(Yii::t('app', 'Error parse last page number'), 'parserInfo');
            return $this;
	}
        
        $this->last_page = (int)$nodes->item(0)->nodeValue;
        //echo 'last_page = ' . $this->last_page . PHP_EOL;
        Yii::info(Yii::t('app', 'Last page') . '=' . $this->last_page, 'parserInfo');

        if (($start_page == 1) && ((int)$pages < 0)) $start_page = $this->last_page;
        
        $page_count = abs((int)$pages);
        $pages_num = [(int)$start_page];
        
        echo '$start_page=' . $start_page . PHP_EOL;
        echo '$pages=' . $pages . PHP_EOL;
        echo '$page_count=' . $page_count . PHP_EOL;
        
        if ($page_count !== 0) {
            for($i=1;$i<$page_count;$i++) {
                // Номер следующей страницы
                $page_num = (int)$pages > 0 ? (int)$start_page + $i : (int)$start_page - $i;
                //echo '$page_num=' . $page_num . PHP_EOL;
                
                // Проверка достижения конца блока страниц с любой из сторон
                if (($page_num == 0) || ($page_num > $this->last_page)) {
                    break;
                } else {
                    $pages_num[] = $page_num;
                }
            }
        }
        
        print_r($pages_num);
        
        for($i=0;$i<count($pages_num);$i++) {
            $url = $this->getPageUrl($pages_num[$i]);
            
            Yii::info(Yii::t('app', 'Parse pages') . ' ' . $pages_num[$i] . ', url=' . $url, 'parserInfo');
            
            $this->loadUsingCurl($url)
                ->createDomDocument()
                ->createDomXpath()
                ->parseAdsInPage()
                ->parseAdsItemsPage();
        }

	Yii::info(Yii::t('app', 'Parse pages completed'), 'parserInfo');

	return $this;        
    }
    
    public function parseAdsInPage()
    {
	//$this->_items = [];
        
        $xpathQuery = "//div[@class='b-serp-item b-ugc-item']";
	$nodes = $this->_xpath->query($xpathQuery, $this->_dom);
	if ($nodes->length === 0) {
		Yii::info(Yii::t('app', 'Error parse content'), 'parserInfo');
		return $this;
	}

        $num = 0;
        foreach($nodes as $node) {
            $id = $node->getAttribute('id');
            $nodes1 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__price']//span[@class='b-serp-item__amount']", $this->_dom);
            $nodes2 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__price']//a//img//@src", $this->_dom);
            $nodes3 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__header']//a[@class='b-link b-link_redir_yes b-serp-item__offer-link']", $this->_dom);
            $nodes4 = $this->_xpath->query("//div[@id='$id']//div[@class='b-serp-item__address']//div[@class='b-serp-item__address-text']", $this->_dom);
            $nodes5 = $this->_xpath->query("//div[@id='$id']//span[@class='b-serp-item__owner']", $this->_dom);
            
            $this->_items[] = [
                'ads_id' => $id,
                'ads_price' => (int)str_replace(' ', '', $nodes1->item(0)->nodeValue),
                'ads_img_link' => $nodes2->item(0)->nodeValue,
                'ads_header' => $nodes3->item(0)->nodeValue,
                'ads_link' => $nodes3->item(0)->getAttribute('href'),
                'ads_text' => $nodes4->item(0)->nodeValue,
                'ads_owner' => explode(':', explode(',', $nodes5->item(0)->nodeValue)[0])[1],
            ];
        }
        
        //print_r($this->_items);
        
        //$this->_content = $nodes->item(0)->nodeValue;

	Yii::info(Yii::t('app', 'Parse ads in page') . ', pagenum = ' . $this->current_page, 'parserInfo');

	return $this;        
    }

    public function parseAdsItemsPage()
    {
        // Пробежимся по каждому объявлению
        foreach ($this->_items as $key => $value) {
            //echo $value['ads_link'] . PHP_EOL;
            
            // Если нет ссылки - проходим мимо
            if (($value['ads_link'] === NULL) || ($value['ads_link'] == '')) {
                continue;
            }
            
            // Получаем страницу конкретного объявления
            $this->loadUsingCurl($value['ads_link'])
                ->createDomDocument()
                ->createDomXpath();
            
            $xpathQuery = "//div[@class='b-card__content']//div";
            $nodes = $this->_xpath->query($xpathQuery, $this->_dom);
            
            //echo '$nodes->length = ' . $nodes->length . PHP_EOL;
            
            if ($nodes->length === 0) {
                Yii::info(Yii::t('app', 'Error parse content page') . ' '.$value['ads_link'], 'parserInfo');
                continue;
            }

            Yii::info(Yii::t('app', 'Parse content page') . ' '.$value['ads_link'], 'parserInfo');
            
            foreach ($nodes as $node) {
                $s = explode(':', $node->nodeValue);
                
                //echo $s[1] . PHP_EOL;
                
                if (strpos($node->nodeValue, 'Цена:') !== FALSE) $this->_items[$key]['ads_option_price'] = str_replace(' ', '', substr(trim($s[1]), 0, strpos(trim($s[1]), ' руб.')));
                if (strpos($node->nodeValue, 'Продавец:') !== FALSE) $this->_items[$key]['ads_option_owner'] = trim($s[1]);
                /*if (strpos($node->nodeValue, 'Телефон:') !== FALSE) {
                        $s = explode(',', $node->nodeValue);
                        $s1 = explode(':', $s[0]);
                        $this->_items[$key]['ads_option_owner_phone'] = trim($s1[1]);
                        
                        if (isset($s[1]) && (trim($s[1]) !== '')) {
                            $s1 = explode(':', $s[1]);
                            $this->_items[$key]['ads_option_owner_email'] = trim($s1[1]);
                        }
                }*/
                //if (strpos($node->nodeValue, 'Размещено') !== FALSE) $this->_items[$key]['ads_option_dt_create'] = trim(substr($node->nodeValue, strpos($node->nodeValue, 'Размещено'), 9));
                //if (strpos($node->nodeValue, 'обновлено') !== FALSE) $this->_items[$key]['ads_option_dt_last_update'] = trim(substr($node->nodeValue, strpos($node->nodeValue, 'обновлено'), 9));
                //if (strpos($node->nodeValue, 'просмотров:') !== FALSE) $this->_items[$key]['ads_option_views'] = trim($s[1]);
                if (strpos($node->nodeValue, 'Район:') !== FALSE) $this->_items[$key]['ads_option_district'] = trim($s[1]);
                if (strpos($node->nodeValue, 'Адрес:') !== FALSE) $this->_items[$key]['ads_option_address'] = trim($s[1]);
                if (strpos($node->nodeValue, 'Площадь:') !== FALSE) $this->_items[$key]['ads_option_apartment_area'] = trim($s[1]);
                if (strpos($node->nodeValue, 'Этаж:') !== FALSE) $this->_items[$key]['ads_option_floor'] = trim($s[1]);
                if (strpos($node->nodeValue, 'Материал стен:') !== FALSE) $this->_items[$key]['ads_option_wall_material'] = trim($s[1]);
                if (strpos($node->nodeValue, 'Год постройки:') !== FALSE) $this->_items[$key]['ads_option_year_built'] = trim($s[1]);
            }
        }
        
        //print_r($this->_items);
        
	Yii::info(Yii::t('app', 'Parse ads items pages completed'), 'parserInfo');

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
            $model->ads_price = $value['ads_price'] ? $value['ads_price'] : '';
            $model->ads_img_link = $value['ads_img_link'] ? $value['ads_img_link'] : '';
            $model->ads_header = $value['ads_header'] ? $value['ads_header'] : '';
            $model->ads_link = $value['ads_link'] ? $value['ads_link'] : '';
            $model->ads_text = $value['ads_text'] ? $value['ads_text'] : '';
            $model->ads_owner = $value['ads_owner'] ? $value['ads_owner'] : '';

            $model->ads_option_price = $value['ads_option_price'] ? $value['ads_option_price'] : 0;
            $model->ads_option_owner = $value['ads_option_owner'] ? $value['ads_option_owner'] : '';
            $model->ads_option_owner_phone = $value['ads_option_owner_phone'] ? $value['ads_option_owner_phone'] : '';
            $model->ads_option_owner_email = $value['ads_option_owner_email'] ? $value['ads_option_owner_email'] : '';
            $model->ads_option_dt_create = $value['ads_option_dt_create'] ? $value['ads_option_dt_create'] : '';
            $model->ads_option_dt_last_update = $value['ads_option_dt_last_update'] ? $value['ads_option_dt_last_update'] : '';
            $model->ads_option_views = $value['ads_option_views'] ? $value['ads_option_views'] : '';
            $model->ads_option_district = $value['ads_option_district'] ? $value['ads_option_district'] : '';
            $model->ads_option_address = $value['ads_option_address'] ? $value['ads_option_address'] : '';
            $model->ads_option_apartment_area = $value['ads_option_apartment_area'] ? $value['ads_option_apartment_area'] : '';
            $model->ads_option_floor = $value['ads_option_floor'] ? $value['ads_option_floor'] : '';
            $model->ads_option_wall_material = $value['ads_option_wall_material'] ? $value['ads_option_wall_material'] : '';
            $model->ads_option_year_built = $value['ads_option_year_built'] ? $value['ads_option_year_built'] : '';

            //print_r($model);
            
            $save_flag == 'update' ? $model->update() : $model->insert();
            //break;
        }
        
	Yii::info(Yii::t('app', 'Save parse item to table'), 'parserInfo');

	return $this;        
    }
    
}
