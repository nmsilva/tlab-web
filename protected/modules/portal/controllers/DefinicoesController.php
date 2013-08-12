<?php

class DefinicoesController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Definições Gerais - tLab');
            
            
            if(isset($_GET['id']))
                $model=  Unidade::model()->findByPk($_GET['id']);
            else
                $model=new Unidade;
            
            $this->registaUnidade($model);
            
            $model_2 =new Unidade;
            if(isset($_GET['Unidade'])) {
                $model_2->attributes=$_GET['Unidade'];
            } 
            
            $provider=$model_2->search();
            
            
            $this->render('index',array('model'=>$model,
                                        'dataProvider'=>$provider));
        }
        
        private function registaUnidade($model){
            
            if(isset($_POST['Unidade']))
            {
                $model->attributes=$_POST['Unidade'];
                
                if($model->validate()){
                    
                    if($model->isNewRecord)
                        $message=t('Unidade registada com sucesso.');
                    else
                        $message=t('Unidade alterada com sucesso.');
                    
                    $model->save();
                    
                    Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.$message);

                    $this->redirect($this->createUrl('/portal/'.$this->id.'/index/'));
                    
                }
            }
        }
}