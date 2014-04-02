<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $uses = array("User","Func","Module","UsersGroup","UsersGroupsFunction","Setting");
	public $components = array('DebugKit.Toolbar','Session');

    public $modules = array();
    public $funcsAll = array();
    public $funcsMenu = array();
    public $currentModule = 0;

    public function beforeFilter() {    

        $userid = $this->Session->read("user"); 
        if ((mb_strtolower($this->name)=="admin")&&(($this->params['action']!="index")&&($this->params['action']!="logout"))) {
            if ((!isset($userid))||($userid=="")) {
                $this->redirect("/");
                exit();
            }
            else {
                $user = $this->User->findById($userid);
                if ($user['User']['id']=="") {
                    $this->redirect("/");
                    exit();
                }
                else {
                    $this->userData = $user;        
                    if($user['User']['active'] == 0){
                        $this->Session->delete("user");
                        $this->redirect("/admin/");
                    }
                    $this->modules = $this->Module->query("
                            SELECT * 
                            FROM modules
                            WHERE modules.id IN (
                                    SELECT DISTINCT module_id 
                                    FROM funcs
                                    WHERE funcs.id IN(
                                            SELECT DISTINCT func_id id 
                                            FROM users_groups_functions
                                            WHERE users_group_id=" . $user['User']['users_group_id'] . "
                                        )
                                    AND funcs.menu=1
                                )
                        ");  

                    $this->funcsMenu = $this->UsersGroupsFunction->find("list",array(  
                             'fields' => array("Func.module_id","Func.title","Func.name"),
                             'conditions' => array('UsersGroupsFunction.users_group_id' => $user['User']['users_group_id'],'Func.menu' => 1),
                             'recursive' =>2
                        ));   

                    $this->funcsAll = $this->UsersGroupsFunction->find("list",array( 
                             'fields' => array("Func.module_id","Func.title","Func.name"),
                             'conditions' => array('UsersGroupsFunction.users_group_id' => $user['User']['users_group_id']),
                             'recursive' =>2
                        ));

                    $this->set("userData", $this->userData);
                    $this->set("modules", $this->modules);
                    $this->set("funcsMenu", $this->funcsMenu);
                    $this->set("funcsAll", $this->funcsAll);

                }
            }
        }
    }

    public function beforeRender() {    
        if ((mb_strtolower($this->name)=="admin")&&($this->params['action']!="login")) {   
            if (array_key_exists("/admin/" . $this->action,$this->funcsAll))
                $this->currentModule  = array_keys($this->funcsAll["/admin/" . $this->action]);
            $this->set("currentModule", $this->currentModule);             
            $this->set("modules", $this->modules);
            $this->set("funcsMenu", $this->funcsMenu);
            $this->set("userData", $this->userData);
        }
        $this->set("settings",$this->Setting->find("list",array("fields"=>array("Setting.param","Setting.value"))));    
    }
}
