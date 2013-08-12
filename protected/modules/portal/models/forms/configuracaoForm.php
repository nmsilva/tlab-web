<?php

/**
 * This is the model class for Login Form.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class configuracaoForm extends CFormModel
{
	public $ID_ENT;
	public $ID_INST;
        public $ID_COMP;
        
        public $CHECK_EQUIP;
        public $ID_EQUIP;
        public $SENSOR;
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('ID_ENT, ID_INST, ID_COMP, ID_EQUIP, SENSOR', 'required'),
		);
	}
        
        public function attributeLabels()
	{
		return array(
			'ID_ENT' => t('Entidade'),
			'ID_INST' => t('Instituição'),
			'ID_COMP' => t('Compartimento'),
                        'CHECK_EQUIP' => t(''),
			'ID_EQUIP' => t('Equipamento'),
			'SENSOR' => t('Sensor'),
		);
	}
        
        

}

