<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название:</label>
            <?php echo $this->Form->input('Setting.title', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>
            
            
            <div class="form-group" style="width: 500px;">
            <label>Значение:</label>
                <?php echo $this->Form->input('Setting.value', array('div' => false, 'label'=>false,'size' => '50', 'class'=>'form-control'))?>
            </div>  
                                  
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>