<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/catalogadd" title="Добавить">Добавить новый</a>
        </p>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th >Название</th>
                    <th >Url</th>                    
                    <th >Шаблон</th>  
                    <th >Действия</th>       
                </tr>
            </thead> 

            <tbody>                               
                <?foreach($items as $key=>$value):?>
                <tr>                     
                    <td><?=$value['Catalog']['name']?></td> 
                    <td><?=$value['Catalog']['trans']?></td> 
                    <td><?=$value['Catalog']['layout']?></td> 
                    <td> 
                        <a role="button" class="btn btn-primary btn-xs" href="/admin/catalogedit/<?=$value['Catalog']['id']?>" title="Редактировать"><i class="glyphicon glyphicon-pencil"></i></a>                    
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/catalogdelete/<?=$value['Catalog']['id']?>" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a>                        
                    </td>                               
                </tr> 
                <?endforeach;?>
            </tbody>
            </table>
    </div>
</div>