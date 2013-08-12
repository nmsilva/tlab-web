<?php

class OpcoesController extends Controller
{
	public function actionIndex()
	{
                $this->pageTitle=t("Opções");
                
                if($_POST)
                {
                    
                    foreach ($_POST['opcoes'] as $key => $value) {
                        
                        $model= Opcoes::model()->find('KEY_OPCAO=:key',array('key'=>$key));
                        
                        if(!$model){
                            $model= new Opcoes;
                            $model->KEY_OPCAO=$key;
                        }
                        
                        $model->VALUE_OPCAO=$value;
                        $model->save();
                        
                    }
                    
                    $this->refresh();
                }
                
		$this->render('index');
	}
        
        public function actionSeo()
        {
            if($_POST)
            {
                
                $this->renderPartial('_seo_opcoes',array('lang'=>$_POST['SHORT']));
            }
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
				'actions'=>array('index','seo'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}