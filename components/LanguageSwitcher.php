<?php
/*
author :: Pitt Phunsanit
website :: http://plusmagi.com
change language by get language=EN, language=TH,...
or select on this widget
*/
 
namespace app\components;
 
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Cookie;
 
class LanguageSwitcher extends Widget
{
    public $languages = [
        'ru-RU' => 'RU',
        'en-EN' => 'EN'
    ];
 
    public function init()
    {
        if(php_sapi_name() === 'cli')
        {
            return true;
        }
 
        parent::init();
 
        $cookies = Yii::$app->response->cookies;
        $languageNew = Yii::$app->request->get('language');
        if($languageNew)
        {
            if(isset($this->languages[$languageNew]))
            {
                Yii::$app->language = $languageNew;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'language',
                    'value' => $languageNew
                ]));
            }
        }
        elseif($cookies->has('language'))
        {
            Yii::$app->language = $cookies->getValue('language');
        }
 
    }
 
    public function run(){
        $languages = $this->languages;
        $current = $languages[Yii::$app->language];
 
        $items = [];
        foreach($languages as $code => $language)
        {
            $temp = [];
            $temp['label'] = $language;
            $temp['url'] = Url::current(['language' => $code]);
            $temp['class'] = 'lang-menu-default';
            
            if($current == $language) {
            	$temp['class'] = 'lang-menu-active';
            }
            
            array_push($items, $temp);
        }
         
        $widgetStack = Html::beginTag("div", ['class' => 'language-menu']);
        foreach($items as $item) {
        	$widgetStack .= 
        	Html::a($item['label'], 
        		[$item['url']], 
        		['class'=>$item['class']]);
        }
        $widgetStack .= Html::endTag("div");

        return $widgetStack;
    }
 
}