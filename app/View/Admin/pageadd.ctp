<!-- <script type="text/javascript" src="/js"></script> -->
<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название(будет вводиться в адресную строку)</label>
                <input type="text" class="form-control" name="data[filename]">
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