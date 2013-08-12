<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'categorias-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="form-wrapper">
    <div id="form-sidebar">
        
    </div>
    <div id="form-body">
            <div id="form-body-content">
                
                <div class="closed-box content-box">
                        <div class="content-box-header">
                            <h3><?php echo t('Opções Gerais');?></h3>                             
                        </div> 
                        <div class="content-box-content" style="display: block;">

                                <div class="tab-content default-tab" id="extra_box">
                                    <?php echo CHtml::label(t('Idioma Predefinido: '), 'opcoes[_lang]')?>
                                    <?php echo CHtml::dropDownList('opcoes[_lang]', 
                                                 Idioma::model()->getDefaultLang(),  
                                        CHtml::listData(Idioma::model()->findAll(),'LANG_ID','DESCRI')); ?>
                                    
                                    <?php echo CHtml::label(t('Página Inicial: '), 'opcoes[_index]')?>
                                    <?php echo CHtml::dropDownList('opcoes[_index]', 
                                                 Opcoes::model()->getDefaultIndexPage(), CHtml::listData(Categoria::model()->findAll(),'SLUG','SLUG')); ?>
                                </div>                                     
                        </div>
                </div>
 
                <div class="closed-box content-box">
                        <div class="content-box-header" style="padding: 5px 5px;">
                            <h3><?php echo t('SEO');?></h3> 
                            <?php echo CHtml::dropDownList('LANG_ID', Idioma::model()->getDefaultLang(),  
                            CHtml::listData(Idioma::model()->findAll(),'SHORT','DESCRI'),
                                    array(
                                      'ajax' => array(
                                        'type'=>'POST', //request type
                                        'url'=>$this->createUrl('/cms/opcoes/seo/'), //url to call
                                        //'update'=>'#idiomas-content', //selector to update
                                        'data'=>array('SHORT'=>'js:$(\'#Idioma_LANG_ID\').val()'),
                                        //'data'=>'js:javascript statement' 
                                        //leave out the data key to pass all form values through
                                        // another option to update or replace (will supersede those):
                                         'success'=>' function(data) { $(\'#idiomas-content\').html(data) }',
                                      ),//,'confirm' => 'foo',//, 'onchange' => 'alert("foo2")',
                                      'id'=>'Idioma_LANG_ID',
                                      'style'=>'float:right;',
                                  ));?>
                        </div> 
                        <div class="content-box-content" style="display: block;">

                                <div class="tab-content default-tab" id="idiomas-content">
                                    
                                    <?php echo $this->renderPartial('_seo_opcoes',array('form'=>$form,'lang'=>'pt')); ?>
                                    
                                </div>                                     
                        </div>
                </div>
                
                <div class="form-actions">
                        <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','class'=>'bebutton')); ?>
                </div>
                
            </div>
    </div>
						
</div>
<?php $this->endWidget(); ?>