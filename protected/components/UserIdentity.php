<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate($type="")
	{
            
                if($type==CMS_STATE)
                {
                        $record=CMSUser::model()->findByAttributes(array('USERNAME'=>$this->username));
                        
                        if($record===null)
                            $this->errorCode=self::ERROR_USERNAME_INVALID;
                        else if($record->PASSWORD!==hash('sha512', $this->password.$record->SALT))
                            $this->errorCode=self::ERROR_PASSWORD_INVALID;
                        else
                        {
//                            $record2=new CMSUser;                
//                            while ($record2 != null){
//                                    $salt = Randomness::randomString(32);
//                                    $record2 = CMSUser::model()->findByAttributes(array('SALT'=>$salt));
//                            }
//                            
//                            $pass = hash('sha512', $this->password.$salt);
//                            $record->SALT = $salt;
//                            $record->PASSWORD = $pass;
//                            $record->save();
                            
                            $this->_id=$record->ID_USER;
                            $this->setState('name', $this->username);
                            $this->setState('type',$type);
                            $this->errorCode=self::ERROR_NONE;
                        }
                }
                else if($type==PORTAL_STATE){
                    
                        Yii::import("portal.models.*");
                        
                        $record=Utilizador::model()->findByAttributes(array('EMAIL'=> $this->username));

                        if($record===null)
                            $this->errorCode=self::ERROR_USERNAME_INVALID;
                        else if($record->PASSWORD!==hash('sha512', trim ($this->password).$record->SALT))
                            $this->errorCode=self::ERROR_PASSWORD_INVALID;
                        else
                        {
                            
                            $this->_id=$record->ID_USER;
                            $this->setState('name', $record->NOME);
                            
                            $this->setState('rule', $record->ID_TIPO);
                            
                            $this->setState('email', $this->username);
                            $this->setState('type',$type);
                            
                            $this->errorCode=self::ERROR_NONE;
                        }
                        
                }
		
		return !$this->errorCode;
	}

	public function getId(){
		return $this->_id;
	}

        
}