<?php

function checkIfInArray($element, $array){
    foreach ($array as $e){
        if($e['id'] == $element['id']){
            return true;
        }
    }
    return false;
}
