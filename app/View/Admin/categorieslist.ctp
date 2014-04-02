<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/categoriesadd/<?=$name?>/0" title="Добавить">Добавить новую</a>
        </p>
        <?if($flash = $this->Session->flash()):?>
        <div class="bs-callout bs-callout-danger">
            <h4>Ошибка!</h4>
            <p><?=$flash;?></p>
        </div>
        <?endif;?>
        <script>$('#cat0').collapse();</script>
        <?php
            $this->Tree->genTree($models['category'], $items);        
        ?>
    </div>
</div>
