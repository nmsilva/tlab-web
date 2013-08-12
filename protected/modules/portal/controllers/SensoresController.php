<?php

class SensoresController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            
            $model=NULL;        
            
            if($_POST)
                $this->widget('application.modules.portal.widgets.sidebarSensoresWidget');
            else{
                
                $render="";
                $crumb="";
                $buttons=array();
                if(isset($_GET['type']) && isset($_GET['id']))
                {
                    if($_GET['type']=='equip'){
                        $model= Equipamento::model ()->find ('ID_EQUIP=:id', array('id'=>$_GET['id']));
                        $render="equipamento";
                        $crumb=t('Equipamentos');
                    }
                    else if($_GET['type']=='sensor'){
                        $model= Sensor::model ()->find ('ID_SENSOR=:id', array('id'=>$_GET['id']));
                        $render="sensor";
                    }
                    
                    $this->pageTitle=$model->IDENTIFICACAO;
                    $this->breadcrumbs=array(t('Dashboard')=>$this->createUrl('/portal/'),
                                             $model->COMPARTIMENTO->INSTITUICAO->ENTIDADE->NOME,
                                             $model->COMPARTIMENTO->INSTITUICAO->IDENTIFICACAO,
                                             $model->COMPARTIMENTO->IDENTIFICACAO,
                                             $this->pageTitle);
                    
                    $buttons=$this->getButtons($model,$_GET['type']);
                    
                }
                else{
                    $this->pageTitle=t('Listagem de Sensores');
                    $this->breadcrumbs=array(t('Dashboard')=>$this->createUrl('/portal/'),$this->pageTitle);
                }
                
                
                $this->render('index',array('model'=>$model,'render'=>$render,'buttons'=>$buttons));
            }
            
            
        }
        
        private function getButtons($model,$type,$return=false)
        {
            if($type=='equip'){
                $links[0]=$this->createUrl('/portal/equipamentos/delete/id/'.$model->ID_EQUIP.'/confirm');
                $links[1]=$this->createUrl('/portal/equipamentos/update/id/'.$model->ID_EQUIP);
                $links[2]=$this->createUrl('/portal/sensores/erros/type/equip/id/'.$model->ID_EQUIP);
                $links[3]=$this->createUrl('/portal/relatorios/index/type/equip/id/'.$model->ID_EQUIP);
                $links[4]=$this->createUrl('/portal/sensores/index/type/equip/id/'.$model->ID_EQUIP);
            }
            else if($type=='sensor'){
                $links[0]=$this->createUrl('/portal/sensores/delete/id/'.$model->ID_SENSOR.'/confirm');
                $links[1]=$this->createUrl('/portal/sensores/update/id/'.$model->ID_SENSOR);
                $links[2]=$this->createUrl('/portal/sensores/erros/type/sensor/id/'.$model->ID_SENSOR);
                $links[3]=$this->createUrl('/portal/relatorios/index/type/sensor/id/'.$model->ID_SENSOR);
                $links[4]=$this->createUrl('/portal/sensores/index/type/sensor/id/'.$model->ID_SENSOR);
            }
            $first=null;
            if($return)
                $first=array('label'=>t('Voltar'), 'url'=>$links[4]);
            
                    
            return array(
                    array('label' => t('Opções'), 'url' => '#'), 
                    array('items' => array(
                            $first,
                            array('label'=>t('Editar'), 'url'=>$links[1]),
                            array('label'=>t('Apagar'), 
                                  'url' => '#',
                                  'linkOptions'=>array('onclick'=>'js:bootbox.confirm("Confirma a eliminação deste item?",
                                                     function(confirmed){ if(confirmed) window.location = "'.$links[0].'"; })')),
                            '---',
                            array('label' => t('Consultar Erros'), 'url' => $links[2]),
                            array('label' => t('Gerar Relatório'), 'url' => $links[3]),
                    ))
            );
        }
        
        public function actionErros($id)
        {
            $this->pageTitle=t('Erros');
            
            if(isset($_GET['type']))
            {
                $columns=array();
                if($_GET['type']=='equip'){
                    
                    $model= Equipamento::model()->findByPk($id);

                    $model_2=new Erro;
                    if(isset($_GET['Erro'])) {
                        $model_2->attributes=$_GET['Erro'];
                    } 
                    
                    $model_2->TIPO=1;
                    
                   
                    $criteria=new CDbCriteria;

                    $criteria->compare('TIPO',$model_2->TIPO,true);
                    
                    $values=array();
                    foreach ($model->SENSORES as $sensor) {
                        array_push($values, $sensor->ID_SENSOR);
                    }
                    
                    $criteria->addInCondition('ID_SENSOR', $values);
                    
                    $provider= new CActiveDataProvider($model_2, array(
                            'criteria'=>$criteria,
                    ));
                    
                    $columns=array(
                        array('name'=>'ID_ERRO',
                              'type'=>'raw',
                              'value'=>'$data->ID_ERRO',
                            ),
                        array('name'=>'ID_SENSOR',
                              'type'=>'raw',
                              'value'=>'$data->SENSOR->IDENTIFICACAO',
                            ),
                        array('name'=>'DATA',
                              'type'=>'raw',
                              'value'=>'$data->DATA',
                            ),
                        array('name'=>'IDENTIFICACAO',
                              'type'=>'raw',
                              'value'=>'$data->IDENTIFICACAO',
                            ),
                        array('name'=>'DATA_VISUALIZACAO',
                              'type'=>'raw',
                              'value'=>'$data->DATA_VISUALIZACAO',
                            ),
                    );
                    
                }else if($_GET['type']=='sensor'){
                    
                    $model = Sensor::model()->findByPk($id);

                    $model_2=new Erro;
                    if(isset($_GET['Erro'])) {
                        $model_2->attributes=$_GET['Erro'];
                    } 
                    
                    $model_2->TIPO=1;
                    $model_2->ID_SENSOR=$id;
                    $provider=$model_2->search();
                    
                    $columns=array(
                        array('name'=>'ID_ERRO',
                              'type'=>'raw',
                              'value'=>'$data->ID_ERRO',
                            ),
                        array('name'=>'DATA',
                              'type'=>'raw',
                              'value'=>'$data->DATA',
                            ),
                        array('name'=>'IDENTIFICACAO',
                              'type'=>'raw',
                              'value'=>'$data->IDENTIFICACAO',
                            ),
                        array('name'=>'DATA_VISUALIZACAO',
                              'type'=>'raw',
                              'value'=>'$data->DATA_VISUALIZACAO',
                            ),
                    );
                }
                
                $buttons=$this->getButtons($model,$_GET['type'],true);
                
                $this->render('erros',array('dataProvider'=>$provider,'buttons'=>$buttons,'columns'=>$columns));
            }
        }
        
        public function actionUpdate($id)
        {
            $model=$this->loadModel($id);
            
            $this->pageTitle=$model->IDENTIFICACAO;
            
            if(isset($_POST['Sensor']))
            {
                $model->attributes=$_POST['Sensor'];
                $model->ID_COMP=$model->ID_COMP[0];
                
                if($model->validate()){

                    $message=t('Sensor alterado com sucesso.');
                    
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
                // apaga sensor
            }
        }
        
        public function loadModel($id)
	{
		$model= Sensor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
	}
                
        
}