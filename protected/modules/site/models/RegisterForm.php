<?php

class RegisterForm extends CFormModel
{
	public $nome;
	public $sexo;
	public $dia;
	public $mes;
	public $ano;
	public $email;
	public $senha;
	public $confirmar_senha;
	public $terms;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('nome, ,dia, mes, ano, email, senha, confirmar_senha', 'required'),
			array('email, senha, confirmar_senha', 'length', 'min'=>6, 'max'=>40),
			array('terms', 'required', 'requiredValue'=>true,'message' => 'You must agree to the terms and conditions' ),

			array('sexo','radioValidate'),

			// email has to be a valid email address
			array('email', 'email'),

			array('senha', 'compare', 'compareAttribute'=>'confirmar_senha'),
		);
	}

	public function radioValidate($attribute,$params)
	{
	    if($this->$attribute == null)
	    {
	        $this->addError($attribute,$this->getAttributeLabel($attribute).t(' não pode ser Vazio.'));
	    }
	}

	public function registerUser()
	{
            
	}
	
}