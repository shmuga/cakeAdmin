<link rel="stylesheet" type="text/css" href="/plugins/multiselect/css/multi-select.css">
<script type="text/javascript" src="/js/jquery-2.1.0.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form">
            <div class="form-group" style="width: 500px;">
            <label>Название:</label>
                <?php echo $this->Form->input('UsersGroup.title', array('div' => false, 'label'=>false, 'size' => '50', 'class'=>'form-control'))?>
            </div>
            <div class="form-group" style="width: 500px;">
                <label>Список функций</label>
                <?php echo $this->Form->select('UsersGroupsFunction.func_id', $select, array('empty' => false,'class'=>'form-control', 'id' => 'list','multiple' => 'multiple'))?>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                     $('#list').multiSelect({ selectableOptgroup: true });
                });
            </script>
            <div class="form-actions">
                <button type="submit" role="button" class="btn btn-primary">Добавить</button>
            </div>
        </form>   
    </div>
</div>