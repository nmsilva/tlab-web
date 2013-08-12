<?php

/**
 * This is the model class for Login Form.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class CmsLoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
		);
	}

	

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
    	{
    		$identity=new UserIdentity($this->username,$this->password);
	        $identity->authenticate(CMS_STATE);
	        switch($identity->errorCode)
	        {
			    case UserIdentity::ERROR_NONE:
			        $duration=0; // 30 days
			        user()->login($identity,$duration);
			        return true;
			        break;
			    case UserIdentity::ERROR_USERNAME_INVALID:
			        $this->addError('email','Username is incorrect.');
			        break;
			    default: // UserIdentity::ERROR_PASSWORD_INVALID
			        $this->addError('senha','Password is incorrect.');
			        break;
			}
    	}

    	return  false;
	}
	

}
