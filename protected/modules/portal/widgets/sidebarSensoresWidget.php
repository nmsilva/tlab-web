<?php
class sidebarSensoresWidget extends CWidget {
       
    public $type="sensores";
    
    public function run() {
        
        
        $id_ent=-1;
        if(user()->rule==1 or user()->rule==2){
            
            if(isset($_POST['ID_ENT'])){
                $id_ent=$_POST['ID_ENT'];
            }

        }else{
            $user_model=Utilizador::model()->find('ID_USER=:id', array('id'=>user()->getId()));
            $id_ent=$user_model->ID_ENT;
        }
        
        $tree_items=array();
        
        if($id_ent!=-1)
            $tree_items= Instituicao::model()->findAll('ID_ENT=:ent',array('ent'=>$id_ent));
        
        if(isset($_POST['ID_ENT'])): 
            $this->render('sidebarTreeItems',array('tree_items'=>$tree_items));
        else:
            $this->render('sidebarSensores',array('tree_items'=>$tree_items));
        endif;
        
    }
 
}