<?php

class SiteModule extends CWebModule
{
	private $_assetsUrl;

	public function init()
	{       
                Yii::app()->session['translate']="cms";
                
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

                $this->layoutPath="protected/modules/site/views/layouts";
		$this->layout="main";
                
		// import the module-level models and components
		$this->setImport(array(
			'site.models.*',
			'site.components.*',
                        // CMS Models
                        'cms.models.*',
		));
                
                
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

        public function getAssetsUrl()
        {
            if ($this->_assetsUrl === null)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.site.assets') );
            return $this->_assetsUrl;
        }
            
}
