<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название:</label>
            <?php echo $this->Form->input($models['good'] . '.name', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>

            <div class="form-group" style="width: 500px;">
            <label>Загловок (title):</label>
            <?php echo $this->Form->input($models['good'] . '.title', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>
            
            <?if(array_search("articul", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Артикул:</label>
                <?php echo $this->Form->input($models['good'] . '.articul', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <div class="form-group" style="width: 500px;">
            <label>Мета:</label>
            <?php echo $this->Form->textarea($models['good'] . '.meta', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
            </div>
            
            
            <div class="form-group" style="width: 500px;">
            <label>Категория:</label>            
                <script>$('#cat0').collapse();</script>
                <?php
                    $this->Tree->genTreeRadio($models['category'], $category ,array($models['good'],$name . "s_category_id"));        
                ?>
            </div>   
            
            <?if(array_search("image", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Картинка:</label>
                <?php echo $this->Form->input($models['good'] . '.image', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>
           
           <?if(array_search("short_description", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Краткое описание:</label>
                <?php echo $this->Form->input($models['good'] . '.short_description', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("description", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Описание:</label>
                <?php echo $this->Form->input($models['good'] . '.description', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("price", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Цена:</label>
                <?php echo $this->Form->input($models['good'] . '.price', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("oldprice", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Старая цена:</label>
                <?php echo $this->Form->input($models['good'] . '.oldprice', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("currency", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Валюта:</label>
                <?php echo $this->Form->select($models['good'] . '.currency_id',$currency, array('div' => false, 'label'=>false, 'empty' => false,'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("count", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Количество:</label>
                <?php echo $this->Form->input($models['good'] . '.count', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("map", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Привязка к карте:</label>
                <?php echo $this->Form->input($models['good'] . '.map', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("dateend", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Дата:</label>
                <?php echo $this->Form->input($models['good'] . '.dateend', array('div' => false, 'label'=>false))?>
                </div>
            <?endif;?>

            <?if(array_search("string_1", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Дополнительная строка 1:</label>
                <?php echo $this->Form->input($models['good'] . '.string_1', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("string_2", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Дополнительная строка 2:</label>
                <?php echo $this->Form->input($models['good'] . '.string_2', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("number_1", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Дополнительное число 1:</label>
                <?php echo $this->Form->input($models['good'] . '.number_1', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>

            <?if(array_search("number_2", $fields) !== false):?>
                <div class="form-group" style="width: 500px;">
                <label>Дополнительное число 1:</label>
                <?php echo $this->Form->input($models['good'] . '.number_2', array('div' => false, 'label'=>false, 'class'=>'form-control'))?>
                </div>
            <?endif;?>
              
                
            <div class="form-actions">
            <button type="submit" role="button" onclick="document.forms[0].submit();" class="btn btn-primary">Сохранить</button>
            </div>
        </form>   
    </div>
</div>