<!-- <script type="text/javascript" src="/js"></script> -->
<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название(будет вводиться в адресную строку)</label>
                <?php echo $this->Form->input('filename', array('div'=>false,'label'=>false,'class'=>'form-control'))?>
            </div>
            <div class="form-group">
            <label>Страница:</label>
                <?php echo($this->Form->textarea('file', array('div'=>false,'label'=>false,'class'=>'ckeditor form-control'))); ?>
            </div>    
            <script type="text/javascript">
                    var ck_newsArticle = CKEDITOR.replace( 'file',{height:'500'});
            </script>           
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Сохранить</button>
            </div>
        </form>   
    </div>
</div>