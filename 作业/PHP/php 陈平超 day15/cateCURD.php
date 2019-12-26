<?php
require_once('sqlconnect.php');
//添加商品分类
//接受提交信息
$act=$_GET['act'];
/*var_dump( $act);
exit;*/
$act();

//添加;
function add(){
    $cate = $_POST['cate'];
    //添加sql语句
    $sql = "insert into yh_cate(catename) value ('$cate')";
    //var_dump(mysql_query($sql));
    //var_dump(mysql_affected_rows());
    //exit;
    if(mysql_query($sql) && mysql_affected_rows()>0){
        echo "<script>alert('添加分类成功');location = 'catelist.php'</script>";
    }else{
        echo "<script>alert('添加分类失败');history.back()</script>";
    }
}

//删除
function delete(){
    $id = $_GET['id'];
    //删除sql语句
    $sql = "delete from yh_cate where id =$id";
    //执行sql语句
    if(mysql_query($sql) && mysql_affected_rows()>0){
        echo "<script>alert('删除成功');location = 'catelist.php'</script>";
    }else{
        echo "<script>alert('删除失败');history.back();</script>";
    }
}

//更改分类
function update(){
    $id = $_POST['id'];
    $catename = $_POST['catename'];
    /*echo $catename;
    exit;*/
    //SQL语句
    $sql = "update yh_cate set catename='$catename' where id=$id";
     if(mysql_query($sql) && mysql_affected_rows()>0){
         echo "<script>alert('更新成功');location = 'catelist.php'</script>";
     }else{
         echo "<script>alert('更新失败');history.back();</script>";
     }

}


