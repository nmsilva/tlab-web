<?php

class PortalModule extends CWebModule
{
        private $_assetsUrl;
        public $values;
        
	public function init()
	{
                // import the module-level models and components
		$this->setImport(array(
			'portal.models.*',
                        'portal.models.forms.*',
			'portal.components.*',
		));
                
                Yii::app()->session['translate'] = 'portal';
                
                if(user()->isGuest or user()->type != PORTAL_STATE)
                        user()->loginRequired(); 
                
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		
		$this->layoutPath="protected/modules/portal/views/layouts";
                
                $this->layout="main";
                
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

	 // getAssetsUrl()
    //    return the URL for this module's assets, performing the publish operation
    //    the first time, and caching the result for subsequent use.
 
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.portal.assets') );
        return $this->_assetsUrl;
    }
}
