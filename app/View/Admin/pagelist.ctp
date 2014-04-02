<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/pageadd" title="Добавить">Добавить новую</a>
        </p>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th >Название</th>
                    <th >Действия</th>                         
                </tr>
            </thead> 

            <tbody>                               
                <?foreach($items as $key=>$value):?>
                <tr>                     
                    <td><?=$value;?></td> 
                    <td> 
                        <a role="button" class="btn btn-primary btn-xs" href="/admin/pageedit/<?=$value?>" title="Редактировать"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/pagedelete/<?=$value?>" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a
                    </td>                               
                </tr> 
                <?endforeach;?>
            </tbody>
            </table>
    </div>
</div>