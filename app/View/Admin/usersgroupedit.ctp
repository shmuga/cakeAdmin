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
                <label>Список рассылки</label>
                <?php echo $this->Form->input('UsersGroupsFunction.func_id',array('options' => $select,'empty' => false,'class'=>'form-control', 'id' => 'list','multiple' => 'multiple', 'selected' => $selected))?>
            </div> 
            <script type="text/javascript">
                $(document).ready(function() {
                     $('#list').multiSelect({ selectableOptgroup: true });
                });
            </script>   
            <div class="form-actions">
            <button type="submit" role="button" class="btn btn-primary">Изменить</button>
            </div>
        </form>   
    </div>
</div>