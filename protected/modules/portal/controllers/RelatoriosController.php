<?php

class RelatoriosController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $result="";
            
            $this->pageTitle=t('Gerar Relatório');
            
            $model=null;
            $series=array();
            
            if(isset($_GET['type']) && isset($_GET['id']))
            {
                if($_GET['type']=='equip')
                    $model= Equipamento::model ()->find ('ID_EQUIP=:id', array('id'=>$_GET['id']));
                else if($_GET['type']=='sensor')
                    $model= Sensor::model ()->find ('ID_SENSOR=:id', array('id'=>$_GET['id']));
            }
                        
            $model_form=new relatorioForm;
            if(isset($_POST['relatorioForm'])){
                $model_form->attributes=$_POST['relatorioForm'];
                
                if($model_form->validate()){

                    $series=$this->getSeries($model_form);
                }
            }
            
            if(isset($_POST['ajax']))
                $this->widget('application.modules.portal.widgets.sidebarSensoresWidget',array('type'=>'relatorios'));
            else
                $this->render('index',array('model' =>$model,
                                            'model_form' =>$model_form,
                                            'result' =>$result,
                                            'series' =>$series));

        }

        private function getSeries($model_form,$return=0)
        {
            $result['series']=array();
            $result['plotbands']=array();
            $sensores=array();
            
            if($_GET['type']=='sensor'){
                $sensores= Sensor::model()->findAll('ID_SENSOR=:id',array('id'=>$_GET['id']));
            }elseif($_GET['type']=='equip'){
                $sensores= Sensor::model()->findAll('ID_EQUIP=:id',array('id'=>$_GET['id']));
            }
            
            foreach ($sensores as $sensor) {
                
                $data_inicio=date("Y-m-d",strtotime($model_form->DATA_INICIO));
                $data_fim=date("Y-m-d",strtotime($model_form->DATA_FIM));
                $metricas= Metrica::model()->findAll('DATA_REGISTO > :data_inicio and DATA_REGISTO < :data_fim and ID_SENSOR=:id', 
                                                    array('data_inicio'=>$data_inicio,
                                                          'data_fim'=>$data_fim,
                                                          'id'=>$sensor->ID_SENSOR));

                $data=array();
                foreach ($metricas as $metrica) {

                    if($return==0)
                        array_push($data, array(strtotime($metrica->DATA_REGISTO)* 1000,(int)$metrica->VMEDIO));
                    else if($return==1)
                        array_push($data, array('DATA'=>date("d-m-Y",strtotime($metrica->DATA_REGISTO)),
                                                'HORA'=>date("H:i",strtotime($metrica->DATA_REGISTO)),
                                                'MEDIA'=>$metrica->VMEDIO,
                                                'MIN'=>$metrica->VMIN,
                                                'MAX'=>$metrica->VMAX));

                }
                
                 array_push($result['series'],array('name'=> $sensor->IDENTIFICACAO,'data'=>$data));
                 array_push($result['plotbands'],array('from'=>$sensor->VMIN,'to'=>$sensor->VMAX,'color'=>'rgba(68, 170, 213, 0.1)'));
            }
                        
            return $result;
            
        }
        
        public function actionDoc()
        {
            
            if(isset($_GET['type']) && isset($_GET['id']))
            {
                if($_GET['type']=='equip')
                    $model= Equipamento::model ()->find ('ID_EQUIP=:id', array('id'=>$_GET['id']));
                else if($_GET['type']=='sensor')
                    $model= Sensor::model ()->find ('ID_SENSOR=:id', array('id'=>$_GET['id']));

            
                $model_form=new relatorioForm;
                if(isset($_POST['relatorioForm'])){
                    $model_form->attributes=$_POST['relatorioForm'];

                    if($model_form->validate()){
                        
                        $series=$this->getSeries($model_form,1);
                        
                        # mPDF
                        $mPDF1 = Yii::app()->ePdf->mpdf();

                        # You can easily override default constructor's params
                        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

                        $mPDF1->SetFooter('|Página {PAGENO}/{nb}|');

                        if($_GET['type']=='sensor'){
                            $mPDF1->WriteHTML($this->renderPartial('doc_sensor', array('model'=>$model,'series'=>$series), true));
                        } elseif($_GET['type']=='equip'){

                        }

                        # Outputs ready PDF
                        $mPDF1->Output();

                    }
                    else{
                        $this->render('index',array('model'=>$model,
                                                    'model_form'=>$model_form,
                                                    'series'=>array()));
                    }
                }
            }
            
        }

}