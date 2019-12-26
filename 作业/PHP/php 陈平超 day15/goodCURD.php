<?php
header("Content-Type:text/html;chatset:utf-8");
require('sqlconnect.php');
//应用上传图片的函数
require('upload.php');

$act=$_GET['act'];
$act();


//添加函数
function add(){
    $goodsname = trim($_POST['good']);
    $price = trim($_POST['price']);
    $bid = $_POST['bid'];
    $cid = $_POST['cid'];
    $image = oneFileUpload();
    print_r($image);
    $add_time =time();
    if($image[0][0] !='ok'){
        //图片上传未成功
        echo "<script>alert('上传图片未成功');history.back();</script>";
    }else{
         //插入sql语句
       $image_name = $image[0][2];
      /*   var_dump($image_name);*/
        $sql = "insert into yh_goods(goodsname,price,image,bid,cid,add_time) values ('$goodsname',$price,'$image_name',$bid,$cid,$add_time)";
        //执行sq语句
//        var_dump(mysql_query($sql));exit;
        if(mysql_query($sql)){

            echo "<script>alert('添加成功');location = 'goodslist.php'</script>";
        }else{
            echo "<script>alert('添加失败');history.back();</script>";
        }
    }
}


//删除商品
function deleted(){
    $id = $_GET['id'];
    //删除sql语句
    $sql = "delete from yh_goods where id =$id";
    //执行sql语句
    if(mysql_query($sql) && mysql_affected_rows()>0){
        echo "<script>alert('删除成功');location = 'goodslist.php'</script>";
    }else{
        echo "<script>alert('删除失败');history.back();</script>";
    }
}

//更改商品信息
function change(){
    $id = $_POST['id'];
    $goodsname = trim($_POST['goodsname']);
    $price = trim($_POST['price']);
    $image = oneFileUpload();
    $cid = $_POST['cid'];
    $bid = $_POST['brand'];

    if($image[0][0] !== 'ok'){
        echo "<script>alert('图片更新失败')</script>";
        $sql = "update yh_goods set goodsname='$goodsname',price=$price,bid=$bid,cid=$cid where id=$id";
    }else{
        $image_name = $image[0][2];
        //更新sql语句
        $sql = "update yh_goods set goodsname='$goodsname',price=$price,image = '$image_name',bid=$bid,cid=$cid where id=$id";
    }
    //上传
    if(mysql_query($sql) && mysql_affected_rows()>0){
        echo "<script>alert('更新成功');location = 'goodslist.php'</script>";
    }else{
        echo "<script>alert('更新失败');history.back()</script>";
    }
}