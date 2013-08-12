<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Lita de Imagens</h4>
</div>

<div class="modal-body">
    
    <div class="items">
        <ul class="thumbnails">
            <?php foreach ($imagens as $key => $imagem):?> 
            
                <li class="span2">
                    <a href="" style="height: 90px;overflow: hidden;" rel="<?php echo $imagem->ID_MEDIA; ?>" data-toggle="modal" data-target="#myModal" onclick="return false;" class="thumbnail">
                            <img width="130" height="100" src="<?php echo Media::model()->getPublicUrl()."/".$imagem->PATH; ?>" alt="">
                    </a>
                </li>
                
            <?php endforeach; ?>
                
        </ul>
    </div>
 
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Fechar',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>

<script language="javascript">
    $(document).ready(function (){
        $('.thumbnails li a').click(function (){
            
            $('#id_media').val($(this).attr('rel'));
            $('#img-destaque').attr('src',$(this).children('img').attr('src'));
        });
    });
</script>
