<?php

class TesteController extends Controller
{
        
        public function actionIndex($id)
        {
//            ini_set ( 'soap.wsdl_cache_enable' , 0 ); 
//            ini_set ( 'soap.wsdl_cache_ttl' , 0 );
//            
//
//            $client = new SoapClient('http://localhost/zbit/tlab.engidom.pt/api/service/wsdl'); 
//            if($client->authorization("12568","KwEr58On"))
//            {
//                echo "entrou!!";
//            }
            
            $this->render('index',array('id_sensor'=>$id));
            
        }
        
        public function actionAddValue()
        {
            if($_POST)
            {
                $ID=$_POST['ID'];
                $VAL=$_POST['VAL'];
//                
                $sensor=$this->loadSensor($ID);
                $sensor->addInstantMetrica($VAL);
            }
        }
        
        public function actionRegistaMetricas($id)
        {
            $value=rand(0, 30);
            
            $sensor=$this->loadSensor($id);
            $sensor->addInstantMetrica($value);

        }
              
        public function loadSensor($id)
        {
                $model= Sensor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
        }
        
}