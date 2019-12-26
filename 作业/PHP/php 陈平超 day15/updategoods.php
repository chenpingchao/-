<?php
require ('sqlconnect.php');

//获取ID
$id = $_GET['id'];
//echo $id;
//查询对应ID的信息SQL语句
$sql = "select * from yh_goods  where id=$id";
//执行sql语句
$resource = mysql_query($sql);
//var_dump($resource);
$id_arr = mysql_fetch_assoc($resource);
//print_r($id_arr);


//查询品牌的数据
$resource_brand = mysql_query('select * from yh_brand');
if($resource_brand || mysql_num_rows($resource_brand)>0){
    while($row_brand = mysql_fetch_assoc($resource_brand)){
        $brand_arr[] = $row_brand;
    }
}else{
    $brand_arr = [];
}
/*echo "<pre>";
print_r($brand_arr);*/
//查询分类的数据
$resource_cate = mysql_query("select * from yh_cate");
if($resource_cate || mysql_num_rows($resource_cate)){
    while( $row_cate = mysql_fetch_assoc($resource_cate)){
        $cate_arr[] = $row_cate;
    }
} else{
    $cate_arr = [];
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        dt,dd{
            line-height: 2.5em;
        }
    </style>
</head>
<body>
<form action="goodCURD.php?act=change" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id_arr['id']?>">
    <dl>
        <dt>更改商品信息</dt>
        <dd>
            <label for="goodsname">商品名称</label>
            <input type="text" name="goodsname" id="goodsname" value="<?php echo $id_arr['goodsname']?>">
        </dd>
        <dd>
            <label for="price">商品价格</label>
            <input type="text" name="price" id="price" value="<?php echo $id_arr['price']?>">
        </dd>
        <dd>
            <label for="image">商品图片</label>
            <input type="file" name="image" id="image" value="<?php echo $id_arr['image']?>">
        </dd>
        <dd>
            <label for="brand">商品品牌</label>
            <select name="brand" id="brand">
                <?php
                   if($brand_arr){
                       foreach($brand_arr as $k1=> $v1 ){
                ?>
                            <option value="<?php echo $v1['id']?>" <?php $v1['id']=$id_arr['bid']?'selected':''?>>
                                <?php echo $v1['brandname']?>
                            </option>
                <?php
                       }
                   }
                ?>
            </select>
        </dd>
        <dd>
            <label for="cid">商品分类</label>
            <select name="cid" id="cid">
                <?php
                    if($cate_arr){
                        foreach($cate_arr as $k2 => $v2){
                ?>
                            <option value="<?php echo $v2['id']?>" <?php $v2['id']=$id_arr['cid']?'selected':''?>>
                                <?php echo $v2['catename']?>
                            </option>
                <?php
                        }
                    }
                ?>
            </select>
        </dd>
        <dd>
            <input type="submit" value="确认更改">
        </dd>

    </dl>
</form>
</body>
</html>
