<link rel="stylesheet" type="text/css" href="/plugins/multiselect/css/multi-select.css">
<script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/plugins/ckfinder/ckfinder.js"></script>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название:</label>
                <?php echo $this->Form->input('Catalog.name', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>            
            <div class="form-group" style="width: 500px;">
                <label>Поля для товаров:</label>
                <?php echo $this->Form->select('Catalog.showfields', $fields, array('empty' => false,'class'=>'form-control', 'id' => 'list','multiple' => 'multiple'))?>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                     $('#list').multiSelect({ selectableOptgroup: true });
                });
            </script>
            <div class="form-group" style="width: 500px;">
                <label>Тип каталога:</label>
                <?php echo $this->Form->select('Catalog.type', $types, array('empty' => false,'class'=>'form-control'))?>
            </div>
            <div class="form-group" style="width: 500px;">
            <label>Мета:</label>
                <?php echo $this->Form->textarea('Catalog.meta', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div> 
            <div class="form-group" style="width: 500px;">
            <label>Загловок страницы (по умолчанию - название):</label>
                <?php echo $this->Form->input('Catalog.title', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>
            <div class="form-group" style="width: 500px;">
                <label>Картинка:</label>
                <?php echo $this->Form->input('Catalog.image', array('div' => false, 'label'=>false, 'class'=>'form-control','id' => 'image','onclick'=>"BrowseServer();"))?>                                
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
                <?php echo $this->Form->textarea('Catalog.description', array('div' => false, 'label'=>false, 'id'=>'long','class'=>'form-control ckeditor'))?>
            </div>
            <script>                
                var editor =CKEDITOR.replace( 'long' );
                CKFinder.setupCKEditor( editor, '/plugins/ckfinder/' );
            </script>                       
            <div class="form-group" style="width: 500px;">
                <label>Шаблон</label>
                <?php echo $this->Form->input('layout' ,array('div'=>false,'label'=>false,'class'=>'form-control'));?>
            </div>
            <div class="form-group">
                <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>