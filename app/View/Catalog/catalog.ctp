<?    
    if ($this->elementExists($catalog['Catalog']['trans'] . '/' . $element)){
        echo $this->element($catalog['Catalog']['trans'] . '/' . $element);
    }else{
        echo $this->element('default' . $elem . '/'  . $element);
    }    
?>