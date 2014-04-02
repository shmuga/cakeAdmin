<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/useradd" title="Добавить">Добавить нового</a>
        </p>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th >Логин</th>
                    <th >Email</th>
                    <th >Группа</th> 
                    <th>Статус</th>
                    <th >Действия</th>                          
                </tr>
            </thead> 

            <tbody>                                 
                <?foreach($items as $key=>$value):?>
                <tr> 
                    <td><?echo($value['User']['login']);?></td> 
                    <td><?echo($value['User']['email']);?></td>                 
                    <td><?echo($value['UsersGroup']['title']);?></td> 
                    <td><?=($value['User']['active']) ? "Активный" : "Неактивный"?></td>
                    <td> 
                        <a role="button" class="btn btn-primary btn-xs" href="/admin/useredit/<?echo($value['User']['id']);?>" title="Редактировать"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/userdelete/<?echo($value['User']['id']);?>" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a>
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/userstatus/<?=$value['User']['id'];?>/<?=($value['User']['active']) ? "0" : "1"?>" title="Статус"><i class="glyphicon glyphicon-remove"></i>статус</a>
                    </td>                               
                </tr> 
                <?endforeach;?>
            </tbody>
            </table>
    </div>
</div>