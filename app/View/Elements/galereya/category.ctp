<?foreach ($items as $key => $value):?>
    <p><a href="/catalog/<?=$name?>/<?=$value[$models['category']]['trans'];?>"><?=$value[$models['category']]['name'];?></a></p>
<!-- name    varchar(128) []  
trans   varchar(128) []  
meta    varchar(1024) []     
title -->
<?endforeach;?>