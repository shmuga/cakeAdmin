<div class="row">
    <div class="col-md-12">
        <p>
            <button role="button" class="btn btn-info" onclick="document.forms[0].submit();" title="Сохранить все">Сохранить все</button>
        </p>
        <table class="table table-bordered">                            
            <thead> 
                <tr>
                    <th >Название</th>                
                    <th >Значение</th>                                             
                </tr>
            </thead> 
            <form action="/admin/settingssave" method="POST">
            <tbody>                                 
                <?foreach($items as $key=>$value):?>
                <tr>                 
                    <td><?echo($value['Setting']['title']);?></td>                     
                    <td><input class="form-control" value="<?echo($value['Setting']['value']);?>" name="data[Setting][<?=$value['Setting']['id']?>]"></td>                   
                </tr> 
                <?endforeach;?>
            </tbody>
            </form>
            </table>
    </div>
</div>