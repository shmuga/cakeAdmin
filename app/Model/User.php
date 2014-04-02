<?
class User extends AppModel{
    public $belongsTo = array("UsersGroup");
    public $validate = array(
        'login' => array(
        	'rule' => 'isUnique',
        	'message' => 'Виберите другое имя'
        	),
        'password' => 'notEmpty',
        'email' => 'email',
        'users_group_id' =>'notEmpty'
    );
}
?>