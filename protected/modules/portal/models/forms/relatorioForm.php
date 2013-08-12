<?php

/**
 * This is the model class for Login Form.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class relatorioForm extends CFormModel
{
        public $ID_SENSOR;
        
        public $DATA_INICIO;
        public $DATA_FIM;
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
                    array('DATA_INICIO, DATA_FIM,', 'required'),
                    array('ID_SENSOR, DATA_INICIO, DATA_FIM,', 'safe', 'on'=>'search'),
		);
	}
        
        public function attributeLabels()
	{
		return array(
			'ID_SENSOR' => t('Sensor'),
			'DATA_INICIO' => t('Data Inicial'),
			'DATA_FIM' => t('Data Final'),
		);
	}
        
        

}

