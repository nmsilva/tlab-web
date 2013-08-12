<?php

class EquipamentosController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Listagem de Equipamentos');

        }
        
        public function actionUpdate($id)
        {
            $this->pageTitle=t('Editar Equipamento');
            
            $model=$this->loadModel($id);
            
            if(isset($_POST['Equipamento']))
            {
                $model->attributes=$_POST['Equipamento'];
                $model->ID_COMP=$model->ID_COMP[0];
                
                if($model->validate()){

                    $message=t('Equipamento alterado com sucesso.');
                    
                    $model->save();
                    
                    Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.$message);

                    $this->redirect($this->createUrl('/portal/'.$this->id.'/update/id/'.$model->primaryKey));
                }
            }
                        
            $this->render('update',array('model'=>$model));
        }
        
        public function actionDelete($id)
        {
            if(isset($_GET['confirm']))
            {
                // apaga equipamento
                
            }
        }
        
        public function loadModel($id)
	{
		$model= Equipamento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
	}
        
        
}