<?php
class UrlManager extends CUrlManager
{
    public function createUrl($route,$params=array(),$ampersand='&',$lang=true)
    {
        if(Yii::app()->controller)
        {
            if(Yii::app()->controller->module->id=='site' && $lang==true)
            {
                if (!isset($params['lang'])) {
                    if (Yii::app()->user->hasState('lang'))
                        Yii::app()->language = Yii::app()->user->getState('lang');
                    else if(isset(Yii::app()->request->cookies['lang']))
                        Yii::app()->language = Yii::app()->request->cookies['lang']->value;
                    $params['lang']=Yii::app()->language;
                }
            }
        }
        
        return parent::createUrl($route, $params, $ampersand);
    }
}
?>