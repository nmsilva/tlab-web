<?php

class ServiceController extends Controller
{
        /**
        * @param string user
        * @param string key
        * @return float autorização
        * @soap
        */
        public function authorization($user,$key)
        {
            
            $result=true;
            
            return $result;
        }
                
        public function actions()
        {
            return array(
                'wsdl'=>array(
                    'class'=>'CWebServiceAction',
                ),
            );
        }
        
	
        
        
}