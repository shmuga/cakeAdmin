<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название:</label>
            <?php echo $this->Form->input($models['category'] . '.name', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>

            <div class="form-group" style="width: 500px;">
            <label>Загловок (title):</label>
            <?php echo $this->Form->input($models['category'] . '.title', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>        

            <div class="form-group" style="width: 500px;">
            <label>Мета:</label>
            <?php echo $this->Form->textarea($models['category'] . '.meta', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
            </div>
            
            <?php echo $this->Form->input($models['category'] . '.parent_id', array('div' => false, 'label'=>false, 'type' => 'hidden'))?>
                   
                
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>