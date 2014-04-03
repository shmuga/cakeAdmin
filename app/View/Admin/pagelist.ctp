<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/pageadd" title="Добавить">Добавить новую</a>
        </p>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th >Заголовок</th>
                    <th >Ссылка</th>
                    <th >Шаблон</th>
                    <th >Действия</th>                         
                </tr>
            </thead> 

            <tbody>                               
                <?foreach($items as $key=>$value):?>
                <tr>                     
                    <td><?=$value['Page']['title'];?></td>
                    <td><?=$value['Page']['filename'];?></td>
                    <td><?=$value['Page']['layout'];?></td>
                    <td> 
                        <a role="button" class="btn btn-primary btn-xs" href="/admin/pageedit/<?=$value['Page']['filename']?>" title="Редактировать"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/pagedelete/<?=$value['Page']['filename']?>" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>                               
                </tr> 
                <?endforeach;?>
            </tbody>
            </table>
    </div>
</div>