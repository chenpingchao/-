<?php
header('Content-Type:text/html;charset:utf-8;');
require('sqlconnect.php');
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加商品</title>
    <style>
        input{
            margin:10px;
        }
    </style>
</head>
<body>
<form action="goodCURD.php?act=add" method="post" enctype="multipart/form-data">
    <label for="goodsname">商品名称</label>
    <input type="text" name="good" id="goodsname"><br>
    <label for="price">商品价格</label>
    <input type="text" name="price" id="price"><br>
    <label for="image">商品图片</label>
    <input type="file" name="image" id="image"><br>
    <label for="bid"> 商品品牌</label>
    <select name="bid" id="cid">
        <?php
            if($brand_arr){
                foreach($brand_arr as $k1=>$v1){
        ?>
                    <option value="<?php echo $v1['id']?>">
                        <?php echo $v1['brandname']?>
                    </option>
        <?php
                }
            }
        ?>
    </select><br>
    <label for="cid">商品分类</label>
    <select name="cid" id="cid">
        <?php
            if($cate_arr){
                foreach($cate_arr as $k2 =>$v2){
        ?>
                    <option value="<?php echo $v2['id']?>">
                        <?php echo $v2['catename']?>
                    </option>
        <?php
                }
            }
        ?>
    </select><br>
    <input type="submit" value="确认添加">
</form>
</body>
</html>
