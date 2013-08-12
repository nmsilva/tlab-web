<?php

class ContaController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Definições de Conta');
            $id_user=user()->getId();
            $model= $this->loadModel($id_user);
            
            $foto = new FotoUploadForm;
            
            if(isset($_POST['Utilizador']))
            {
                    $model->attributes=$_POST['Utilizador'];
                    if($model->validate()){
                        
                        $imagem=CUploadedFile::getInstance($foto,'file');
                        if(is_object($imagem))
                        {

                            $rnd=dechex(rand()%999999999);
                            $name=$rnd."_".$model->ID_USER;

                            if(!empty($model->IMAGEM))
                                unlink(Helper::getFotoPath()."/".$model->IMAGEM);

                            $model->IMAGEM = "{$name}.{$imagem->getExtensionName()}";  // random number + file name

                            $path=Helper::getFotoPath()."/".$model->IMAGEM;
                            $imagem->saveAs($path);

                            $resize_image = Yii::app()->image->load($path);
                            $resize_image->resize(100, 100);
                            $resize_image->save();

                        }
                            
                        $model->save();
                        user()->setState('name', $model->NOME);
                        user()->setState('email', $model->EMAIL);
                        
                        Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.t('A sua Informação foi actualizada com sucesso.'));
                        
                        $this->refresh();
                    }
            }
            
            $this->render('index',array('model'=>$model,'foto'=>$foto));
        }

        public function actionPassword()
        {
            $this->pageTitle=t('Alterar Palavra Passe');
            
            $model= new changePasswordForm;
            
            if(isset($_POST['changePasswordForm']))
            {
                    $model->attributes=$_POST['changePasswordForm'];
                    if($model->validate()){
                        
                        $model->savePassword();
                        
                        Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.t('A alteração de Palavra Passe foi concretizada com sucesso.'));
                        
                        $this->refresh();
                    }
            }
                             
            $this->render('password',array('model'=>$model));
        }
        
        public function actionEntidade()
        {
            $this->pageTitle=t('Detalhes da Entidade');
            
            $user_model= Utilizador::model()->find('ID_USER=:id', array('id'=>user()->getId()));
            $model= $this->loadEntidade($user_model->ID_ENT);

            $this->render('entidade',array('model'=>$model));
        }
        
	public function loadModel($id)
        {
            $model= Utilizador::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
            
        }
        
        public function loadEntidade($id)
        {
            $model= Entidade::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        
}