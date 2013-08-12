<div style="margin-bottom: 15px">
    <?php foreach($this->items as $item) {
            
            $active="";
            $url="";
            
            if(is_array($item['url']))
            {
                if(in_array($this->currentUrl,$item['url'])) {
                    $active="btn-inverse";
                } 
                
                $url=$item['url'][0];
                
            }else{
                if($item['url']==$this->currentUrl) {
                    $active="btn-inverse";
                } 
                
                $url=$item['url'];
            }
            
            $icon="";
            if(isset($item['icon']))
            {
                if($active!="")
                    $icon='<i class="'.$item['icon'].' icon-white"></i>';
                else
                    $icon='<i class="'.$item['icon'].'"></i>';
            }

            echo '<a href="'.Yii::app()->getUrlManager()->createUrl($url).'" class=" btn-block btn btn-large '.$active.'" style="font-size:12px; text-align:left; padding-left: 15px;">'.$icon.' '.$item['label'].'</a>';
        }
    ?>
</div>
