<?php

// select tovar_id from test
// where teg_id in (1, 2, 3)
// group by tovar_id
// having count(*) = 3

class AdminController extends AppController {

    public $uses = array("User","Func","Module","UsersGroup","UsersGroupsFunction","Catalog","Currency",'StolikisCategory','Setting', 'Page');
    public $layout = "main";
    public $helpers = array('Tree');

    private function _clear($arr){        
        array_walk($arr, function($value,$key){
                $arr[$key] = mysql_escape_string($value);
                $arr[$key] = htmlspecialchars($value);
                $arr[$key] = htmlentities($value);
                $arr[$key] = strip_tags($value);                        
        });

        return $arr;
    }

    private function _clearWithoutStrip($arr){        
        foreach ($arr as $key => $value) {            
            if (!is_array($value)){
                $arr[$key] = mysql_escape_string($value);
                $arr[$key] = htmlspecialchars($value);
                $arr[$key] = htmlentities($value);
            }            
            if (empty($value) || $value == ''){                
                unset($arr[$key]);                                
            }       
        }
        
        return $arr;
    }

    private function _clearEmpty($arr){        
        foreach ($arr as $key => $value) {                        
            if (empty($value) || $value == ''){                
                unset($arr[$key]);                                
            }       
        }
        
        return $arr;
    }

    private function _clearString($str){
        $str = mysql_escape_string($str);
        $str = htmlspecialchars($str);
        $str = htmlentities($str);
        $str = strip_tags($str);            
        return $str;
    }

    private function _checkFunction($name){
        if (!array_key_exists("/admin/".$name, $this->funcsAll)){
            $this->redirect("/admin/page404");
        }
    }

    private function _strToUrl($str){
        $tr = array(
            "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g","Д"=>"d",
            "Е"=>"e","Ё"=>"yo","Ж"=>"j","З"=>"z","И"=>"i",
            "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
            "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
            "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"c","Ч"=>"ch",
            "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
            "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"yo","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
            " "=> "-", "."=> "", "/"=> "-"
        );
        return strtr($str,$tr);    
    }

