<?php

class PortalLoginForm extends CFormModel
{
	public $email;
	public $senha;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('email, senha', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
		);
	}

	public function login()
	{
            if(!$this->hasErrors())  // we only want to authenticate when no input errors
            {
                    $identity=new UserIdentity($this->email,$this->senha);
                    $identity->authenticate(PORTAL_STATE);

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
                        case UserIdentity::ERROR_PASSWORD_INVALID:
                            $this->addError('senha','Password is incorrect.');
                            break;
                        default :
                            $this->addError('senha','Error.');
                            break;
                    }
            }

            return  false;
	}
	
}