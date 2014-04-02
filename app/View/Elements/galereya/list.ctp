<?foreach ($items as $key => $value):?>
    <p><a href="/catalog/<?=$name?>/<?=$value[$models['category']]['trans'];?>/<?=$value[$models['good']]['trans'];?>"><?=$value[$models['good']]['name'];?></a></p>
<!--'trans' => 'stol1',
    'title' => '',
    'meta' => '',
    'string_1' => '',
    'string_2' => '',
    'number_1' => '0',
    'number_2' => '0',
    'dateend' => '0000-00-00',
    'stock' => '',
    'map' => '',
    'articul' => '',
    'oldprice' => '0',
    'image' => '',
    'price' => '123',
    'short_description' => '',
    'currency_id' => null,
    'count' => '0',
    'description' => '' -->
<?endforeach;?>