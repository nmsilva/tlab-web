<?php
class graficoSensoresWidget extends CWidget {
 
    public $type;
    public $model;
    
    public function run() {
                
        if($this->model && $this->type){
            if($this->type=='sensor'){
                
                $this->render('graficoSensor');
            }else if($this->type=='equipamento'){

                $sensores=array();
                foreach ($this->model->SENSORES as $sens){
                    $sensor=array('name' => $sens->IDENTIFICACAO, 
                                  'data' => array('0','0','0','0','0','0','0'));
                    array_push($sensores,$sensor);
                }
                
                $this->render('graficoEquipamento',array('sensores'=>$sensores));
            }
        }
        else
            throw new CHttpException(500,t('Faltam parametros para o widget.'));
        
        
        
        
    }
 
}