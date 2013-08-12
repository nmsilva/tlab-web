<?php

/**
 * This is the model class for table "utilizadores".
 *
 * The followings are the available columns in table 'utilizadores':
 * @property integer $ID_USER
 * @property string $NOME
 * @property string $EMAIL
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $SALT
 */
class CMSUser extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CMSUser the static model class
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
			array('NOME', 'length', 'max'=>255),
                        array('EMAIL, USERNAME, PASSWORD', 'required'),
                        array('EMAIL, USERNAME, PASSWORD, SALT', 'unique'),
			array('EMAIL, USERNAME, PASSWORD', 'length', 'max'=>150),
			array('SALT', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, NOME, EMAIL, USERNAME, PASSWORD, SALT', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USER' => t('ID'),
			'NOME' => t('Nome'),
			'EMAIL' => t('Email'),
			'USERNAME' => t('Username'),
			'PASSWORD' => t('Password'),
			'SALT' => t('Salt'),
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
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('USERNAME',$this->USERNAME,true);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);
		$criteria->compare('SALT',$this->SALT,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {   
                $record2=new CMSUser;                
                while ($record2 != null){
                        $salt = Randomness::randomString(32);
                        $record2 = CMSUser::model()->findByAttributes(array('SALT'=>$salt));
                }
                $pass = hash('sha512', $this->PASSWORD.$salt);
                $this->SALT = $salt;
                $this->PASSWORD = $pass;
                return true;
        }
}