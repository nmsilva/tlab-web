<div style="min-height: 200px;">

    <?php $this->widget('application.modules.portal.widgets.graficoSensoresWidget',
                        array('type'=>'sensor','model'=>$sensor)); ?>
    
    <small>Dados para Configuração de Sensor.</small>
    <pre>
            <?php echo $sensor->getAttributeLabel('ID_SENSOR'); ?> - <b><?php echo $sensor->ID_SENSOR; ?></b><br>
            <?php echo $sensor->getAttributeLabel('IDENTIFICACAO'); ?> - <b><?php echo $sensor->IDENTIFICACAO; ?></b><br>
            <?php echo $sensor->getAttributeLabel('ID_UNI'); ?> - <b><?php echo $sensor->UNIDADE->IDENTIFICACAO; ?></b><br>
            <?php echo $sensor->getAttributeLabel('VMAX'); ?> - <b><?php echo $sensor->VMAX; ?></b><br>
            <?php echo $sensor->getAttributeLabel('VMIN'); ?> - <b><?php echo $sensor->VMIN; ?></b>
            
    </pre>
    
</div>

