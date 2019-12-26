
<?php
/*echo "<pre>";
print_r($member_brand);*/
//链接数据库
require_once('sqlconnect.php');
//查询数据库
$sql = "select * from yh_cate ";
//执行sql语句获取资源
$resoult = mysql_query($sql);
//从资源中抽取信息组成二维数组
while($row1 = mysql_fetch_assoc($resoult)){
    $member[] = $row1;

}
/*echo "<pre>";
print_r($member);
exit;*/
?>
<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分类列表</title>
    <style>
        img{
            width :40px;
        }
        td{
            border:1px solid #000000;
            width:130px;
            height :30px;
        }
    </style>
</head>
<body>
<a href="addcate.html">添加分类</a>
<a href="addgoods.php">添加商品</a>
<a href="goodslist.php">商品列表</a>
    <table>
        <tr>
            <td>编号</td>
            <td>商品分类</td>
            <td>操作</td>
        </tr>
        <?php
            if($resoult || mysql_num_rows($resoult)>0){
                foreach($member as $k =>$v){
        ?>      <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['catename']?></td>
                    <td>
                        <a href='javascript:deletedAlert(<?php echo $v['id']?>);'>删除</a>
                        <a href="updatecate.php?id=<?php echo $v['id']?>">更改</a>
                    </td>
                </tr>
            <?php
                }
            }else{
        ?>
            <tr>
                <td><h2>暂无分类信息</h2></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
<script>
    function deletedAlert(id){
        if(confirm('确认删除')){
            location = 'cateCURD.php?act=delete&id='+id;
        }
    }
</script>
</html>
