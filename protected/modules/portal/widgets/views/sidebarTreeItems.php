<ul id="red" class="treeview">

    <?php foreach ($tree_items as $item):?>
        <li><span><?php echo ($item->haveWarning())?'<i class="icon-warning-sign"></i>':''; ?> 
            <?php echo $item->IDENTIFICACAO; ?> </span>
            <ul>
                <?php foreach ($item->COMPARTIMENTOS as $compartimento):?>
                    <li><span><?php echo ($compartimento->haveWarning())?'<i class="icon-warning-sign"></i>':''; ?> 
                        <?php echo $compartimento->IDENTIFICACAO; ?></span>
                        <ul>                            
                            <li>
                                <span><?php echo t('Equipamentos'); ?></span>
                                <ul>
                                    <?php foreach ($compartimento->EQUIPAMENTOS as $equipamento):?>
                                        <li>
                                            <?php echo ($equipamento->haveError())?'<i class="icon-warning-sign"></i>':''; ?> 
                                            <span><a href="<?php echo CController::createUrl('/portal/'.$this->type.'/index/type/equip/id/'.$equipamento->ID_EQUIP);?>"><?php echo $equipamento->IDENTIFICACAO; ?></a></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>     
                            <li>
                                <span><?php echo t('Sensores'); ?></span>
                                <ul>
                                    <?php foreach ($compartimento->SENSORES as $sensor):?>

                                        <?php if(!$sensor->ID_EQUIP): ?>
                                            <li>
                                                <?php echo ($sensor->haveError())?'<i class="icon-warning-sign"></i>':''; ?> 
                                                <span><a href="<?php echo CController::createUrl('/portal/'.$this->type.'/index/type/sensor/id/'.$sensor->ID_SENSOR);?>"><?php echo $sensor->IDENTIFICACAO; ?></a></span>
                                            </li>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                </ul>
                            </li> 
                        </ul>

                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    <?php endforeach; ?>

</ul>
<script language="javascript"> 
	$("#red").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "location",
		toggle: function() {
                    
		}
	});
</script>
