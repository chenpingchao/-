<?php
//连接服务器
@$connect = mysql_connect('127.0.0.1:3306','root','root');
//选择数据库
mysql_select_db('yhshop');
//设置客户端汉字0编码
mysql_set_charset('utf8');