<?
class UsersGroup extends AppModel{
    public $hasOne = array("User");
    public $validate = array(
        'title' => array(
        	'rule' => 'isUnique',
        	'message' => 'Виберите другое имя'
        	)
    );
}
?>