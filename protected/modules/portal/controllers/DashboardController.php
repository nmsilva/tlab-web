<?php

class DashboardController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $stats=array();
            $this->pageTitle=t('Dashboard');
            
            $stats['entidades']= count(Entidade::model()->findAll());
            $stats['instituicoes']= count(Instituicao::model()->findAll());
            $stats['compartimentos']= count(Compartimento::model()->findAll());
            $stats['equipamentos']= count(Equipamento::model()->findAll());
            $stats['sensores']= count(Sensor::model()->findAll());
            $stats['utilizadores']= count(Utilizador::model()->findAll());
            
            $this->render('index',array('stats'=>$stats));
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
        
        public function actionLogout()
        {
             Yii::app()->user->logout(false);
             $this->redirect(Yii::app()->user->loginUrl);
        }

}