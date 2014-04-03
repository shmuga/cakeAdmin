<!-- <script type="text/javascript" src="/js"></script> -->
<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div>
                <label>Заголовок(заголовок страницы в браузере)</label>
                <input type="text" class="form-control" name="data[title]">
            </div>
            <div>
                <label>Шаблон</label>
                <?php echo $this->Form->input('layout', array('div'=>false,'label'=>false,'class'=>'form-control'));?>
            </div>
            <div>
                <label>META теги(для SEO)</label>
                <?php echo $this->Form->input('meta', array('div'=>false,'label'=>false,'class'=>'form-control', 'type'=>'textarea'))?>
            </div>
            <div class="form-group">
            <label>Страница:</label>
                <textarea class="form-control ckeditor" name="data[file]" id="file"></textarea>
            </div>    
            <script type="text/javascript">
                    var ck_newsArticle = CKEDITOR.replace( 'file',{height:'500'});
            </script>           
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>