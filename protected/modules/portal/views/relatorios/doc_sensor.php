<div style="font-size: 12px;">
    <div style="width: 100%;height: 110px; border-bottom: 1px solid #aaa">
        <div style="float:left; width:25%;">
            <img src="<?php echo Helper::getFotoPublicUrl()."/".$model->COMPARTIMENTO->INSTITUICAO->ENTIDADE->LOGO; ?>"/>
        </div>
        <div style="float:left; width:75%;height: 80px;text-align: right;">
            <span>Entidade : <b><?php echo $model->COMPARTIMENTO->INSTITUICAO->ENTIDADE->NOME; ?></b></span><br>
            <span>Instituição : <b><?php echo $model->COMPARTIMENTO->INSTITUICAO->IDENTIFICACAO; ?></b></span><br>
            <span>Compartimento : <b><?php echo $model->COMPARTIMENTO->IDENTIFICACAO; ?></b></span><br>
            <br>
        </div>
    </div>
    <div style="width: 100%;margin-top: 10px;">
        <div style="width: 48%; float: left;height: 80%;">
            <table style="width: 100%;font-size: 12px; margin-right: 5px;">
                <tr>
                    <td><b>Data</b></td>
                    <td><b>Hora</b></td>
                    <td><b>Min.</b></td>
                    <td><b>Max.</b></td>
                    <td><b>Média</b></td>
                </tr>
                
                <?php foreach ($series[0]['data'] as $data): ?>
                
                    <tr><td><?php echo $data['DATA'];?></td><td><?php echo $data['HORA'];?></td><td><?php echo $data['MIN'];?></td><td><?php echo $data['MAX'];?></td><td><?php echo $data['MEDIA'];?></td></tr>
                    
                <?php endforeach; ?>
                
                
            </table>
        </div>
        <div style="width: 48%; float: left; border-left: 1px dotted #333; height: 80%;padding-left: 10px;">
            <table style="width: 100%;font-size: 12px;">
                <tr>
                    <td><b>Data</b></td>
                    <td><b>Hora</b></td>
                    <td><b>Min.</b></td>
                    <td><b>Max.</b></td>
                    <td><b>Média</b></td>
                </tr>
                
                
            </table>
        </div>
    </div>
    <div style="width: 100%; height: 40px;border-top: 1px solid #333; margin-top: 40px;text-align: center;">
        <span>(Assinatura do Responsável)</span>
    </div>
</div>