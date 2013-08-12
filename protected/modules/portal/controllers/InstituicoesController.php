<?php

class InstituicoesController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Listagem de Instituições');
            
            $model =new Instituicao;
            $user_model=  Utilizador::model()->find('ID_USER=:id', array('id'=>user()->getId()));
            $model->ID_ENT= $user_model->ID_ENT;
            
            if(isset($_GET['Instituicao'])) {
                $model->attributes=$_GET['Instituicao'];
            } 
            
            $provider=$model->search();
            
            $this->render('index',array(
                'model'=>$model,
                'dataProvider'=>$provider,
            ));
        }
        
        public function actionCreate()
        {
            $this->pageTitle=t('Adicionar Nova Instituição');
            
            $model=new Instituicao;
            
            if(isset($_GET['id']))
                $model->ID_ENT=$_GET['id'];
            
            $this->gravaRegisto($model);
            
            $this->render('create',array('model'=>$model));
        }
        
        public function actionUpdate($id)
        {
            
            $model=$this->loadModel($id);
            $this->gravaRegisto($model);
            
            $this->pageTitle=$model->IDENTIFICACAO;
            
            $model_2 =new Compartimento;
            $model_2->ID_INST=$model->ID_INST;
            if(isset($_GET['Compartimento'])) {
                $model_2->attributes=$_GET['Compartimento'];
            } 
            
            $provider=$model_2->search();
            
            $this->render('create',array('model'=>$model,
                                  'dataProvider'=>$provider));
            
        }
        
        public function actionGravaCompartimento()
        {
            if($_POST['Compartimento']['ID_COMP']==-1)
                $model=new Compartimento;
            else
                $model=$this->loadCompartimento($_POST['Compartimento']['ID_COMP']);
            
            if(isset($_POST['Compartimento']))
            {
                $model->attributes=$_POST['Compartimento'];
                $model->save();
            }
        }
        
        public function actionNomeCompartimento()
        {
            if(isset($_POST['ID_COMP']))
            {
                $model=$this->loadCompartimento($_POST['ID_COMP']);
                
                echo $model->IDENTIFICACAO;
            }
        }
        
        private function gravaRegisto($model)
        {
            if(isset($_POST['Instituicao']))
            {
                $model->attributes=$_POST['Instituicao'];
                
                if($model->validate()){

                    if($model->isNewRecord)
                        $message=t('Instituição registada com sucesso.');
                    else
                        $message=t('Instituição alterada com sucesso.');
                    
                    $model->save();
                    
                    Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.$message);

                    $this->redirect($this->createUrl('/portal/'.$this->id.'/update/id/'.$model->primaryKey));
                }
            }
        }
        
        public function loadModel($id)
	{
		$model= Instituicao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
	}
        
        public function loadCompartimento($id)
	{
		$model= Compartimento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
	}
        
        public function actionDeleteCompartimento($id)
        {
            if(Yii::app()->request->isPostRequest)
		{
			$model=$this->loadCompartimento($id);
                        
                        $model->delete();
                        
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array());
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
                            'actions'=>array('create',
                                             'update',
                                             'GravaCompartimento',
                                             'NomeCompartimento',
                                             'DeleteCompartimento'),
                            'expression'=>'(havePermission($user->rule))'
                        ),
                        array('allow',
                            'actions'=>array('index',),
                            'users'=>array('*'),
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
        
}