<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $ID_MENU
 * @property string $NOME
 * @property string $DATA_CRIACAO
 *
 * The followings are the available model relations:
 * @property MenuItem[] $menuItems
 */
class Menu extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return 'menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOME', 'required'),
			array('NOME', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MENU, NOME, DATA_CRIACAO', 'safe', 'on'=>'search'),
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
			'menuItems' => array(self::HAS_MANY, 'MenuItem', 'ID_MENU'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MENU' => t('ID'),
			'NOME' => t('Nome'),
			'DATA_CRIACAO' => t('Data Criacao'),
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

		$criteria->compare('ID_MENU',$this->ID_MENU);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('DATA_CRIACAO',$this->DATA_CRIACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
	    if ($this->isNewRecord){
                $this->DATA_CRIACAO = new CDbExpression('NOW()');
            }
	 
	    return parent::beforeSave();
	}
        
        public function getTreeItems(){
            
                        
            $results = $this->dbConnection->createCommand(
                "SELECT m1.`ID_MENU` as id, m1.`NOME` as text, m2.ID_MENU_ITEM IS NOT NULL AS hasChildren "  
               ."FROM `menus` as m1, menu_item as m2 where m1.ID_MENU= m2.ID_MENU "
             )->queryAll();
                          
             foreach ($results as $key=>$menu) {
                 $children = $this->dbConnection->createCommand(
                    "SELECT m2.`ID_MENU_ITEM` as id, m1.`NOME` as text "  
                   ."FROM `item_menu_idioma` as m1, menu_item as m2 "
                   ."WHERE m1.ID_MENU_ITEM= m2.ID_MENU_ITEM  AND m1.LANG_ID=".Idioma::model()->getDefaultLang()
                   ." AND m2.ID_MENU=".$menu['id']
                 )->queryAll();
                 
                 foreach ($children as $key => $value) {
                     $children[$key]['text']=$children[$key]['text'];
                 }
                 
                 $results[$key]['children']=$children;
                 $results[$key]['expanded']=true;
             }
             
             return $results;
        }
        
        public static function getItems($id,$id_language)
        {
                $items = Menu::$db->createCommand(
                   "SELECT m1.ID_MENU_ITEM as ID,m2.ID_CAT, m1.`NOME` as NOME , m2.ID_CAT as CAT, m2.TIPO, m2.VALOR, m2.MEN_ID_MENU_ITEM "  
                  ."FROM `item_menu_idioma` as m1, menu_item as m2 "
                  ."WHERE m1.ID_MENU_ITEM= m2.ID_MENU_ITEM AND m1.LANG_ID=".$id_language
                  ." AND m2.ID_MENU=".$id
                  ." ORDER BY m2.ORDEM ASC"
                )->queryAll();
                          
                $menu=array();
                foreach ($items as $key => $item) {
                    
                    $cat=Categoria::model()->findByPk($item['ID_CAT']);
                    
                    $show=TRUE;
                    if($cat and $cat->ESTADO==0)
                        $show=FALSE;
                    
                    if($item['MEN_ID_MENU_ITEM']==null and $show)
                    {
                        $menu[$key]['label']=$item['NOME'];

                        if($item['TIPO']==0){
                            $menu[$key]['url']=array('/site/front/page', 'view'=>$cat->SLUG);
                        }else if($item['TIPO']==1){
                            $pos = strpos($item['VALOR'],'http');
                            
                            if(!$pos)
                                $menu[$key]['url']=Yii::app ()->baseUrl."/".$item['VALOR'];
                            else
                                $menu[$key]['url']=$item['VALOR'];
                        }
                        else if($item['TIPO']==2)
                            $menu[$key]['url']="#";
                        
                        $childrens = Menu::$db->createCommand(
                            "SELECT m1.`NOME` as NOME,m2.ID_CAT, m2.TIPO, m2.VALOR, m2.MEN_ID_MENU_ITEM "  
                           ."FROM `item_menu_idioma` as m1, menu_item as m2 "
                           ."WHERE m1.ID_MENU_ITEM= m2.ID_MENU_ITEM AND m2.MEN_ID_MENU_ITEM=".$item['ID']." AND m1.LANG_ID=".$id_language
                           ." AND m2.ID_MENU=".$id
                           ." ORDER BY m2.ORDEM ASC"
                         )->queryAll();
                        
                        $childrens_item=array();
                        foreach ($childrens as $key_children => $children) {
                            
                            $cat=Categoria::model()->findByPk($children['ID_CAT']);
                    
                            $show=TRUE;
                            if($cat and $cat->ESTADO==0)
                                $show=FALSE;
                            
                            if($show)
                            {
                                $childrens_item[$key_children]['label']=$children['NOME'];

                                if($children['TIPO']==0)
                                    $childrens_item[$key_children]['url']=array('/site/front/page', 'view'=>$cat->SLUG);
                                else if($children['TIPO']==1){
                                    $pos = strpos($children['VALOR'],'http');

                                    if(!$pos)
                                        $childrens_item[$key_children]['url']=Yii::app ()->baseUrl."/".$children['VALOR'];
                                    else
                                        $childrens_item[$key_children]['url']=$children['VALOR'];

                                }else if($children['TIPO']==2)
                                    $childrens_item[$key_children]['url']="#";
                            }
                        }
                        
                        if(count($childrens_item)>0)
                            $menu[$key]['items']=$childrens_item;
                        
                    }
                }
                
                return $menu;
        }
        
}