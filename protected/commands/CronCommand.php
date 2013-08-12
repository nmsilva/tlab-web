<?php class CronCommand extends CConsoleCommand {
    
    public function run() {
        // here we are doing what we need to do
        // import the module-level models and components
        Yii::app()->setImport(array(
                'application.modules.portal.models.*',
        ));
        
        $sensores=Sensor::model()->findAll('ATIVO=0');
        foreach ($sensores as $sensor) {
            echo "check sensor - ".$sensor->IDENTIFICACAO;
            $sensor->checkConection();
        }
    }
    
}
