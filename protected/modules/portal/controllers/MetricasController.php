<?php

class MetricasController extends Controller
{
                
        public function actionIndex($id)
        {
            
            // The x value is the current JavaScript time, which is the Unix time multiplied by 1000.
            $x = time() * 1000;
            $model=$this->loadSensor($id);
            
            if($model->checkConection())
            {
                $y=$model->getMetricasInst();
                
                // Create a PHP array and echo it as JSON
                $ret = array($x, $y);
            }else
                $ret="false";
            

            $this->renderPartial('index',array('ret'=>$ret));
        }
                
        public function actionEquip($id)
        {
            $model= $this->loadEquipamento($id);
            $x = time() * 1000;
            
            $ret['POINTS']=array();
            foreach ($model->SENSORES as $sens){
                
                if($sens->getMetricasInst())
                    $y=$sens->getMetricasInst();
                else
                    $y=0;
            
                array_push($ret['POINTS'], array($x, $y));
            }
            
            $point_null=0;
            foreach ($ret['POINTS'] as $point)
                if($point[1]==0)$point_null++;
            
            if($point_null== count($ret['POINTS']))
                $ret="false";
            
            $this->renderPartial('index',array('ret'=>$ret));
        }
                
        public function loadEquipamento($id)
	{
		$model= Equipamento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
	}
        
        public function loadSensor($id)
        {
                $model= Sensor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
        }
        
        
}