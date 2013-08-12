<?php

function getNameAccountRole($id){
    
    switch ($id) {
        case 1:
            return t('Administração');
            break;
        
        case 2:
            return t('Técnico');
            break;
        
        case 3:
            return t('Cliente');
            break;
        default:
            break;
    }
}

function isAdmin($rule){
    if($rule==1)
        return true;
    else
        return false;
}

function havePermission($rule){
    if($rule==1 or $rule==2)
        return true;
    else
        return false;
}
