<?php

/**
 * This is the model class for table "menu_item".
 *
 * The followings are the available columns in table 'menu_item':
 * @property integer $ID_MENU_ITEM
 * @property integer $ID_MENU
 * @property integer $ID_CAT
 * @property integer $MEN_ID_MENU_ITEM
 * @property string $TIPO
 * @property string $VALOR
 * @property string $ORDEM
 */
class MenuItem extends CMSActiveRecord
{
        public $IDIOMA;
        public $NOME;
        public $DESCRICAO;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuItem the static model class
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
		return 'menu_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('TIPO','required'),
			array('ID_MENU', 'numerical', 'integerOnly'=>true),
			array('TIPO', 'length', 'max'=>100),
			array('VALOR', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MENU_ITEM, ID_MENU, TIPO, VALOR,ID_CAT', 'safe', 'on'=>'search'),
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
			'ID_MENU_ITEM' => 'ID',
			'ID_MENU' => t('Id Menu'),
			'TIPO' => t('Tipo'),
			'VALOR' => t('Valor(URL)'),
                        'ID_CAT' => t('Categoria'),
                        'MEN_ID_MENU_ITEM'=> t('Item Superior'),
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

		$criteria->compare('ID_MENU_ITEM',$this->ID_MENU_ITEM);
		$criteria->compare('ID_MENU',$this->ID_MENU);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('VALOR',$this->VALOR,true);
                
                $criteria->select="t.*, (SELECT nome FROM item_menu_idioma WHERE ID_MENU_ITEM=t.ID_MENU_ITEM and LANG_ID='".$this->IDIOMA."') as NOME,
                                   (SELECT descricao FROM item_menu_idioma WHERE ID_MENU_ITEM=t.ID_MENU_ITEM and LANG_ID='".$this->IDIOMA."') as DESCRICAO";
                
                $criteria->order="ORDEM ASC";
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getNameItem($id)
        {
             $sql='SELECT (SELECT nome FROM item_menu_idioma WHERE ID_MENU_ITEM='.$id.' and LANG_ID='
             .Idioma::model()->getDefaultLang().') as NOME '
             .'FROM menu_item as t';
             
            $model=MenuItem::model()->findBySql($sql);
            
            return $model->NOME;
        }
        
        public static function getNameCategoria($id_item,$id_cat)
        {   
            $item=MenuItem::model()->findByPk($id_item);
            
            if($item->TIPO==0 && !is_null($id_cat)){
               
                $cat= CategoriaIdioma::model()->findByPk(array('ID_CAT'=>$id_cat,'LANG_ID'=>Opcoes::getDefaultLang()));

                return $cat->TITULO;
            }
            else{
                return "----";
            }
            
        }
}