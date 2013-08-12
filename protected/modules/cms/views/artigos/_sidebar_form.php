<div id="inner-form-sidebar">
        <!--Start the publish Box -->
        <div class="content-box">

                <div class="content-box-header">


                <h3><?php echo t('Publicação'); ?></h3>

                </div> 

                <div class="content-box-content" style="display: block;">

                        <div class="tab-content default-tab" style="display: block;">
                            
                            <?php echo $form->textFieldRow($model,'SLUG',array('style'=>'width:85%;','id'=>'txt_slug')); ?>
                            
                            <?php echo $form->dropDownListRow($model,'ESTADO', Helper::getEstadosArray()); ?>
                            
                            <?php echo CHtml::link(t('Ver Artigo'),array('/site/front/artigo/','name'=>$model->SLUG),array('target'=>'_blank','class'=>'bebutton','style'=>'width:63%;text-align: center;')); ?>
                        </div>       

                </div>


        </div>
        <!-- End Publish Box -->
                    
    <?php foreach($terms as $key=>$term) :      
            $this->widget('application.modules.cms.components.SidebarItemsWidget',array(
                'form'=>$form,
                'model'=>$model,
                'term'=>$term,
                'selected_terms'=>$selected_terms,
                'key'=>$key
                )); 
       endforeach; ?>
        
    
    <!--Start the publish Box -->
    <div class="content-box">

            <div class="content-box-header">


            <h3><?php echo t('Imagem de Destaque'); ?></h3>

            </div> 

            <div class="content-box-content" style="display: block;">

                    <div class="tab-content default-tab" style="display: block;">

                        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>

                              <?php  $this->renderPartial('_lista_media',array(
                                        'form'=>$form,
                                        'model'=>$model,
                                        'imagens'=>$imagens,)); ?>
                        
                        <?php $this->endWidget(); ?>
                        
                        <?php echo $form->hiddenField($model,'ID_MEDIA',array('id'=>'id_media')); ?>
                        
                        <div class="items" style="width: 100%">
                            <ul class="thumbnails">
                                <li class="" style="width: 100%">
                                    <a href="" data-toggle="modal" data-target="#myModal" onclick="return false;" class="thumbnail">
                                            <img id="img-destaque" src="<?php echo ($imagem)? $imagem : "http://placehold.it/280x180"; ?>" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label'=>'Abrir Imagem',
                            'type'=>'primary',
                            'htmlOptions'=>array(
                                'style'=>'width:74%;margin-top: -30px;',
                                'class'=>'bebutton',
                                'data-toggle'=>'modal',
                                'data-target'=>'#myModal',
                            ),
                        )); ?>
                        <br>

                    </div>       

            </div>


    </div>
    <!-- End Publish Box -->
    
</div>