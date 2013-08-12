<?php

/**
 * This is the model class for table "entidades".
 *
 * The followings are the available columns in table 'entidades':
 * @property integer $ID_ENT
 * @property string $API_KEY
 * @property string $NOME
 * @property string $LOCALIDADE
 * @property string $COD_POSTAL
 * @property string $EMAIL
 * @property string $RUA
 * @property string $NIF
 * @property string $TELEFONE
 * @property string $TELEMOVEL
 * @property string $DATA_REGISTO
 * @property integer $ATIVO
 * @property string $LOGO
 *
 * The followings are the available model relations:
 * @property Instituicoes[] $instituicoes
 * @property Utilizadores[] $utilizadores
 */
class Entidade extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entidade the static model class
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
		return 'entidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('API_KEY, NOME, LOCALIDADE, COD_POSTAL, EMAIL, RUA, NIF, DATA_REGISTO', 'required'),
			array('ATIVO', 'numerical', 'integerOnly'=>true),
			array('API_KEY, LOCALIDADE, RUA', 'length', 'max'=>50),
			array('NOME, LOGO', 'length', 'max'=>200),
			array('COD_POSTAL', 'length', 'max'=>10),
			array('EMAIL', 'length', 'max'=>100),
			array('NIF, TELEFONE, TELEMOVEL', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ENT, API_KEY, NOME, LOCALIDADE, COD_POSTAL, EMAIL, RUA, NIF, TELEFONE, TELEMOVEL, DATA_REGISTO, ATIVO, LOGO', 'safe', 'on'=>'search'),
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
			'INSTITUICOES' => array(self::HAS_MANY, 'Instituicao', 'ID_ENT'),
			'UTILIZADORES' => array(self::HAS_MANY, 'Utilizador', 'ID_ENT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
                return array(
			
			
			
			
			
		);
            
		return array(
			'ID_ENT' => t('ID'),
			'API_KEY' => 'Api Key',
			'NOME' => t('Nome'),
			'LOCALIDADE' => t('Localidade'),
			'EMAIL' => t('Email'),
			'COD_POSTAL' => t('Cod Postal'),
			'RUA' => t('Rua'),
			'NIF' => t('NIF'),
			'TELEFONE' => t('Telefone'),
			'TELEMOVEL' => t('Telemovel'),
			'DATA_REGISTO' => t('Data Registo'),
			'ATIVO' => 'Ativo',
			'LOGO' => 'Logo',
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

		$criteria->compare('ID_ENT',$this->ID_ENT);
		$criteria->compare('API_KEY',$this->API_KEY,true);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('LOCALIDADE',$this->LOCALIDADE,true);
		$criteria->compare('COD_POSTAL',$this->COD_POSTAL,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('RUA',$this->RUA,true);
		$criteria->compare('NIF',$this->NIF,true);
		$criteria->compare('TELEFONE',$this->TELEFONE,true);
		$criteria->compare('TELEMOVEL',$this->TELEMOVEL,true);
		$criteria->compare('DATA_REGISTO',$this->DATA_REGISTO,true);
		$criteria->compare('ATIVO',$this->ATIVO);
		$criteria->compare('LOGO',$this->LOGO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate()
        {   
            
            if ($this->isNewRecord){
                $key = Randomness::randomString(40);
                
                $this->API_KEY=$key;
                $this->DATA_REGISTO = new CDbExpression('NOW()');
            }

            return parent::beforeValidate();
        }
        
        public function beforeDelete() {
            
            foreach ($this->INSTITUICOES as $inst){
                $inst->delete();
            }
            foreach ($this->UTILIZADORES as $user){
                $user->delete();
            }
            
            return parent::beforeDelete();
        }
}