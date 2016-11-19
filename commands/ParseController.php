<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParseController extends \yii\console\Controller
{
    // Номер стартовой страницы
    public $start_page = 1;
    // Количество обрабатываемых страниц
    public $pages = 0;
    // Признак предварительной очистки таблицы с результатами
    public $clear_table = 0;
    
    /**
     * 
     * @param type $actionID
     * @return string
     */
    public function options($actionID)
    {
        $options = parent::options($actionID);
        if($actionID == 'index'){
            $options[] = 'start_page';
            $options[] = 'pages';
            $options[] = 'clear_table';
        }
        return $options;
    }    
    
    /**
     * 
     * @param integer $start_page
     * @param integer $pages
     * @param integer $clear_table
     */
    public function actionIndex() 
    {
        /*var_dump($this->start_page);
        var_dump($this->pages);
        var_dump($this->clear_table);*/
        
        if ($this->clear_table == 1) {
            \Yii::$app->db->createCommand()->truncateTable('{{%antiagent_ads}}')->execute();
        }
        
        $dataParse = \Yii::$app->parser->loadUsingCurl()
            ->createDomDocument()
            ->createDomXpath()
            ->parseAdsPages($this->start_page, $this->pages)
            //->parseAdsInPage()
            //->parseAdsItemsPage()
            //->saveAdsItemsToTable()
            ->endParse();
        
        //return $this->render('index', ['data' => $dataParse]);                
                
        //echo var_dump($dataParse);
        //echo $dataParse->getContent();
    }
}
