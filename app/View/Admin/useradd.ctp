<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Логин:</label>
            <?php echo $this->Form->input('User.login', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>
            
            
            <div class="form-group" style="width: 500px;">
            <label>Пароль:</label>
                <?php echo $this->Form->input('User.password', array('div' => false, 'label'=>false,'size' => '50', 'class'=>'form-control', 'type'=>'password'))?>
            </div>  
            
            
            <div class="form-group" style="width: 500px;">
            <label>E-mail:</label>
            <?php echo $this->Form->input('User.email', array('div' => false, 'label'=>false,'size' => '50', 'class'=>'form-control'))?>
            </div>
            
            
            <div class="form-group" style="width: 500px;">
            <label>Группа пользователя:</label>
            <?php echo $this->Form->select('User.users_group_id',$groups,array('empty'=>false,'div' => false, 'label'=>false,'class'=>'form-control'))?>
            </div>
                
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>