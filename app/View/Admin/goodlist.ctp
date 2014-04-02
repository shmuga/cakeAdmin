<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/goodadd/<?=$name?>" title="Добавить">Добавить новый</a>
        </p>
        <?if($flash = $this->Session->flash()):?>
        <div class="bs-callout bs-callout-danger">
            <h4>Ошибка!</h4>
            <p><?=$flash;?></p>
        </div>
        <?endif;?>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th>ID</th>
                    <th >Название</th>
                    <th>Категория</th>
                    <?if(array_search("articul", $fields) !== false):?>
                    <th>Артикул</th>
                    <?endif;?>
                    <?if(array_search("image", $fields) !== false):?>
                    <th>Картинка</th>
                    <?endif;?>
                    <?if(array_search("price", $fields) !== false):?>
                    <th>Цена</th>
                    <?endif;?>
                    <?if(array_search("currency", $fields) !== false):?>
                    <th>Валюта</th>
                    <?endif;?>
                    <?if(array_search("dateend", $fields) !== false ):?>
                    <th>Дата</th>
                    <?endif;?>
                    <th >Действия</th>                         
                </tr>
            </thead> 

            <tbody>                               
                <?foreach($items as $key=>$value):?>
                <tr>                     
                    <td><?=$value[$models['good']]['id']?></td> 
                    <td><?=$value[$models['good']]['name']?></td> 
                    <td><?=$value[$models['category']]['name']?></td> 
                    <?if(array_search("articul", $fields) !== false):?>
                        <td><?=$value[$models['good']]['articul']?></td>
                    <?endif;?>
                    <?if(array_search("image", $fields) !== false):?>
                        <td><img style="max-width:300px;max-height:300px" src="<?=$value[$models['good']]['image']?>" alt=""></td>
                    <?endif;?>
                    <?if(array_search("price", $fields) !== false):?>
                        <td><?=$value[$models['good']]['price']?></td>
                    <?endif;?>
                    <?if(array_search("currency", $fields) !== false):?>
                        <td><?=$value['Currency']['name']?></td>
                    <?endif;?>
                    <?if(array_search("dateend", $fields) !== false):?>
                        <td><?=$value[$models['good']]['dateend']?></td>
                    <?endif;?>
                    <td> 
                        <a role="button" class="btn btn-primary btn-xs" href="/admin/goodedit/<?=$name?>/<?=$value[$models['good']]['id']?>" title="Редактировать"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/gooddelete/<?=$name?>/<?=$value[$models['good']]['id']?>" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a
                    </td>                               
                </tr> 
                <?endforeach;?>
            </tbody>
            </table>
    </div>
</div>