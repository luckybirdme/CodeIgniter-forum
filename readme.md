#CodeIgniter-learn-forum

利用PHP语言，CodeIgniter框架，MySQL数据库搭建简单的Forum，仅供学习之用。
演示地址：[Demo](http://codeigniter.luckybird.me/)

**功能简介**

1. 用户注册，修改资料，包括头像显示
2. 添加分类，发表帖子，以及回复评论
3. Markdown编辑，图片上传和预览效果

**安装方法**

获取代码
```
git clone https://github.com/luckybirdme/CodeIgniter-learn-forum.git

```
安装数据库
```
# mysql -uroot -p
> source codeigniter.sql

```

**文件配置**

修改application/config/database.php
```
$db['default'] = array(
 .................
 // 根据自己环境修改
 'hostname' => 'localhost',
 'username' => 'root',
 'password' => '123456',
 'database' => 'codeigniter',
 'dbdriver' => 'mysqli',
 ............
);

```

修改application/config/config.php

```
...........
// 根据自己环境修改
$config['base_url'] = 'http://localhost.CodeIgniter';
$config['static_url'] = 'http://localhost.CodeIgniter/public/static';
$config['upload_path'] = FCPATH;
$config['image_url'] = 'http://localhost.CodeIgniter';
............

```

**相关链接**

GitHub地址：[CodeIgniter-learn-forum](https://github.com/luckybirdme/CodeIgniter-learn-forum)

博客地址 : [LuckyBird](http://www.luckybird.me)

