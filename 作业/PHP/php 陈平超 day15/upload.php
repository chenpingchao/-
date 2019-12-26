<?php

function oneFileUpload($uploadDir='upload_image' , $type =['png','jpg','jpeg','gif'],$maxSize = 10200000,$is_img=true ){
    //对数组进行遍历  保证上传的数组相同
    foreach($_FILES as $k2=>$v2) {
        //print_r($v2);
        //判断为三维数组还是二维数组
        if (is_array($v2['name'])){
            foreach($v2['name'] as $k3=>$v3){
//             print_r($v2['name']);
                //print_r($v3);
                $arr[$k3]['name'] = $v3;
                $arr[$k3]['type'] = $v2['type'][$k3];
                $arr[$k3]['tmp_name'] = $v2['tmp_name'][$k3];
                $arr[$k3]['error'] = $v2['error'][$k3];
                $arr[$k3]['size'] = $v2['size'][$k3];
            }
        }else{ //二维数组
            //关联数组转为索引数组 消除name的差异
            $arr = array_values($_FILES);
        }
    }
    foreach($arr as $k =>$v ){


        if ($v['error'] === 0) {
            //判断文件的大小
            if ($v['size'] > $maxSize) {
                $result[] = ['error', '文件过大，请从新上传'];
                continue;
            }
            //判断文件的格式
            $extension = pathinfo($v['name'], PATHINFO_EXTENSION);
            //判断是否为图片、
            if ($is_img) {
                //判断是否真正为图片
                if (!getimagesize($v['tmp_name'])) {
                    $result[] =  ['aaa', '上传的不是一个图片'];
                    continue;
                }
            } else {
                if (!in_array($extension, $type)) {
                    $result[] = ['error', '文件格式错误'];
                    continue;
                }
            }
            //判断上传方式是否为post
            if (!is_uploaded_file($v['tmp_name'])) {
                $result[] = ['error', '请用post方式上传'];
                continue;
            }
            //从临时文件保存到正常目录
            //判断目录是否存在
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir);
                chmod($uploadDir, 0777);
            }
            //为文件命一个唯一的名
            $filename = md5(uniqid(mt_rand(), true)) . '.' . $extension;
            //将临时文件移动到指定目录
            if (move_uploaded_file($v['tmp_name'], $uploadDir . '/' . $filename)) {
                $result[] = ['ok', "文件上传成功",$filename ];
            } else {
                $result[] = ['error', "文件上传失败"];
            }
        } else {
            switch ($v['error']) {
                case 1:
                    $result[] = ['error', '上传文件超过uupload_max_filesize限制'];
                    break;
                case 2:
                    $result[] = ['error', '上传文件字节数超过表单隐藏域(MAX_FILE_SIZE)限制'];
                    break;
                case 3:
                    $result[] = ['error', '上传文件失败'];
                    break;
                case 4:
                    $result[] = ['error', '没有选择上传文件'];
                    break;
                case 6:
                    $result[] = ['error', '没有临时目录'];
                    break;
                case 7:
                    $result[] = ['error', '临时目录不可写'];
                    break;
            }
        }
    }
    return $result;
}
