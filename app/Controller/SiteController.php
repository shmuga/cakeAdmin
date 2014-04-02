<?php
class SiteController extends AppController {

    public $uses = array("Catalog","Currency",'Setting');
    public $layout = "ajax";

    private function _clearString(&$str){
      if(!preg_match("/^([0-9a-zA-Z-]*)$/", $str)){            
        $str = false;
      }
    }

    private function _loadModels($name){
        $name = ucfirst($name);
        $cat_name = $name . "sCategory";
        $this->loadModel($name);
        $this->loadModel($cat_name);
        return array("good" => $name , "category" => $cat_name);
    } 

    private function _loadModelsList($name){
        $name = ucfirst($name);
        $this->loadModel($name);
        return array("good" => $name );
    } 

    public function page($name = ""){
        $this->_clearString($name);
        if (empty($name)){
            $this->render("/Pages/index");
        }
        else{
            if (file_exists(APP . "/View/Pages/" . $name . ".ctp")){
                $this->render("/Pages/" . $name);
            }else{
                $this->render("/Pages/404");
            }
        }
    }        

    public function catalog($name,$category,$tovar){
        $this->_clearString($name);
        if ($name){
            $catalog = $this->Catalog->findByTrans($name);
            $this->set("catalog",$catalog);           
            $this->set("name",$name); 
            switch ($catalog['Catalog']['type']) {
                case 0:{
                    $models = $this->_loadModelsList($catalog['Catalog']['trans']);
                    debug($models, $showHtml = null, $showFrom = true);
                    $this->set("models",$models);
                    $this->set("elem","_list");
                    if (empty($category)){
                        $this->set("items",$this->$models['good']->find("all"));
                        $this->set("element","list");

                    }else{
                        $this->_clearString($category);
                        if ($category){
                            $this->set("items",$this->$models['good']->findByTrans($category));
                            $this->set("element","card");
                        }
                    }
                    $this->render("/Catalog/catalog");
                }                    
                break;
                
                case 1:{
                    $models = $this->_loadModels($catalog['Catalog']['trans']);
                    $this->set("models",$models);
                    if (empty($category)){
                        $this->set("items",$this->$models['category']->find("all",array("conditions"=>array($models['category'].".parent_id" => 0),"recursive" => 0)));
                        $this->set("element","category");
                    }else{
                        $this->_clearString($category);
                        if (empty($tovar)&&$category){                            
                            $this->set("items",$this->$models['good']->find("all",array("conditions"=> array($models['category'].".trans" => $category))));
                            $this->set("element","list");
                        }else{
                            $this->_clearString($tovar);
                            if ($tovar){
                                $this->set("items",$this->$models['good']->find("first",array("conditions"=>array($models['good'].".trans" => $tovar, $models['category'].".trans" => $category))));
                                $this->set("element","card");
                            }else{
                                header("HTTP/1.1 404 Not Found"); 
                            }
                        }
                    }                    
                }
                break;

                default:                
                    break;
            }
            $this->set("models",$models);
            $this->render("/Catalog/catalog");
        }        
    }
}
