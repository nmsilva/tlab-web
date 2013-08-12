<?php

/**
 * This is the model class for table "utilizadores".
 *
 * The followings are the available columns in table 'utilizadores':
 * @property integer $ID_USER
 * @property integer $ID_ENT
 * @property integer $ID_TIPO
 * @property string $NOME
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property string $SALT
 * @property string $CHAVE_RECUP
 * @property string $TELEFONE
 * @property string $TELEMOVEL
 * @property string $DATA_REGISTO
 * @property string $DATA_ALTERACAO
 * @property string $LINGUA
 * @property string $ATIVO
 * @property string $IMAGEM
 *
 * The followings are the available model relations:
 * @property Entidades $iDENT
 * @property TiposUtilizador $iDTIPO
 */
class Utilizador extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Utilizador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'utilizadores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO, NOME, EMAIL, PASSWORD, SALT, DATA_REGISTO', 'required'),
			array('ID_ENT, ID_TIPO', 'numerical', 'integerOnly'=>true),
			array('NOME, PASSWORD', 'length', 'max'=>150),
			array('EMAIL, CHAVE_RECUP', 'length', 'max'=>100),
			array('EMAIL', 'email'),
			array('SALT', 'length', 'max'=>50),
			array('TELEFONE, TELEMOVEL', 'length', 'max'=>9),
			array('DATA_ALTERACAO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, ID_ENT, ID_TIPO, NOME, EMAIL, PASSWORD, SALT, CHAVE_RECUP, TELEFONE, TELEMOVEL, DATA_REGISTO, DATA_ALTERACAO, IMAGEM', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ENTIDADE' => array(self::BELONGS_TO, 'Entidade', 'ID_ENT'),
			'TIPO_UTILIZADOR' => array(self::BELONGS_TO, 'TipoUtilizador', 'ID_TIPO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USER' => t('ID'),
			'ID_ENT' => t('Entidade'),
			'ID_TIPO' => t('Tipo de Utilizador'),
			'NOME' => t('Nome'),
			'EMAIL' => t('Email'),
			'PASSWORD' => t('Password'),
			'SALT' => t('Salt'),
			'CHAVE_RECUP' => 'Chave Recup',
			'TELEFONE' => t('Telefone'),
			'TELEMOVEL' => t('Telemovel'),
			'DATA_REGISTO' => t('Data Registo'),
			'DATA_ALTERACAO' => t('Data Alteracao'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_USER',$this->ID_USER);
		$criteria->compare('ID_ENT',$this->ID_ENT);
		$criteria->compare('ID_TIPO',$this->ID_TIPO);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('TELEFONE',$this->TELEFONE,true);
		$criteria->compare('TELEMOVEL',$this->TELEMOVEL,true);

                $criteria->with=array('TIPO_UTILIZADOR','ENTIDADE');
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate()
        {   
            
            if ($this->isNewRecord){
                $this->sendPasswordEmail();
                $this->getHashPassword();
            }
            else{
                $this->DATA_ALTERACAO = new CDbExpression('NOW()');
            }

            return parent::beforeValidate();
        }
        
        public function getHashPassword()
        {
            $record2=new Utilizador;  
                
            while ($record2 != null){
                    $salt = Randomness::randomString(32);
                    $record2 = Utilizador::model()->findByAttributes(array('SALT'=>$salt));
            }

            $pass = hash('sha512', $this->PASSWORD.$salt);   
            $this->SALT = $salt;
            $this->PASSWORD = $pass;

            $this->DATA_REGISTO = new CDbExpression('NOW()');
        }
        
        private function sendPasswordEmail()
        {
            $this->generateRandomPassword();
            
            $this->CHAVE_RECUP=$this->PASSWORD;
        }
        
        private function generateRandomPassword()
        {
            $this->PASSWORD = Randomness::randomString(8);
        }
}