<?=$this->Session->flash('flash',array('element' => 'failure'));?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <p>Пароль Наявність рядкових і прописних букв, а також розділових знаків.</p>
            <div class="form-group" style="width: 500px;">
            <label>Старый пароль:</label>
            <?php echo $this->Form->input('oldpass', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>
            
            
            <div class="form-group" style="width: 500px;">
            <label>Пароль:</label>
                <?php echo $this->Form->input('newpassword', array('div' => false, 'label'=>false,'size' => '50', 'class'=>'form-control', 'type'=>'password'))?>
            </div>  
            
            
            <div class="form-group" style="width: 500px;">
            <label>Повторите пароль:</label>
            <?php echo $this->Form->input('newpasswordrepeat', array('div' => false, 'label'=>false,'size' => '50', 'class'=>'form-control','type'=>'password'))?>
            </div>
            
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>