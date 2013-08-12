<?php

class DashboardController extends Controller
{
    public function actionIndex()
    {   
            $this->pageTitle=t("Gestor de Conteúdos - ".Opcoes::model()->getSEOProperty('title',Yii::app()->language));
            
            Yii::app()->counter->refresh();
            
            $this->render('index');
    }

    public function actionLogout() {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->user->loginUrl);
    }

    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
 
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny'),
        );
    }
}