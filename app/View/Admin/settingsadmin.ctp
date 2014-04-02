<div class="row">
    <div class="col-md-12">
        <p>
            <a role="button" class="btn btn-primary" href="/admin/settingsadd" title="Добавить">Добавить новую</a>
            &nbsp;&nbsp;&nbsp;
            <button role="button" class="btn btn-info" onclick="document.forms[0].submit();" title="Сохранить все">Сохранить все</button>
            <span>
            &nbsp; &lt;?=$settings['назва'] ?&gt;
            </span>
        </p>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th >Параметр</th>
                    <th >Название</th>                
                    <th >Значение</th>                    
                    <th >Действия</th>                          
                </tr>
            </thead> 
            <form action="/admin/settingssave" method="POST">
            <tbody>                                 
                <?foreach($items as $key=>$value):?>
                <tr> 
                    <td><?echo($value['Setting']['param']);?></td>                 
                    <td><?echo($value['Setting']['title']);?></td>                     
                    <td><input class="form-control" value="<?echo($value['Setting']['value']);?>" name="data[Setting][<?=$value['Setting']['id']?>]"></td> 
                    <td> 
                        <a role="button" class="btn btn-primary btn-xs"  href="/admin/settingsdelete/<?echo($value['Setting']['id']);?>" title="Удалить"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>                               
                </tr> 
                <?endforeach;?>
            </tbody>
            </form>
            </table>
    </div>
</div>