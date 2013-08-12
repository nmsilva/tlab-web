<?php

$this->menu=array(
	array('label'=>'List Media','url'=>array('index'),'linkOptions'=>array('class'=>'button')),
);
?>

<!--Start the publish Box -->
<div class="content-box">

        <div class="content-box-header">
            <h3><?php echo t(''); ?></h3>
        </div> 
        <div class="content-box-content" style="display: block;">

                <div class="tab-content default-tab" style="display: block;">

                        <?php
                    $this->widget('xupload.XUpload', array(
                            'url' => Yii::app()->createUrl("/cms/media/upload", array("parent_id" => 1)),
                            'model' => $xmodel,
                            'attribute' => 'file',
                            'multiple' => false,
                    ));
                    ?>
                </div>       

        </div>

</div>
<!-- End Publish Box -->

