<?php

class UtilizadoresController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Listagem de Utilizadores');
            
            $model =new Utilizador;

            if(isset($_GET['Utilizador'])) {
                $model->attributes=$_GET['Utilizador'];
            } 
            
            $provider=$model->search();
            
            $this->render('index',array(
                'model'=>$model,
                'dataProvider'=>$provider,
            ));
            
        }
        
        public function actionCreate()
        {
            $this->pageTitle=t('Criar Nova Conta');
            
            $model=new Utilizador;
            
            $this->gravaRegisto($model);
            
            $this->render('create',array('model'=>$model));
        }
        
        private function gravaRegisto($model)
        {
            
            if(isset($_POST['Utilizador']))
            {
                $model->attributes=$_POST['Utilizador'];
                
                if($model->validate()){
                    
                    if($model->ID_TIPO!=3)
                        $model->ID_ENT=NULL;
                    
                    if($model->isNewRecord)
                        $message=t('Utilizador registado com sucesso.');
                    else
                        $message=t('Utilizador alterado com sucesso.');
                    
                    $model->save();

                    Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.$message);

                    if($model->isNewRecord)
                        $this->redirect($this->createUrl('/portal/'.$this->id.'/index'));
                    else
                        $this->refresh();
                }
            }
        }
        
        public function actionUpdate($id)
        {
            $this->pageTitle=t('Editar Conta de Utilizador');
            
            $model=$this->loadModel($id);
            
            $this->gravaRegisto($model);
            
            $this->render('create',array('model'=>$model));
        }

	private function loadModel($id)
        {
            $model= Utilizador::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
            
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
                        array('allow',
                            'actions'=>array('index',
                                             'create',
                                             'update', ),
                            'expression'=>'(havePermission($user->rule))'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
}