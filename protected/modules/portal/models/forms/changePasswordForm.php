<?php

/**
 * This is the model class for Login Form.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class changePasswordForm extends CFormModel
{
	public $old_password;
	public $new_password;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('old_password, new_password', 'required'),
                        array('old_password', 'validateOldPassword'),
		);
	}
        
        public function attributeLabels()
	{
		return array(
			'old_password' => t('Antiga Senha'),
			'new_password' => t('Nova Senha'),
		);
	}
        
        public function savePassword()
        {
            $id_user=user()->getId();
            $user= Utilizador::model()->findByPk($id_user);
            
            $user->PASSWORD=$this->new_password;
            $user->getHashPassword();
            
            $user->save();
            
        }
        
        public function validateOldPassword($attribute,$params)
        {
            $id_user=user()->getId();
            $user= Utilizador::model()->findByPk($id_user);
            
            if($user->PASSWORD!==hash('sha512', trim ($this->$attribute).$user->SALT))
                    $this->addError($attribute, t('A Senha Antiga não é Válida!'));
        }
        
	

}

