<?php

class CMSActiveRecord extends CActiveRecord {

    public static $db;
    
    /**
     * Returns the database connection used by active record.
     * By default, the "db" application component is used as the database connection.
     * You may override this method if you want to use a different database connection.
     * @return CDbConnection the database connection used by active record.
     */
    public function getDbConnection()
    {
        if(self::$db!==null)
            return self::$db;
        else
        {
 
            // Create CDbConnection and set properties
            self::$db = new CDbConnection();
            foreach(Yii::app()->db_cms as $key => $value)
                self::$db->$key = $value;
 

            if(self::$db instanceof CDbConnection)
            {
                self::$db->setActive(true);
                return self::$db;
            }
            else
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
        }
    }
}