    private function _createCatalog($name) {    
        App::import('Model', 'ConnectionManager');
        $con = new ConnectionManager;
        $cn = $con->getDataSource('default');    
        $cn->query("
                        CREATE TABLE `" . $name . "s_categories` (
                          `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                          `parent_id` int unsigned NOT NULL DEFAULT '0',
                          `lft` int unsigned NOT NULL DEFAULT '0',
                          `rght` int unsigned NOT NULL DEFAULT '0',
                          `name` varchar(128) NOT NULL DEFAULT '',
                          `trans` varchar(128) NOT NULL DEFAULT '',
                          `meta` varchar(1024) NOT NULL DEFAULT '',
                          `title` varchar(128) NOT NULL DEFAULT ''
                        ) COMMENT='' ENGINE='InnoDB';
        ");
        $cn->query("ALTER TABLE `". $name . "s_categories`");
        $cn->query("
                        CREATE TABLE `" . $name . "s` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(256) NOT NULL DEFAULT '',
                          `trans` varchar(256) NOT NULL DEFAULT '',
                          `title` varchar(256) NOT NULL DEFAULT '',
                          `meta` varchar(1024) NOT NULL DEFAULT '',
                          `" . $name . "s_category_id` int(10) unsigned NOT NULL,
                          `string_1` varchar(256) NOT NULL DEFAULT '',
                          `string_2` varchar(256) NOT NULL DEFAULT '',
                          `number_1` float NOT NULL DEFAULT '0',
                          `number_2` float NOT NULL DEFAULT '0',
                          `dateend` date NOT NULL DEFAULT '0000-00-00',
                          `stock` varchar(128) NOT NULL DEFAULT '',
                          `map` varchar(128) NOT NULL DEFAULT '',
                          `articul` varchar(128) NOT NULL DEFAULT '',
                          `oldprice` float unsigned NOT NULL DEFAULT '0',
                          `image` varchar(128) NOT NULL DEFAULT '',
                          `price` float unsigned NOT NULL DEFAULT '0',
                          `short_description` varchar(1024) NOT NULL DEFAULT '',
                          `currency_id` int(11) NULL,                          
                          `count` int(10) unsigned NOT NULL DEFAULT '0',
                          `description` varchar(4096) NOT NULL DEFAULT '',
                          PRIMARY KEY (`id`),
                           FOREIGN KEY (`" . $name . "s_category_id`) REFERENCES `" . $name . "s_categories` (`id`) ON DELETE CASCADE,
                           FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE                           
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                            ");
        $cn->query("ALTER TABLE `". $name . "s`");
        $name = ucfirst($name);
        $data = '
                    <?
                        class ' . $name . 'sCategory extends AppModel{
                            public $name = "' . $name . 'sCategory";
                            public $hasMany = array("' . $name . '");
                            public $actsAs = array("Tree");
                            public $useTable = "' . strtolower($name) . 's_categories";
                        }
                    ?>
                ';
        $data = trim($data);
        file_put_contents(APP."Model/" . $name . "sCategory.php", $data);
        $data = '
                    <?
                        class ' . $name . ' extends AppModel{   
                            public $name = "' . $name . '";                         
                            public $belongsTo = array("' . $name . 'sCategory","Currency");
                            public $useTable = "' . strtolower($name). 's";
                        }
                    ?>
                ';
        $data = trim($data);
        file_put_contents(APP."Model/" . $name . ".php", $data);
        return true;
    }

    private function _deleteCatalog($name){
        $this->User->query("DROP TABLE `" . $name . "s`");
        $this->User->query("DROP TABLE `" . $name . "s_categories`");
        $name = ucfirst($name);
        unlink(APP."Model/" . $name . "sCategory.php");
        unlink(APP."Model/" . $name . ".php");
    }

    private function _createList($name){
        $this->User->query("
                        CREATE TABLE `" . $name . "s` (
                          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(256) NOT NULL DEFAULT '',
                          `trans` varchar(256) NOT NULL DEFAULT '',
                          `title` varchar(256) NOT NULL DEFAULT '',
                          `meta` varchar(1024) NOT NULL DEFAULT '',
                          `string_1` varchar(256) NOT NULL DEFAULT '',
                          `string_2` varchar(256) NOT NULL DEFAULT '',
                          `number_1` float NOT NULL DEFAULT '0',
                          `number_2` float NOT NULL DEFAULT '0',
                          `dateend` date NOT NULL DEFAULT '0000-00-00',
                          `stock` varchar(128) NOT NULL DEFAULT '',
                          `map` varchar(128) NOT NULL DEFAULT '',
                          `articul` varchar(128) NOT NULL DEFAULT '',
                          `oldprice` float unsigned NOT NULL DEFAULT '0',
                          `image` varchar(128) NOT NULL DEFAULT '',
                          `price` float unsigned NOT NULL DEFAULT '0',
                          `short_description` varchar(1024) NOT NULL DEFAULT '',
                          `currency_id` int(11) NULL,                          
                          `count` int(10) unsigned NOT NULL DEFAULT '0',
                          `description` varchar(4096) NOT NULL DEFAULT '',
                          PRIMARY KEY (`id`),
                           FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE                           
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                            ");
        $this->User->query("ALTER TABLE `". $name . "s`");
        $name = ucfirst($name);
        $data = '
                    <?
                        class ' . $name . ' extends AppModel{              
                            public $name = "' . $name . '";                
                            public $belongsTo = array("Currency");
                            public $useTable = "' . strtolower($name). 's";
                        }
                    ?>
                ';
        $data = trim($data);
        file_put_contents(APP."Model/" . $name . ".php", $data);
        return true;
    }

    private function _deleteList($name){
        $this->User->query("DROP TABLE `" . $name . "s`");      
        $name = ucfirst($name);        
        unlink(APP."Model/" . $name . ".php");
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

    public function page404(){        
    }   

    public function index() {

       $this->layout = "ajax";
       //перевірка на пустоту введення данних при авторизації
       if (!empty($this->request->data)){
            if (empty($this->request->data['User']['login'])){                
                $this->Session->setFlash("Введите логин.");
                $this->render();
            }
            if (empty($this->request->data['User']['password'])){                
                $this->Session->setFlash("Введите пароль.");
                $this->render();
            }
            //очистка від інєкцій
            $this->request->data['User'] = $this->_clear($this->request->data['User']);
            //якщо є юзер то записуємо його в сесію
            $u = $this->User->find("first",array("conditions" => array("User.login" => $this->request->data['User']['login'], "User.password" => sha1($this->request->data['User']['password']))));
            if ($u){
                $this->Session->write("user",$u['User']['id']);
                $this->redirect("/admin/home");
            }
       }
    }

    public function logout(){
        $this->Session->delete("user");
        $this->redirect("/admin/");
    }
    

    public function home(){
        
    }

    //user
    public function userslist(){        
        $this->_checkFunction('userslist');
        $this->set("items",$this->User->find("all"));
    }

    public function useradd() {
        $this->_checkFunction('useradd');
        $this->set('groups', $this->UsersGroup->find("list"));
        if (!empty($this->request->data)) {
            $this->request->data['User'] = $this->_clear($this->request->data['User']);
            $this->request->data['User']['password'] = sha1($this->request->data['User']['password']);
            if ($this->User->save($this->request->data['User'], true)){
                $this->redirect("/admin/userslist");
            } else {
                unset($this->request->data['User']['password']);
            }
        }
    }

    public function useredit($id) {
        $this->_checkFunction('useredit');
        $id = $id / 1;
        $this->set('groups', $this->UsersGroup->find("list"));
        if (!empty($this->request->data)) {
            $this->request->data['User'] = $this->_clear($this->request->data['User']);
            $this->request->data['User']['password'] = sha1($this->request->data['User']['password']);
            $this->request->data['User']['id'] = $id;
            if ($this->User->save($this->request->data['User'], true)){
                $this->redirect("/admin/userslist");
            } else {
                unset($this->request->data['User']['password']);
            }
        } else {
            $us = $this->User->findById($id);
            unset($us['User']['password']);
            $this->request->data = $us;
        }
    }

    public function userdelete($id) {
        $this->_checkFunction('userdelete');
        $id = $id / 1;
        $this->User->delete($id);
        $this->redirect("/admin/userslist");
    }

    public function userstatus($user,$status){
        $user /= 1;
        $status /= 1;
        $this->_checkFunction($this->action);
        $this->User->id = $user;
        $this->User->saveField("active",$status);
        $this->redirect("/admin/userslist");
    }

    public function usersgroupslist() {
        $this->_checkFunction('usersgroupslist');   
        $this->set("items",$this->UsersGroup->find("list"));
    }

    public function usersgroupadd() {
        $this->_checkFunction('usersgroupadd');   
        if (!empty($this->request->data)) {
            $this->request->data['UsersGroup'] = $this->_clear($this->request->data['UsersGroup']);
            if ($this->UsersGroup->save($this->request->data['UsersGroup'], true)){
                $id = $this->UsersGroup->getLastInsertID();        
                 foreach ($this->request->data['UsersGroupsFunction']['func_id'] as $key=>$value){
                    $arr['users_group_id'] = $id;
                    $arr['func_id'] = $value *1;          
                    $this->UsersGroupsFunction->save($arr);
                    $this->UsersGroupsFunction->id = null;
                }   
                unset($this->request->data);
                $this->redirect("/admin/usersgroupslist");
            }
        }else{
            $select = $this->Func->find("list",array("fields" => array("Func.id","Func.title","Module.title"),"recursive" => 1));
            $this->set("select",$select);
        }
    }

    public function usersgroupedit($id) {
        $this->_checkFunction('usersgroupedit');
        $id = $id / 1;
        if (!empty($this->request->data)) {
            $this->request->data['UsersGroup'] = $this->_clear($this->request->data['UsersGroup']);
            $this->request->data['UsersGroup']['id'] = $id;
            if ($this->UsersGroup->save($this->request->data['UsersGroup'], true)){
                $this->UsersGroupsFunction->deleteAll(array("UsersGroupsFunction.users_group_id" =>$id));
                foreach ($this->request->data['UsersGroupsFunction']['func_id'] as $key=>$value){
                    $arr['users_group_id'] = $id;
                    $arr['func_id'] = $value *1;          
                    $this->UsersGroupsFunction->save($arr);
                    $this->UsersGroupsFunction->id = null;
                }   
                $this->redirect("/admin/usersgroupslist");
            }
        } else {
            $us = $this->UsersGroup->findById($id);
            $select = $this->Func->find("list",array("fields" => array("Func.id","Func.title","Module.title"),"recursive" => 1));
            $selected = $this->UsersGroupsFunction->find("list",array("conditions" => array("UsersGroupsFunction.users_group_id" => $id),"fields" => array("UsersGroupsFunction.func_id")));            
            array_walk($selected, function(&$v){$v=(int)$v;});
            $this->set("select",$select);
            $this->set("selected",array_values($selected));
            $this->request->data = $us;
        }
    }

    public function usersgroupdelete($id) {    
        $this->_checkFunction('usersgroupdelete');
        $id = $id / 1;
        $this->UsersGroup->delete($id);
        $this->redirect("/admin/usersgroupslist");
    }

    public function pagelist(){
        $this->_checkFunction($this->action);
        $this->set("items", $this->Page->find('all'));
    }


    public function pageadd(){
        $this->_checkFunction($this->action);
        if ($handle = opendir(APP . "View/Layouts/")) {        
            while (false !== ($entry = readdir($handle))) {
                if (strlen($entry)>4){
                    $arr[$entry] = $entry;
                }
            }
        }
        $this->set('layouts', $arr);
        if (!empty($this->request->data)){
            $filename = $this->request->data['title'];
            $filename = $this->_strToUrl($filename);
            $filename = str_replace("..", "", $filename);
            $filename = str_replace(".", "", $filename);
            $filename = str_replace("/", "", $filename);
            $filename = str_replace("\\", "", $filename);    
            if (file_exists(APP . "View/Pages/" . $filename . ".ctp")){
                $this->Session->setFlash("Файл уже существует.");
            }else{
                $file = $this->request->data['file'];
                file_put_contents(APP . "View/Pages/" . $filename . ".ctp", $file);
                $this->Page->create();
                $this->request->data['filename'] = $filename;
                $this->Page->save($this->request->data);
                $this->redirect("/admin/pagelist");
            }
        }
    }

    public function pageedit($name){
        $this->_checkFunction($this->action);
        $name = str_replace(".ctp", "", $name);            
        $name = str_replace("..", "", $name);
        $name = str_replace(".", "", $name);
        $name = str_replace("/", "", $name);
        $name = str_replace("\\", "", $name); 
        $p = $this->Page->find('first', array('conditions' => array('filename' => $name)));
        if ($handle = opendir(APP . "View/Layouts/")) {        
            while (false !== ($entry = readdir($handle))) {
                if (strlen($entry)>4){
                    $arr[$entry] = $entry;
                }
            }
        }
        $this->set('layouts', $arr);
        if (empty($this->request->data)){
            $this->request->data['filename'] = $name;
            $this->request->data['file'] = file_get_contents(APP . "View/Pages/" . $name . ".ctp");
            $this->request->data['title'] = $p['Page']['title'];
            $this->request->data['meta'] = $p['Page']['meta'];
            $this->request->data['layout'] = $p['Page']['layout'];
        }
        else{            
            $filename = $this->request->data['title'];
            $filename = $this->_strToUrl($filename);
            $filename = str_replace("..", "", $filename);
            $filename = str_replace(".", "", $filename);
            $filename = str_replace("/", "", $filename);
            $filename = str_replace("\\", "", $filename);               
            $file = $this->request->data['file'];
            if (file_exists(APP . "View/Pages/" . $name . ".ctp")){
                unlink(APP . "View/Pages/" . $name . ".ctp");
            }
            file_put_contents(APP . "View/Pages/" . $filename . ".ctp", $file);
            $this->Page->id = $p['Page']['id'];
            $this->request->data['filename'] = $filename;
            $this->Page->save($this->request->data);
            $this->redirect("/admin/pagelist");                        
        }
    }

    public function pagedelete($name){
        $this->_checkFunction($this->action);
        $name = str_replace(".ctp", "", $name);
        $name = str_replace("..", "", $name);
        $name = str_replace(".", "", $name);
        $name = str_replace("/", "", $name);
        $name = str_replace("\\", "", $name);
        $p = $this->Page->find('first', array('conditions' => array('filename' => $name)));        
        if (file_exists(APP . "View/Pages/" . $name . ".ctp")){
            unlink(APP . "View/Pages/" . $name . ".ctp");
            $this->Page->delete($p['Page']['id']);
        }
        $this->redirect("/admin/pagelist");
    }


    public function cataloglist(){
        $this->_checkFunction($this->action);
        $this->set("items",$this->Catalog->find("all"));        
    }

    public function catalogadd(){
        $this->_checkFunction($this->action);
        
        $fields = array(
                "Все" => array(
                        "string_1" => "Дополнительная строка 1", 
                        "string_2" => "Дополнительная строка 2",
                        "number_1" => "Дополнительное число 1",
                        "number_2" => "Дополнительное число 2",
                        "dateend" => "Дата окончания",
                        "stock" => "Наличие товара",
                        "map" => "Геолокация",
                        "articul" => "Артикул",
                        "oldprice" => "Старая цена",
                        "price" => "Цена",
                        "currency_id" => "Валюта",
                        "image" => "Картинка",
                        "count" => "Количество",
                        "short_description" => "Краткое описание",
                        "description" => "Описание"
                    )
            );
        $this->set("fields",$fields);   

        $types = array("Список", "Многоуровневый");
        $this->set("types",$types);

        if ($handle = opendir(APP . "View/Layouts/")) {        
            while (false !== ($entry = readdir($handle))) {
                if (strlen($entry)>4){
                    $arr[$entry] = $entry;
                }
            }
        }
        $this->set('layouts', $arr);

        if (empty($this->request->data)){            
            $this->render();
        }else{
            $c = $this->request->data['Catalog'];
            $c['showfields'] = implode(";", $c['showfields']);
            $c['trans'] = $this->_strToUrl($c['name']);
            if(empty($c['title'])){
                $c['title'] = $c['name'];
            }
            $c['layout'] = $this->request->data['layout'];
            $this->request->data['Catalog'] = $c;            
            if($this->Catalog->save($this->request->data)){            
                $max = $this->Module->query("SELECT MAX(`Module`.`order`) max FROM modules as Module");
                $max = $max[0][0]['max'] + 1; 

                $m['Module']['order'] = $max;
                $m['Module']['title'] = $c['name'];
                $this->Module->save($m);
                $module = $this->Module->getLastInsertID();

                if ($c['type'] == 1){
                    $funcs = array(
                      "/admin/categorieslist/" . $c['trans']  => "Список категорий" ,
                      "/admin/categoriesadd/" . $c['trans']  => "Добавить категорию" ,
                      "/admin/categoriesedit/" . $c['trans']  => "Редактировать категорию" ,
                      "/admin/categoriesdelete/" . $c['trans']  => "Удалить категорию" ,
                      "/admin/goodlist/" . $c['trans']  => "Список товаров" ,
                      "/admin/goodadd/" . $c['trans']  => "Добавить товар" ,
                      "/admin/goodedit/" . $c['trans']  => "Редактировать товар" ,
                      "/admin/gooddelete/" . $c['trans']  => "Удалить товар"                      
                    );   
                    $this->_createCatalog($c['trans']);  
                    $this->User->query("ALTER TABLE `". $c['trans'] . "s`");
                    $this->User->query("ALTER TABLE `". $c['trans'] . "s_categories`");

                }else{
                    $funcs = array(
                      "/admin/lists/" . $c['trans']  => "Список товаров" ,
                      "/admin/listsadd/" . $c['trans']  => "Добавить товар" ,
                      "/admin/listsedit/" . $c['trans']  => "Редактировать товар" ,
                      "/admin/listsdelete/" . $c['trans']  => "Удалить товар"     
                    );
                    $this->_createList($c['trans']);
                    $this->User->query("ALTER TABLE `". $c['trans'] . "s`");
                }

                foreach ($funcs as $key => $value) {
                        $func['Func']['title'] = $value;
                        $func['Func']['name'] = $key;
                        $func['Func']['module_id'] = $module;
                        if (strstr($key,"categorieslist")||strstr($key, "goodlist")||strstr($key,"/lists/")){
                            $func['Func']['menu'] = 1;
                        }else{
                            $func['Func']['menu'] = 0;
                        }
                        if($this->Func->save($func)){
                            $f = $this->Func->getLastInsertID();
                            $ugf['UsersGroupsFunction']['users_group_id'] = 1;
                            $ugf['UsersGroupsFunction']['func_id'] = $f;
                            $this->UsersGroupsFunction->save($ugf);
                            $this->UsersGroupsFunction->id = null;
                            unset($func);
                            $this->Func->id = null;
                        }
                }
                $this->redirect("/admin/cataloglist");
            }else{
                $this->Session->setFlash("Ощибка при записи.");
                $this->redirect("/admin/catalogadd");
            }
            
        }        

    }

    public function catalogdelete($id){
        $this->_checkFunction($this->action);
        $catalog = $this->Catalog->findById($id);
        $this->Module->deleteAll(array("Module.title" => $catalog['Catalog']['name']));
        switch ($catalog['Catalog']['type']) {
            case 1: 
                $this->_deleteCatalog($catalog['Catalog']['trans']);
                break;
            case 0: 
                $this->_deleteList($catalog['Catalog']['trans']);
                break;            
            default:
                break;
        }
        $this->Catalog->delete($id);
        $this->redirect("/admin/cataloglist");
    }

    public function categorieslist($name){
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);

        $this->set("name",$name);
        $this->set("models",$models);
        $this->set("items",$this->$models['category']->find('threaded', array('recursive' => 0)));        
    }

    public function categoriesadd($name,$parent){
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);        
        $parent /= 1;
        if (empty($this->request->data)){   

        }else{
            $this->_clearWithoutStrip($this->request->data[$models['category']]);
            $this->request->data[$models['category']]['parent_id'] = $parent;
            if (isset($this->request->data[$models['category']]['name'])){
                $this->request->data[$models['category']]['trans'] = $this->_strToUrl($this->request->data[$models['category']]['name']);                
            }
            if($this->$models['category']->save($this->request->data)){
                $this->redirect("/admin/categorieslist/".$name);
            }else{
                $this->Session->setFlash("Ошибка при сохранении");
            }
        }
        $this->set("name",$name);
        $this->set("models",$models);    
    }

    public function categoriesedit($name,$id){
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);        
     
    }

    public function categoriesdelete($name,$id){
        $id /=1;
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);
        $this->$models['category']->id = $id;
        $this->$models['category']->delete();
        $this->redirect("/admin/categorieslist/".$name);  
    }

    public function goodlist($name,$category){
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);        
        $name = $this->_clearString($name);

        $catalog = $this->Catalog->find("first",array("conditions" => array("Catalog.trans" => $name)));
        $this->set("catalog",$catalog);

        $fields = explode(";", $catalog['Catalog']['showfields']);
        $this->set("fields",$fields);

        $this->set("models",$models);
        $this->set("name",$name);

        if (empty($category)){
            $this->set("items",$this->$models['good']->find("all"));
        }else{
            $this->set("items",$this->$models['good']->find("all",array("conditions" => array($models['good'] . "." . $name ."s_category_id" => $category))));
        }
    }

    public function goodadd($name){
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);        
        $name = $this->_clearString($name);

        $catalog = $this->Catalog->find("first",array("conditions" => array("Catalog.trans" => $name)));
        $this->set("catalog",$catalog);

        $fields = explode(";", $catalog['Catalog']['showfields']);
        $this->set("fields",$fields);
        $this->set("models",$models);
        $this->set("name",$name);

        $currency = $this->Currency->find("list",array("fields" => array("Currency.id","Currency.name")));
        $this->set("currency",$currency);

        $this->set('category', $this->$models['category']->find('threaded', array('recursive' => 0)));        

        if (empty($this->request->data)){

        }
        else{
            $this->request->data[$models['good']] = $this->_clearEmpty($this->request->data[$models['good']]);
            if (isset($this->request->data[$models['good']]['name'])){
                $this->request->data[$models['good']]['trans'] = $this->_strToUrl($this->request->data[$models['good']]['name']);                
            }
            
            if($this->$models['good']->save($this->request->data)){                
                $this->redirect("/admin/goodlist/" . $name);
            }else{
                $this->Session->setFlash("Ошибка при сохранении");
            }

        }
    }

    public function goodedit($name,$id){
        $this->_checkFunction($this->action);
        $models = $this->_loadModels($name);        
        $name = $this->_clearString($name);
        $id = $id / 1;
        $catalog = $this->Catalog->find("first",array("conditions" => array("Catalog.trans" => $name)));
        $this->set("catalog",$catalog);

        $fields = explode(";", $catalog['Catalog']['showfields']);
        $this->set("fields",$fields);
        $this->set("models",$models);
        $this->set("name",$name);

        $currency = $this->Currency->find("list",array("fields" => array("Currency.id","Currency.name")));
        $this->set("currency",$currency);

        $this->set('category', $this->$models['category']->find('threaded', array('recursive' => 0)));

        if (empty($this->request->data)){
            $this->request->data = $this->$models['good']->findById($id);
        }
        else{
            $this->request->data[$models['good']] = $this->_clearWithoutStrip($this->request->data[$models['good']]);
            if (isset($this->request->data[$models['good']]['name'])){
                $this->request->data[$models['good']]['trans'] = $this->_strToUrl($this->request->data[$models['good']]['name']);                
            }
            $this->request->data[$models['good']]['id'] = $id;
            if($this->$models['good']->save($this->request->data)){                
                $this->redirect("/admin/goodlist/" . $name);
            }else{
                $this->Session->setFlash("Ошибка при сохранении");
            }

        }
    }

    public function gooddelete($name,$id){
        $this->_checkFunction($this->action);
        $id = $id / 1;
        $models = $this->_loadModels($name);
        $this->$models['good']->delete($id);
        $this->redirect("/admin/goodlist/" .$name);
    }

    public function lists($name,$category){
        $this->_checkFunction($this->action);
        $models = $this->_loadModelsList($name);        
        $name = $this->_clearString($name);

        $catalog = $this->Catalog->find("first",array("conditions" => array("Catalog.trans" => $name)));
        $this->set("catalog",$catalog);

        $fields = explode(";", $catalog['Catalog']['showfields']);
        $this->set("fields",$fields);

        $this->set("models",$models);
        $this->set("name",$name);

        if (empty($category)){
            $this->set("items",$this->$models['good']->find("all"));
        }else{
            $this->set("items",$this->$models['good']->find("all",array("conditions" => array($models['good'] . "." . $name ."s_category_id" => $category))));
        }
    }

    public function listsadd($name){
        $this->_checkFunction($this->action);
        $models = $this->_loadModelsList($name);        
        $name = $this->_clearString($name);

        $catalog = $this->Catalog->find("first",array("conditions" => array("Catalog.trans" => $name)));
        $this->set("catalog",$catalog);

        $fields = explode(";", $catalog['Catalog']['showfields']);
        $this->set("fields",$fields);
        $this->set("models",$models);
        $this->set("name",$name);

        $currency = $this->Currency->find("list",array("fields" => array("Currency.id","Currency.name")));
        $this->set("currency",$currency);


        if (empty($this->request->data)){

        }
        else{
            $this->request->data[$models['good']] = $this->_clearEmpty($this->request->data[$models['good']]);
            if (isset($this->request->data[$models['good']]['name'])){
                $this->request->data[$models['good']]['trans'] = $this->_strToUrl($this->request->data[$models['good']]['name']);                
            }
            
            if($this->$models['good']->save($this->request->data)){                
                $this->redirect("/admin/lists/" . $name);
            }else{
                $this->Session->setFlash("Ошибка при сохранении");
            }

        }
    }

    public function listsedit($name,$id){
        $id = $id / 1;
        $this->_checkFunction($this->action);
        $models = $this->_loadModelsList($name);        
        $name = $this->_clearString($name);

        $catalog = $this->Catalog->find("first",array("conditions" => array("Catalog.trans" => $name)));
        $this->set("catalog",$catalog);

        $fields = explode(";", $catalog['Catalog']['showfields']);
        $this->set("fields",$fields);
        $this->set("models",$models);
        $this->set("name",$name);

        $currency = $this->Currency->find("list",array("fields" => array("Currency.id","Currency.name")));
        $this->set("currency",$currency);


        if (empty($this->request->data)){
            $this->request->data = $this->$models['good']->findById($id);
        }
        else{
            $this->request->data[$models['good']] = $this->_clearWithoutStrip($this->request->data[$models['good']]);
            if (isset($this->request->data[$models['good']]['name'])){
                $this->request->data[$models['good']]['trans'] = $this->_strToUrl($this->request->data[$models['good']]['name']);                
            }
            $this->request->data[$models['good']]['id'] = $id;
            if($this->$models['good']->save($this->request->data)){                
                $this->redirect("/admin/lists/" . $name);
            }else{
                $this->Session->setFlash("Ошибка при сохранении");
            }

        }
    }

    public function listsdelete($name,$id){
        $this->_checkFunction($this->action);
        $id = $id / 1;
        $models = $this->_loadModelsList($name);
        $this->$models['good']->delete($id);
        $this->redirect("/admin/lists/" .$name);
    }



    public function test(){
        
        $this->layout = "ajax";
        $this->render("home");
    }

    public function settings(){
        $this->_checkFunction($this->action);
        $this->set("items",$this->Setting->find("all"));
    }

    public function settingsadmin(){
        $this->_checkFunction($this->action);
        $this->set("items",$this->Setting->find("all"));
    }

    public function settingsadd(){
        $this->_checkFunction($this->action);
        $this->set("items",$this->Setting->find("list"));
        if (!empty($this->request->data)) {
            $this->request->data['Setting'] = $this->_clear($this->request->data['Setting']);
            $this->request->data['Setting']['param'] = $this->_strToUrl($this->request->data['Setting']['title']);
            if ($this->Setting->save($this->request->data)){
                $this->redirect("/admin/settingsadmin");
            }            
        }
    }

    public function settingssave(){
        $this->_checkFunction($this->action);
        foreach ($this->request->data['Setting'] as $key => $value) {
            $s['Setting']['id'] = $key;
            $s['Setting']['value'] = $value;            
            $this->Setting->save($s);
            $this->Setting->id = null;
        }
        $this->redirect($this->referer());
    }

    public function settingsdelete($id){
        $this->_checkFunction($this->action);
        $this->Setting->delete($id);
        $this->redirect("/admin/settingsadmin");
    }

    public function createtree() {
        $this->set('cat', $this->StolikisCategory->find('threaded', array('recursive' => 0)));
    }

    public function changepassword(){
        //перевірка на пустоту введених данних
        if(!empty($this->request->data)){
            $this->request->data = $this->_clearWithoutStrip($this->request->data);
            // перевірка старого паролю  
            if($this->User->find("all",array("conditions"=>array("User.id"=>$this->userData['User']['id'],"User.password"=>sha1($this->request->data['oldpass']))))){
                // перевырка на однаковысть нових паролыв
                if($this->request->data['newpassword'] === $this->request->data['newpasswordrepeat']){
                    // перевірка на шаблон
                    if(preg_match("/^([a-zA-Z,\.\-\?!]*)$/",$this->request->data['newpassword'])){
                        $this->userData['User']['password'] = sha1($this->request->data['newpassword']);
                        $this->User->save($this->userData['User']);
                        unset($this->request->data);
                        $this->Session->setFlash("Пароль сохранен успешно.");
                    }else{
                        $this->Session->setFlash("Введите пароль согласно шаблону.");
                    }
                }else{
                    $this->Session->setFlash("Пароли не одинаковые.");
                }
            }else{
                $this->Session->setFlash("Введите правильный старый пароль");                
            }

        }
        $this->render();
    }
}

