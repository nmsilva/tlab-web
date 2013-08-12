<?php
class FotoUploadForm extends CFormModel
{
        public $file;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules()
        {
                return array(
                        array('file', 'file', 'types'=>'jpg, gif, png'),
                );
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels()
        {
                return array(
                        'file'=>'Upload files',
                );
        }

}
