<?php
// protected/components/Helpers.php       NOT RECOMMENDED!
 
class Helper {

	/**
     * Constant related to Upload File Size
     */   
    const UPLOAD_MAX_SIZE=10485760; //10mb
    const UPLOAD_MIN_SIZE=1; //1 byte

    const ACTIVE_DATA=1;
    const DESACTIVE_DATA=0;
    const ACTIVE_DATA_STRING="Activo";
    const DESACTIVE_DATA_STRING="Desactivo";
    
    public static function fileTypes(){
        return array(
            'image'=>array('jpg','gif','png','bmp','jpeg'),
            'audio'=>array('mp3','wma','wav'),
            'video'=>array('flv','wmv','avi','mp4','mov','3gp'),
            'flash'=>array('swf'),
            'file'=>array('*'),           
            );
    }
	
    public static function chooseFileTypes(){
            return array(
                    'auto'=>t('Auto detect'),
                    'image'=>t('Image'),
                    'video'=>t('Video'),
                    'audio'=>t('Audio'),
                    'file'=>t('File'),
            );
    }
	
	
    public static function getEstadoData($estado)
    {
        if($estado==Helper::ACTIVE_DATA) {
            return Helper::ACTIVE_DATA_STRING; 
        }else if($estado==Helper::DESACTIVE_DATA){
            return Helper::DESACTIVE_DATA_STRING;
        }
    }

    public static function getObrigatorioString($val)
    {
        if($val==0)
            return t("Não");
        else
            return t("Sim");
    }

    public static function getObrigatorioArray(){
        return array(0 => t("Não"),
                     1 => t("Sim"));
    }

    public static function getEstadosArray(){
        return array(Helper::ACTIVE_DATA => t(Helper::ACTIVE_DATA_STRING),
                     Helper::DESACTIVE_DATA => t(Helper::DESACTIVE_DATA_STRING));
    }
    
    public static function getTiposMenuItem($tipo=""){
        $tipos=array(0=>t('Link para Categoria'),
                     1=>t('Link para URL'),
                     2=>t('Texto'));
        
        if($tipo=="")
            return $tipos;
        else
            return $tipos[$tipo];
    }
    
    public static function getTiposMedia($tipo=""){
        $tipos=array(0=>t('Imagem'),
                     1=>t('Video'));
        
        if($tipo=="")
            return $tipos;
        else
            return $tipos[$tipo];
    }
    
    public static function the_excerpt($text) {
        $numb=500;
        if (strlen($text) > $numb) { 
          $text = substr($text, 0, $numb); 
          $text = substr($text,0,strrpos($text," ")); 
          $etc = " ...";  
          $text = $text.$etc; 
        }
        
        return strip_tags($text); 
    }
    
    public static function getFotoPath()
    {
        return Yii::app()-> getBasePath() . "/../images/fotos";
    }

    public static function getFotoPublicUrl(){
        return Yii::app()->getBaseUrl()."/images/fotos";
    }
        
    /**
     * Constant related to User
     */   
    
    const USER_GROUP_ADMIN='Admin';
    const USER_GROUP_EDITOR='Editor';
    const USER_GROUP_REPORTER='Reporter';


}