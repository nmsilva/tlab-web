<?php

class CacheController extends Controller
{
	public function actionIndex()
	{
                $this->pageTitle=t("Cache");
                
		$this->render('index');
	}
        
        public function actionClear($cache_id="")
        {
                $cache_id=isset($_GET['cache_id']) ? strtolower($_GET['cache_id']) : '';
		if($cache_id){
			switch ($cache_id) {
				case 'assets':	
					$this->clearCacheAssets();		
					user()->setFlash('success',t('Directório de Assets Limpo!'));		
					break;
				case 'cache':	
					if($this->clearCache())		
						user()->setFlash('success',t('Cache Limpa!'));
					else 
						user()->setFlash('error',t('Ocorreu um Erro ao Limpar a Cache!'));	
					break;					
				default:					
					break;
			}
			Yii::app()->controller->redirect(array('/cms/cache'));
		}      
                
        }
        
        public function clearCache(){

            if(Yii::app()->cache)
                Yii::app()->cache->flush();
            return true;

	}
	
	public function clearCacheAssets(){
	
                $get_sub_folders=get_subfolders_name(ASSETS_FOLDER);
                foreach($get_sub_folders as $folder){
                        recursive_remove_directory(ASSETS_FOLDER.DIRECTORY_SEPARATOR.$folder);
                }			

		
		return;
	}
        
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','clear'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}