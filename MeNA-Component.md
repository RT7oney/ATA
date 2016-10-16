# MeNA-Component
AshToArt
### 2016.09.02:
* ##### ubuntu下navicat试用到期解决办法:

	 在ubuntu以前用数据库管理都用phpmyadmin，一个月前换成 Navicat for MySQL ;
一个月以后的今天它到期了。试用按钮不在了，不能点了。

<!---->
	zzs@ubuntu:~$ cd .navicat/
	zzs@ubuntu:~/.navicat$ ls
	dosdevices  Navicat          system.reg   user.reg
	drive_c     navicat.crontab  userdef.reg
	zzs@ubuntu:~/.navicat$ rm -rf system.reg 
	zzs@ubuntu:~/.navicat$ ls
	dosdevices  drive_c  Navicat  navicat.crontab  userdef.reg  user.reg

删除了system.reg文件以后，再打开navicat出现试用按钮，又能试用30天了。哈哈


* ##### 10004组件忘记密码处理流程:
<!---->
	//1.生成一个修改密码的参数(用‘邮箱’+‘时间戳’去sha1)，三天过期(+259200)
	//2.存数据库生成参数的时间戳，过期时间戳
	//3.发送邮件，当用户点击链接之后（两个页面），取到参数，然后去数据库或者redis比对，如果参数过期，出现已过期的(第一个)页面提示，如果参数没有过期出现(第二个)修改密码的页面

* #####redis 0库存放用户信息  1库存放忘记密码信息
