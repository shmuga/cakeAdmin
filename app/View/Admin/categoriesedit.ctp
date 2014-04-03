<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/plugins/ckfinder/ckfinder.js"></script>
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
                   
            <div class="form-group" style="width: 500px;">
                <label>Картинка:</label>
                <?php echo $this->Form->input($models['category'] . '.image', array('div' => false, 'label'=>false, 'class'=>'form-control','id' => 'image','onclick'=>"BrowseServer();"))?>                                
                <script type="text/javascript">
                                function BrowseServer()
                                {
                                    var finder = new CKFinder();
                                    finder.basePath = '/js/ckfinder/';
                                    finder.selectActionFunction = SetFileField;
                                    finder.popup();
                                }

                                function SetFileField( fileUrl )
                                {
                                    document.getElementById( 'image' ).value = fileUrl;
                                }
                </script>
            </div>
            <div class="form-group">
                <label>Описание:</label>
                <?php echo $this->Form->textarea($models['category'] . '.description', array('div' => false, 'label'=>false, 'id'=>'long','class'=>'form-control ckeditor'))?>
            </div>
            <script>                
                    var editor =CKEDITOR.replace( 'long' );
                    CKFinder.setupCKEditor( editor, '/plugins/ckfinder/' );
            </script>

            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Сохранить</button>
            </div> 
        </form>   
    </div>
</div>