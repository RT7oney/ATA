# ATA
AshToArt
## 一些学习，工作中积累下来的东西
* 关于一些项目的端口管理：
* API使用go语言web框架beego开发，分配端口9090
* Web使用js语言web框架anjurlar和vue，jade开发，分配端口8080
* Component使用php语言socket框架workerman开发，分配端口10000以上
* wechat使用js语言node.js+mongoDB开发，分配端口7070
* admin使用python，分配端口80

##2016.09.03
* 有关于php异步操作的东西:
> 有数据持久化支持（就是把队列保存到数据库介质中，那故障恢复也好做），有群集支持（其实很多××MQ都有这些功能）。PECL上有扩展，也有纯PHP实现扩展。反正这个Gearman也活了很久了，杂七杂八的问题都基本上解决了。
* 什么是worker:
> [关于Web Worker你必须知道的7件事](http://blog.csdn.net/dojotoolkit/article/details/25030289)
* gearman
> [基本思路](http://my.oschina.net/wakanoc/blog/101789)
* 线程与进程：
> 线程和进程的区别在于，子进程和父进程有不同的代码和数据空间，而多个线程则共享数据空间，每个线程有自己的执行堆栈和程序计数器为其执行上下文。多线程主要是为了节约CPU时间，发挥利用，根据具体情况而定。线程的运行中需要使用计算机的内存资源和CPU。
* 线程与进程的区别归纳：
>a.地址空间和其它资源：进程间相互独立，同一进程的各线程间共享。某进程内的线程在其它进程不可见。
b.通信：进程间通信IPC，线程间可以直接读写进程数据段（如全局变量）来进行通信——需要进程同步和互斥手段的辅助，以保证数据的一致性。
c.调度和切换：线程上下文切换比进程上下文切换要快得多。
d.在多线程OS中，进程不是一个可执行的实体。
* socket
>socket是应用层与TCP/IP协议族通信的中间软件抽象层，它是一组接口。在设计模式中，Socket其实就是一个门面模式，它把复杂的TCP/IP协议族隐藏在Socket接口后面，对用户来说，一组简单的接口就是全部，让Socket去组织数据，以符合指定的协议。
* kafka:
>kafka对消息保存时根据Topic进行归类，发送消息者成为Producer,消息接受者成为Consumer,此外kafka集群有多个kafka实例组成，每个实例(server)成为broker。无论是kafka集群，还是producer和consumer都依赖于zookeeper来保证系统可用性集群保存一些meta信息。
* 在遍历数组并且正则匹配数组中的每一个元素的时候
<!-- php -->
	$content = '土豆丝';
	$menu = ['西红柿炒鸡蛋', '土豆丝', '回锅肉'];
	
	for ($i = 0; $i < count($menu); $i++) {
		 print_r($menu[$i]);
		 var_dump(preg_match('/' . $menu[$i] . '/', $content));
		 echo '<br>';
	}

输出结果：
<!---->
	西红柿炒鸡蛋int(0) 
	土豆丝int(1) 
	回锅肉int(0) 
然而：
<!---->
	foreach ($menu as $k => $val) {
		print_r($val);
		var_dump(preg_match('/' . $val . '/', $content));
		echo '<br>';
	}
输出结果：
<!---->
	西红柿炒鸡蛋int(0) 
	土豆丝int(0) 
	回锅肉int(0) 
* Oauth2.0
> （A）用户打开客户端以后，客户端要求用户给予授权。
> 
>（B）用户同意给予客户端授权。
>
>（C）客户端使用上一步获得的授权，向认证服务器申请令牌。
>
>（D）认证服务器对客户端进行认证以后，确认无误，同意发放令牌。
>
>（E）客户端使用令牌，向资源服务器申请获取资源。
>
>（F）资源服务器确认令牌无误，同意向客户端开放资源。<br>
><br><font color=red>客户端授权模式</font><br><br>
>客户端必须得到用户的授权（authorization grant），才能获得令牌（access token）。OAuth 2.0定义了四种授权方式。<br> 
> * <font color=red>授权码模式</font>（authorization code）<br>
> * <font color=red>简化模式</font>（implicit）<br>
> * <font color=red>密码模式</font>（resource owner password credentials）<br>
> * <font color=red>客户端模式</font>（client credentials）<br>
<br>
><font color=red>授权码模式</font><br><br>
>（A）用户访问客户端，后者将前者导向认证服务器。<br>
>（B）用户选择是否给予客户端授权。<br>
>（C）假设用户给予授权，认证服务器将用户导向客户端事先指定的"重定向URI"（redirection URI），同时附上一个授权码。<br>
>（D）客户端收到授权码，附上早先的"重定向URI"，向认证服务器申请令牌。这一步是在客户端的后台的服务器上完成的，对用户不可见。<br>
>（E）认证服务器核对了授权码和重定向URI，确认无误后，向客户端发送访问令牌（access token）和更新令牌（refresh token）。<br>
* css 的三种模型
>流动模型
>
>浮动模型
>
>层模型
* 块级元素：
<!---->
	1. 每个元素都不在同一行，可以设置宽高，可以使用style=inline来变成内联元素
	2.内联元素都在同一行，不能设置宽高
	3.内联块状元素 style=inline-block，在同一行，并且能够设置宽高
* margin 和 padding
<!---->
	margin是在边框外，padding是在边框里
* 流动模型
<!---->
	第一点，块状元素都会在所处的包含元素内自上而下按顺序垂直延伸分布，因为在默认状态下，块状元素的宽度都为100%。实际上，块状元素都会以行的形式占据位置。如右侧代码编辑器中三个块状元素标签(div，h1，p)宽度显示为100%。
	第二点，在流动模型下，内联元素都会在所处的包含元素内从左到右水平分布显示。（内联元素可不像块状元素这么霸道独占一行
* 浮动模型
<!---->
	div{
    	width:200px;
    	height:200px;
    	border:2px red solid;
    	float:left;
	}
	<div id="div1"></div>
	<div id="div2"></div>
* 层模型有三种形式：
<!---->
	1、绝对定位(position: absolute)
	相对于其最接近的一个具有定位属性的父包含块进行绝对定位。如果不存在这样的包含块，则相对于body元素，即相对于浏览器窗口。
	2、相对定位(position: relative)
	相对于以前的位置移动，移动的方向和幅度由left、right、top、bottom属性确定，偏移前的位置保留不动。
	ex:
	#div1{
    	width:200px;
    	height:200px;
    	border:2px red solid;
    	position:relative;
    	left:100px;
    	top:50px;
	}
	
	<div id="div1"></div>
	3、固定定位(position: fixed)
	可以让滚动条滚的时候，元素块的位置不变
* 定位大法好
<!---->
	1、参照定位的元素必须是相对定位元素的前辈元素：

	<div id="box1"><!--参照定位的元素-->
    	<div id="box2">相对参照元素进行定位</div><!--相对定位元素-->
	</div>
	从上面代码可以看出box1是box2的父元素（父元素当然也是前辈元素了）。

	2、参照定位的元素必须加入position:relative;

		#box1{
    		width:200px;
    		height:200px;
    		position:relative;        
		}
	3、定位元素加入position:absolute，便可以使用top、bottom、left、right来进行偏移定位了。

		#box2{
    		position:absolute;
    		top:20px;
    		left:30px;         
		}
	这样box2就可以相对于父元素box1定位了（这里注意参照物就可以不是浏览器了，而可以自由设置了）。
* 不定宽度的块状元素有三种方法居中（这三种方法目前使用的都很多）：
<!---->
	1.加入 table 标签
	2.设置 display: inline 方法：与第一种类似，显示类型设为 行内元素，进行不定宽元素的属性设置
	第二种方法：改变块级元素的 display 为 inline 类型（设置为 行内元素 显示），然后使用 text-align:center 来实现居中效果。如下例子：
	<style>
	.container{
    	text-align:center;
	}
	/* margin:0;padding:0（消除文本与div边框之间的间隙）*/
	.container ul{
    	list-style:none;
    	margin:0;
    	padding:0;
    	display:inline;
	}
	/* margin-right:8px（设置li文本之间的间隔）*/
	.container li{
   	 	margin-right:8px;
    	display:inline;
	}
	</style>
	3.设置 position:relative 和 left:50%：利用 相对定位 的方式，将元素向左偏移 50% ，即达到居中的目的
	方法三：通过给父元素设置 float，然后给父元素设置 position:relative 和 left:50%，子元素设置 position:relative 和 left: -50% 来实现水平居中。
	<body>
	<div class="container">
    <ul>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
    </ul>
	</div>
	</body>
	css代码：

	<style>
	.container{
    	float:left;
    	position:relative;
    	left:50%
	}

	.container ul{
    	list-style:none;
    	margin:0;
    	padding:0;
    
    	position:relative;
    	left:-50%;
	}
	.container li{float:left;display:inline;margin-right:8px;}
	</style>
* 清除浮动
<!---->
	clear属性-常用clear:both;(对紧邻的元素管用)
	同时设置width:100%;overflow:hidden
## 2016.09.06
* HTTP、WebSocket 等协议都是处于 OSI 模型的最高层： 应用层 。而 IP 协议工作在网络层（第3层），TCP 协议工作在传输层（第4层）。
* Socket是应用层与TCP/IP协议族通信的中间软件抽象层，它是一组接口。在设计模式中，Socket其实就是一个门面模式，它把复杂的TCP/IP协议族隐藏在Socket接口后面，对用户来说，一组简单的接口就是全部，让Socket去组织数据，以符合指定的协议。
* vue.js 入门
<!----->
	new Vue({
		data:{
			a:1,
			b:[]
		},
		methods:{
			doSomething:function(){
				this.a ++
			}
		},
		watch:{
			'a':function(val,oldVal){
				console.log(val,oldVal)
			},
		},
	})
	
<!---->
	//数据渲染
	<p>{{ a }}</p>
	<p v-text="a"></p>
	<p v-html="a"></p> 如果a里面有html的标签，那么该方法会编译成html的方法
<!---->
	<p v-if="到data"></p>
	<p v-if=""></p>
	<p v-for=""></p>
	<p v-on:click="到methods"></p>
	<p v-bind:class="到methods"></p>
<!---->
	// 如何控制class
	<template>
	v-bind:class="{finished:isFinished}"
	</template>
	<script>
	data: isFinished:true
	</script>
	<style>
	.finished{
		//css code
	}
	</style>
<!---->
	<button v-on:click="change()"></button>
	<input v-model="newItem" v-on:keyup.enter="add">
	<script>
		methods:{
			add(){
				this.newItem
			}
		}
	</script>
<!---->
	const STORAGE_KEY = 'todos'
	exports default{
		fetch:function(){
			return JSON.parse(window.localStorage.getItem(STORAGE_KEY) || '')
		},
		save:function (items){
			window.localStorage.setItem(STORAGE_KEY,JSON.stringify(items))
		}
	}
	
	
	
	
	
	
	//另一个
	<script>
		watch:{
			items:{
				handler:function(val,oldVal){
					
				},
				deep:true//如果为false表示无法修改items中一个单独的key
			}
		}
	</script>
<!---->
	//父组件通知儿子
	//父组件
	<child msgfromdad="laji"></child>
	
	//子组件
	<tp>{{ msgfromdad }}</tp>
	props:['msgfromdad']//这样才能读取父组件的msgfromdad
<!---->
	//子组件告知父亲
	//父组件
	<p>{{ childwords }}</p>
	<child v-on:child-tell-me="listenToMyBoy"></child> //v-on可以任何事件名
	methods:{
		listenToMyBoy:function(msg){
			this.childwords = msg //这里的childwords需要在data:里面注册一下哟
		}
	}
	
	//子组件
	methods:{
		some:funciont(){
			this.$emit('child-tell-me','hahahahah')
		}
	}
<!---->
	子$dispatch 
	父events{
		'child-tell-me':function(msg){
			this.childWords = msg
		}
	}
	
	父$broadcast
	子events
##2016.09.11
* socket多线程的主要逻辑整理
	
	第一步首先需要去循环调用accept来监听客户端的请求，然后服务端接受客户端的socket，并且特别注意是<font color=red>服务端创立一个专门的socket来处理这个客户端的socket</font>

##2016.09.12
* 进程之间的通信，线程之间的通信
* hadoop spark
* memercache和redis

	1.redis支持更丰富的数据结构  hash  string  list set sorted set   memcache
	
	2.mem对简单的key-value的形式存储的内存利用率更高
	
	3.redis 单核，存储小数据性能更高，mem多核，存储大量数据的性能会更好
* python爬虫
* laravel5.1
* sql分区，索引

	左边是数据表，一共有两列七条记录，最左边的是数据记录的物理地址（注意逻辑上相邻的记录在磁盘上也并不是一定物理相邻的）。为了加快Col2的查找，可以维护一个右边所示的二叉查找树，每个节点分别包含索引键值和一个指向对应数据记录物理地址的指针，这样就可以运用二叉查找在O(log2n)的复杂度内获取到相应数据。

	创建索引可以大大提高系统的性能。<br>
第一，通过创建唯一性索引，可以保证数据库表中每一行数据的唯一性。
第二，可以大大加快数据的检索速度，这也是创建索引的最主要的原因。
第三，可以加速表和表之间的连接，特别是在实现数据的参考完整性方面特别有意义。
第四，在使用分组和排序子句进行数据检索时，同样可以显著减少查询中分组和排序的时间。
第五，通过使用索引，可以在查询的过程中，使用优化隐藏器，提高系统的性能。 

	在创建索引的时候，应该考虑在哪些列上可以创建索引，在哪些列上不能创建索引。一般来说，应该在这些列上创建索引：在经常需要搜索的列上，可以加快搜索的速度；在作为主键的列上，强制该列的唯一性和组织表中数据的排列结构；在经常用在连接的列上，这些列主要是一些外键，可以加快连接的速度；在经常需要根据范围进行搜索的列上创建索引，因为索引已经排序，其指定的范围是连续的；在经常需要排序的列上创建索引，因为索引已经排序，这样查询可以利用索引的排序，加快排序查询时间；在经常使用在WHERE子句中的列上面创建索引，加快条件的判断速度。
	
	当修改性能远远大于检索性能时，不应该创建索引。这是因为，修改性能和检索性能是互相矛盾的。当增加索引时，会提高检索性能，但是会降低修改性能。当减少索引时，会提高修改性能，降低检索性能。因此，当修改性能远远大于检索性能时，不应该创建索引。

	根据数据库的功能，可以在数据库设计器中创建三种索引：唯一索引、主键索引和聚集索引
	
		唯一索引 
唯一索引是不允许其中任何两行具有相同索引值的索引。
当现有数据中存在重复的键值时，大多数数据库不允许将新创建的唯一索引与表一起保存。数据库还可能防止添加将在表中创建重复键值的新数据。例如，如果在employee表中职员的姓(lname)上创建了唯一索引，则任何两个员工都不能同姓。
主键索引
数据库表经常有一列或列组合，其值唯一标识表中的每一行。该列称为表的主键。
在数据库关系图中为表定义主键将自动创建主键索引，主键索引是唯一索引的特定类型。该索引要求主键中的每个值都唯一。当在查询中使用主键索引时，它还允许对数据的快速访问。
聚集索引
在聚集索引中，表中行的物理顺序与键值的逻辑（索引）顺序相同。一个表只能包含一个聚集索引。
如果某索引不是聚集索引，则表中行的物理顺序与键值的逻辑顺序不匹配。与非聚集索引相比，聚集索引通常提供更快的数据访问速度。

* 钩子函数
* swoole和workerman
* put  delete用什么变量接受下来

<!---->	
	
	$type = $_SERVER['REQUEST_METHOD'];
	parse_str(file_get_contents('php://input'), $data);
	$data = array_merge($_GET, $_POST, $data);
	//根据 $type 的值做相应的操作
##2016.09.15
* 数据库

	当使用group by 并且带着 having子句的时候，我们需要保证两个条件，1.having后面应该为一个聚合函数（count avg  max min sum）。2.having后面的待条件的字段需要出现在我们select后面的字段
* insert

	INSERT test(username) SELECT username FROM users WHERE age > 30  //将查询的结果写入到数据表
* 子查询

	出现在其他SQL语句内的select子句，子查询是指嵌套在查询内部的查询，始终出现在圆括号内，子查询可以包含多个关键字或者条件，如DISTINCT,GROUP BY,LIMIT等等，子查询的外层查询一般多为 SELECT UPDATE SET DO等等，子查询的返回结果可以是标量，一行，一列，或者子查询   
* rand(avg(xxx),2)小数点后面保留两位
* ANY SOME ALL 

	<img src="img/anysomeall.jpeg" style="width:350px">
* IN 和 NOT IN 引发的子查询
* 多表更新 
	
	内连接：
	<img src="img/innerjoin.jpeg" style="width:350px">
	
	UPDATE tdb_goods INNER_JOIN tdb_goods_cates ON goods_cate = cate_name SET goods_cate = cate_id
	外连接（左）：
	<img src="img/leftjoin.jpeg" style="width:350px">
	
	比如左边表的链接的话，就会查出所有左边表的数据
* 其实表的链接可以看成是一种外键的你想操作，外键和数据分开了存储，通过“链接”我们又将多张表联系在一起
* 单表连接

	type_id    type_name    parent_id
	   1         电器             0
	   2         大家电   		  1
	   3         小家电           1
	   4         电视             2
	   5         手电筒           3
	
	SELECT s.type_id,s.type_name,p.type_name FROM goods_types AS s LEFT JOIN goods_types AS p ON s.parent_id = p.parent_id
	
	如果一张表需要显示父类下的子类的数目只需要加上简单的分组就行
	<img src="img/sql one.jpeg" style="width:350px">
	
	SELECT p.type_id,p.type_name,s.type_name FROM tdb_goods_type AS p IN tdb_goods_type AS s ON s.parent_id = p.type_id GROUP BY p.type_name
	
	<img src="img/sql two.jpeg" style="width:350px">
	
	SELECT p.type_id,p.type_name,count(s.type_name) AS  child_count FROM tdb_goods_type AS p LEFT JOIN tdb_goods_type AS s ON p.parent_id = s.type_id GROUP BY p.type_name ORDER BY p.type_id
* sql语句中like关键字

	如果需要查询诸如需要通配符的情况，比如需要查找tom%这种字符串里面包含%的结果，那么应该怎么查询呢，应该把如果写成 “LIKE '%%%'”则会查出全部非空结果，所以必须写成“LIKE '%1%%%'”去告诉体统中间的%不需要作为通配符出现，%代表任意个字符，_代表任意一个字符
	
	<img src="img/func one.jpeg" style="width:350px">
	
	<img src="img/func two.jpeg" style="width:350px">
##2016.09.17
* php 多线程，处理一个异步操作的任务

	希望在Web这边获取一种方式，来执行一个长达数小时的“异步”任务。就PHP而言，可以用2种方式来做：
（1）在PHP里使用shell_exec的函数，以shell的方式，启动一个独立的PHP脚本执行。这种方式，其实相当于在Web服务器处理过程中，独立起了一个shell进程处理你的任务。这里，需要特别注意的是shell_exec的服务器安全，注意校验参数，小心避免被带入shell命令中。这个是比较容易实现的方式。
（2）使用PHP实现一个Server，监听一个端口，为Web端提供服务。这里的实现方式有很多，通常要配合扩展，例如原生的pthread（多线程），开源扩展swoole等等。

	直接在web程序里使用多线程，是不恰当的，web请求通常有时间限制，例如timeout默认是30秒。你如何保证，在线程任务执行完之前，它的父进程仍然在工作？
* go 语言闭包

<!--lang:golang-->
	package main

	import "fmt"

	func adder() func(int) int {
	     sum := 0
	     return func(x int) int {
	          sum += x
	          return sum
	     }
	}

	func main() {
	     pos, neg := adder(), adder()
	     for i := 0; i < 10; i++ {
	          fmt.Println(
	               pos(i),
	               neg(-2*i),
	          )
	     }
	}
	
	运行返回结果：
	0 0
	1 -2
	3 -6
	6 -12
	10 -20
	15 -30
	21 -42
	28 -56
	36 -72
	45 -90

这个就是Go中的闭包，一个函数和与其相关的引用环境组合而成的实体。

 

关于闭包的概念《闭包的概念、形式和应用》一文已经说的很清楚了。

 

个人理解： 

其实理解闭包的最方便的方法就是将闭包函数看成一个类，一个闭包函数调用就是实例化一个类。

然后就可以根据类的角度看出哪些是“全局变量”，哪些是“局部变量”了。

比如上例中的adder函数返回func(int) int 的函数

pos和neg分别实例化了两个“闭包类”，在这个“闭包类”中有个“闭包全局变量”sum。所以这样就很好理解返回的结果了。

* php 闭包

匿名函数

提到闭包就不得不想起匿名函数，也叫闭包函数（closures），貌似PHP闭包实现主要就是靠它。声明一个匿名函数是这样：


	$func = function() {
    
	}; //带结束符
可以看到，匿名函数因为没有名字，如果要使用它，需要将其返回给一个变量。匿名函数也像普通函数一样可以声明参数，调用方法也相同：


	$func = function( $param ) {
    	echo $param;
	};

	$func( 'some string' );

	//输出：
	//some string

顺便提一下，PHP在引入闭包之前，也有一个可以创建匿名函数的函数：create function，但是代码逻辑只能写成字符串，这样看起来很晦涩并且不好维护，所以很少有人用。

 

实现闭包

将匿名函数在普通函数中当做参数传入，也可以被返回。这就实现了一个简单的闭包。

下边有三个例子

	//例一
	//在函数里定义一个匿名函数，并且调用它
	function printStr() {
    	$func = function( $str ) {
       	 	echo $str;
    	};
    	$func( 'some string' );
	}

	printStr();


<!---->
	//例二
	//在函数中把匿名函数返回，并且调用它
	function getPrintStrFunc() {
    	$func = function( $str ) {
        	echo $str;
    	};
    	return $func;
	}

	$printStrFunc = getPrintStrFunc();
	$printStrFunc( 'some string' );


<!---->

	//例三
	//把匿名函数当做参数传递，并且调用它
	function callFunc( $func ) {
    	$func( 'some string' );
	}

	$printStrFunc = function( $str ) {
    	echo $str;
	};
	callFunc( $printStrFunc );

	//也可以直接将匿名函数进行传递。如果你了解js，这种写法可能会很熟悉
	callFunc( function( $str ) {
    	echo $str;
	});

 

连接闭包和外界变量的关键字：USE

闭包可以保存所在代码块上下文的一些变量和值。PHP在默认情况下，匿名函数不能调用所在代码块的上下文变量，而需要通过使用use关键字。

换一个例子看看：

	function getMoney() {
    	$rmb = 1;
    	$dollar = 6;
    	$func = function() use ( $rmb ) {
        	echo $rmb;
        	echo $dollar;
    	};
    	$func();
	}

	getMoney();

	//输出：
	//1
	//报错，找不到dorllar变量
可以看到，dollar没有在use关键字中声明，在这个匿名函数里也就不能获取到它，所以开发中要注意这个问题。

有人可能会想到，是否可以在匿名函数中改变上下文的变量，但我发现是不可以的：

	function getMoney() {
    	$rmb = 1;
    	$func = function() use ( $rmb ) {
        	echo $rmb;
        	//把$rmb的值加1
        	$rmb++;
    	};
    	$func();
    	echo $rmb;
	}

	getMoney();

	//输出：
	//1
	//1
啊，原来use所引用的也只不过是变量的一个副本而已。但是我想要完全引用变量，而不是复制。

要达到这种效果，其实在变量前加一个 & 符号就可以了：

	function getMoney() {
    	$rmb = 1;
    	$func = function() use ( &$rmb ) {
        	echo $rmb;
        	//把$rmb的值加1
        	$rmb++;
    	};
    	$func();
    	echo $rmb;
	}

	getMoney();

	//输出：
	//1
	//2
好，这样匿名函数就可以引用上下文的变量了。如果将匿名函数返回给外界，匿名函数会保存use所引用的变量，而外界则不能得到这些变量，这样形成‘闭包’这个概念可能会更清晰一些。

根据描述改变一下上面的例子：

	function getMoneyFunc() {
    	$rmb = 1;
    	$func = function() use ( &$rmb ) {
        	echo $rmb;
        	//把$rmb的值加1
        	$rmb++;
    	};
    	return $func;
	}

	$getMoney = getMoneyFunc();
	$getMoney();
	$getMoney();
	$getMoney();

	//输出：
	//1
	//2
	//3

 

总结

PHP闭包的特性并没有太大惊喜，其实用CLASS就可以实现类似甚至强大得多的功能，更不能和js的闭包相提并论，只能期待PHP以后对闭包支持的改进。不过匿名函数还是挺有用的，比如在使用preg_replace_callback等之类的函数可以不用在外部声明回调函数了。

* 存储过程
	
	存储过程是SQL语句和控制语句的预编译集合，以一个名称存储并作为一个单元处理
	比如，以前写两个sql语句，那么mysql的引擎会对这两个sql语句逐一进行语法分析，逐一进行编译，再逐一的执行，而在我们使用了存储过程之后，只有在第一次才进行语法分析和编译，以后客户端直接调用编译的结果就可以了
	
	创建存储过程
	
	<img src="img/create.jpeg" style="width:350px">
	
* 带有in类型的存储过程

	DELIMITER//
	CREATE PROCEDURE xxxxx(IN p_id INT UNSIGNED)
	BEGIN
	xxxx FROM xxx WHERE id = p_id;
	END
* 带有in和out类型的存储过程

	DELIMITER//
	CREATE PROCEDURE xxxxx(IN p_id INT UNSIGNED，OUT numbs INT UNSIGNED)
	BEGIN
	xxxx FROM xxx WHERE id = p_id;
	SELECT FROM xxx INTO numbs
	END
* javascript

	<img src="img/event.jpg" style="width:350px">
	<img src="img/window.jpg" style="width:350px">
	<img src="img/getby.jpg" style="width:350px">
	<img src="img/timer.jpg" style="width:350px">
##2016.09.19
* new Object()和Object.create()的区别
<!--lang:javascript-->
	// Demo
	var a = new Object();  // 创建一个对象，没有父类哦
 
	var b = Object.create(a.prototype);  // b 继承了a的原型
	
第一种：
<!--lang:javascript-->
	var a = {x:1};
	var b = Object.create(a);
	console.log(b);//输出：{};
	console.log(b.__proto__);//输出：{x:1}

第二种：
<!--lang:javascript-->
	//如果用 
	b =new object(a)
	connsole.log(b);//输出：{x:1}
	congsole.log(b.__proto__);//输出：{}
只要注意区分\__proto__和prototype就可以了，所以 
<!---->
	var b = Object.create(a.prototype); // b 继承了a的原型
这个说法是错误的，应该是b.\__proto__=== a.prototype,严格等于
结论：b的原型指向a的prototype属性
<img src="img/jsoop.jpeg" style="width:350px">
<img src="img/oopextend.jpeg" style="width:350px">

* 实例--探测器

<img src="img/dective.jpeg" style="width:350px">
<img src="img/dective2.jpeg" style="width:350px">


##2016.10.17
###sql之left join、right join、inner join的区别

left join(左联接) 返回包括左表中的所有记录和右表中联结字段相等的记录 
right join(右联接) 返回包括右表中的所有记录和左表中联结字段相等的记录
inner join(等值连接) 只返回两个表中联结字段相等的行

* 举例如下：

表A记录如下：
aID　　　　　aNum
1　　　　　a20050111
2　　　　　a20050112
3　　　　　a20050113
4　　　　　a20050114
5　　　　　a20050115

表B记录如下:
bID　　　　　bName
1　　　　　2006032401
2　　　　　2006032402
3　　　　　2006032403
4　　　　　2006032404
8　　　　　2006032408

-

* 1.left join
sql语句如下: 
select * from A
left join B 
on A.aID = B.bID

结果如下:
aID　　　　　aNum　　　　　bID　　　　　bName
1　　　　　a20050111　　　　1　　　　　2006032401
2　　　　　a20050112　　　　2　　　　　2006032402
3　　　　　a20050113　　　　3　　　　　2006032403
4　　　　　a20050114　　　　4　　　　　2006032404
5　　　　　a20050115　　　　NULL　　　　　NULL

（所影响的行数为 5 行）
结果说明:
left join是以A表的记录为基础的,A可以看成左表,B可以看成右表,left join是以左表为准的.
换句话说,左表(A)的记录将会全部表示出来,而右表(B)只会显示符合搜索条件的记录(例子中为: A.aID = B.bID).

B表记录不足的地方均为NULL.

-

* 2.right join
sql语句如下: 
select * from A
right join B 
on A.aID = B.bID

结果如下:
aID　　　　　aNum　　　　　bID　　　　　bName
1　　　　　a20050111　　　　1　　　　　2006032401
2　　　　　a20050112　　　　2　　　　　2006032402
3　　　　　a20050113　　　　3　　　　　2006032403
4　　　　　a20050114　　　　4　　　　　2006032404
NULL　　　　　NULL　　　　　8　　　　　2006032408

（所影响的行数为 5 行）
结果说明:
仔细观察一下,就会发现,和left join的结果刚好相反,这次是以右表(B)为基础的,A表不足的地方用NULL填充.

-

* 3.inner join

sql语句如下: 
select * from A
innerjoin B 
on A.aID = B.bID

结果如下:
aID　　　　　aNum　　　　　bID　　　　　bName
1　　　　　a20050111　　　　1　　　　　2006032401
2　　　　　a20050112　　　　2　　　　　2006032402
3　　　　　a20050113　　　　3　　　　　2006032403
4　　　　　a20050114　　　　4　　　　　2006032404

结果说明:
很明显,这里只显示出了 A.aID = B.bID的记录.这说明inner join并不以谁为基础,它只显示符合条件的记录.

-
注: 
LEFT JOIN操作用于在任何的 FROM 子句中，组合来源表的记录。使用 LEFT JOIN 运算来创建一个左边外部联接。左边外部联接将包含了从第一个（左边）开始的两个表中的全部记录，即使在第二个（右边）表中并没有相符值的记录。

语法：FROM table1 LEFT JOIN table2 ON table1.field1 compopr table2.field2

说明：table1, table2参数用于指定要将记录组合的表的名称。
field1, field2参数指定被联接的字段的名称。且这些字段必须有相同的数据类型及包含相同类型的数据，但它们不需要有相同的名称。
compopr参数指定关系比较运算符："="， "<"， ">"， "<="， ">=" 或 "<>"。
如果在INNER JOIN操作中要联接包含Memo 数据类型或 OLE Object 数据类型数据的字段，将会发生错误. 	

##2016.10.18
* mysql 数据库索引优化

```sql
SELECT * FROM payment WHERE staff_id = 2 AND customer_id = 584;
```
由于customer\_id的离散度更大，所以应该使用index(customer\_id,staff\_id)
需要查询字段的离散程度，离散度越大的列应该放在联合索引的前面

```sql
select count (distinct customer_id),count (distinct staff_id) from 
```
某一列的唯一值越多，说明其离散程度越好，可选择性更好


*注意：索引会影响写入效率


* php安装扩展

以前以为php的扩展要重新编译php，今天在群友的指点下知道可以像apache模块一样动态扩展，以mcrypt举例。
进入要安装的扩展的源码目录

	cd /root/php-5.2.6/ext/mcrypt
	
运行

	phpize
	
	Configuring for:
	PHP Api Version:         20041225
	Zend Module Api No:      20060613
	Zend Extension Api No:   220060519
 
出现这样的提示说明可以扩展。
 
然后编译安装
	
	./configure --with-php-config=/usr/local/php5/bin/php-config 
	make
	make install
=	
	/usr/local/php5/lib/php/extensions/no-debug-non-zts-20060613/
记住这里提示的路径刚才编译的module就在这里

	cd /usr/local/php5/lib/php/extensions/no-debug-non-zts-20060613/
	no-debug-non-zts-20060613 $ls

	eaccelerator.so  mcrypt.so  memcache.so

然后编辑php.ini（如果php安装在/usr/local/php5 则php.ini在/usr/local/php5/lib/php.ini中添加

	extension_dir = "/usr/local/php5/lib/php/extensions/no-debug-non-zts-20060613/"
	extension = "mcrypt.so"

然后重启apache，然后再访问phpinfo.php 就看到支持mcrypt了。

##2016.10.20
###mac 一般使用bash作为默认shell

Mac系统的环境变量，加载顺序为：

	/etc/profile 
	/etc/paths 
	~/.bash_profile 
	~/.bash_login 
	~/.profile 
	~/.bashrc

当然/etc/profile和/etc/paths是系统级别的，系统启动就会加载，后面几个是当前用户级的环境变量。后面3个按照从前往后的顺序读取，如果~/.bash_profile文件存在，则后面的几个文件就会被忽略不读了，如果~/.bash_profile文件不存在，才会以此类推读取后面的文件。~/.bashrc没有上述规则，它是bash shell打开的时候载入的。

如果没特殊说明,设置PATH的语法都为：

     export PATH=$PATH:<PATH 1>:<PATH 2>:<PATH 3>:------:<PATH N>

（一）全局设置
下面的几个文件设置是全局的，修改时需要root权限

1）/etc/paths （全局建议修改这个文件 ）
编辑 paths，将环境变量添加到 paths文件中 ，一行一个路径
Hint：输入环境变量时，不用一个一个地输入，只要拖动文件夹到 Terminal 里就可以了。

2）/etc/profile （建议不修改这个文件 ）
全局（公有）配置，不管是哪个用户，登录时都会读取该文件。

3）/etc/bashrc （一般在这个文件中添加系统级环境变量）
全局（公有）配置，bash shell执行时，不管是何种方式，都会读取此文件。

4）
1.创建一个文件：

	sudo touch /etc/paths.d/mysql
2.用 vim 打开这个文件（如果是以 open -t 的方式打开，则不允许编辑）：

	sudo vim /etc/paths.d/mysql
3.编辑该文件，键入路径并保存（关闭该 Terminal 窗口并重新打开一个，就能使用 mysql 命令了）

	/usr/local/mysql/bin
据说，这样可以自己生成新的文件，不用把变量全都放到 paths 一个文件里，方便管理。

（二）单个用户设置

	1）~/.bash_profile （任意一个文件中添加用户级环境变量）
（注：Linux 里面是 .bashrc 而 Mac 是 .bash_profile）
若bash shell是以login方式执行时，才会读取此文件。该文件仅仅执行一次!默认情况下,他设置一些环境变量
设置命令别名
	
	alias ll=’ls -la’
设置环境变量：

	export PATH=/opt/local/bin:/opt/local/sbin:$PATH
2）~/.bashrc 同上

如果想立刻生效，则可执行下面的语句：
	
	$ source 相应的文件
一般环境变量更改后，重启后生效。
##2016.10.21
###使用php多进程和IPC以及异步操作的研究
* php进程间通信使用的是消息队列或者信号量与内存共享

<font style="color:red">消息队列</font>使用设计模式中的消费者生产者模式，然后使用fork出一个子进程，然后生成出的子进程，先产生生产者进程，然后去产生消费者进程，生产者进程往进程中增加一些消息，通过msg\_send 方法，可以实现将需要传递的数据线扔到缓存中，然后产生消费者进程通过msg\_receive 实现从缓存中读取数据的方法；关于<font style="color:red">共享内存</font>，应该是最快速的ipc，它的主要实现原理是映射一段能被其他进程所访问到的内存，这段内存由一个进程创建，多进程都可以访问

php的异步操作所使用的方案是gearman或者yield关键字，目前在为PHP安装gearman扩展的过程中出现的问题是缺少boost，boost现在在brew install 一键安装的时候，出现了问题报错目前未解决，不过现在已经拥有了gearman的源码包，并且workerman和swoole都纷纷使用了gearman

##2016.10.24
###laravel中的容器和请求实例
首先Laravel框架捕获到用户发到public\index.php的请求，生成Illuminate\Http\Request实例，传递给这个小小的handle方法。在方法内部，将该<font color="red">$request实例绑定到第二步生成的$app容器上</font>。让后在该请求真正处理之前，调用bootstrap方法，进行必要的加载和注册，如检测环境，加载配置，注册Facades（假象），注册服务提供者，启动服务提供者等等。

* 服务容器

服务容器就是一个普通的容器，用来装类的实例，然后在需要的时候再取出来。用更专业的术语来说是服务容器实现了控制反转（Inversion of Control，缩写为IoC），意思是正常情况下类A需要一个类B的时候，我们需要自己去new类B，意味着我们必须知道类B的更多细节，比如构造函数，随着项目的复杂性增大，这种依赖是毁灭性的。控制反转的意思就是，将类A主动获取类B的过程颠倒过来变成被动，类A只需要声明它需要什么，然后由容器提供。

* 事件绑定

* 依赖注入

传统的思路是应用程序用到一个Foo类，就会创建Foo类并调用Foo类的方法，假如这个方法内需要一个Bar类，就会创建Bar类并调用Bar类的方法，而这个方法内需要一个Bim类，就会创建Bim类，接着做些其它工作。

```php
	// 代码【1】
    class Bim
    {
        public function doSomething()
        {
            echo __METHOD__, '|';
        }
    }
    
    class Bar
    {
        public function doSomething()
        {
            $bim = new Bim();
            $bim->doSomething();
            echo __METHOD__, '|';
        }
    }
    
    class Foo
    {
        public function doSomething()
        {
            $bar = new Bar();
            $bar->doSomething();
            echo __METHOD__;
        }
    }
    
    $foo = new Foo();
    $foo->doSomething(); //Bim::doSomething|Bar::doSomething|Foo::doSomething
```

使用依赖注入的思路是应用程序用到Foo类，Foo类需要Bar类，Bar类需要Bim类，那么先创建Bim类，再创建Bar类并把Bim注入，再创建Foo类，并把Bar类注入，再调用Foo方法，Foo调用Bar方法，接着做些其它工作。

```php
	// 代码【2】
    class Bim
    {
        public function doSomething()
        {
            echo __METHOD__, '|';
        }
    }
    
    class Bar
    {
        private $bim;
    
        public function __construct(Bim $bim)
        {
            $this->bim = $bim;
        }
    
        public function doSomething()
        {
            $this->bim->doSomething();
            echo __METHOD__, '|';
        }
    }
    
    class Foo
    {
        private $bar;
    
        public function __construct(Bar $bar)
        {
            $this->bar = $bar;
        }
    
        public function doSomething()
        {
            $this->bar->doSomething();
            echo __METHOD__;
        }
    }
    
    $foo = new Foo(new Bar(new Bim()));
    $foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething
```

这就是控制反转模式。依赖关系的控制反转到调用链的起点。这样你可以完全控制依赖关系，通过调整不同的注入对象，来控制程序的行为。例如Foo类用到了memcache，可以在不修改Foo类代码的情况下，改用redis。

使用依赖注入容器后的思路是应用程序需要到Foo类，就从容器内取得Foo类，容器创建Bim类，再创建Bar类并把Bim注入，再创建Foo类，并把Bar注入，应用程序调用Foo方法，Foo调用Bar方法，接着做些其它工作.

总之容器负责实例化，注入依赖，处理依赖关系等工作。

* 代码演示

```php
	class Container
    {
        private $s = array();
    
        function __set($k, $c)
        {
            $this->s[$k] = $c;
        }
    
        function __get($k)
        {
            return $this->s[$k]($this);
        }
    }
```

这段代码使用了魔术方法，在给不可访问属性赋值时，__set() 会被调用。读取不可访问属性的值时，__get() 会被调用。

```php
	$c = new Container();
    
    $c->bim = function () {
        return new Bim();
    };
    $c->bar = function ($c) {
        return new Bar($c->bim);
    };
    $c->foo = function ($c) {
        return new Foo($c->bar);
    };
    
    // 从容器中取得Foo
    $foo = $c->foo;
    $foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething
```
这段代码使用了匿名函数

再来一段简单的代码演示一下

```php
 class IoC
    {
        protected static $registry = [];
    
        public static function bind($name, Callable $resolver)
        {
            static::$registry[$name] = $resolver;
        }
    
        public static function make($name)
        {
            if (isset(static::$registry[$name])) {
                $resolver = static::$registry[$name];
                return $resolver();
            }
            throw new Exception('Alias does not exist in the IoC registry.');
        }
    }
    
    IoC::bind('bim', function () {
        return new Bim();
    });
    IoC::bind('bar', function () {
        return new Bar(IoC::make('bim'));
    });
    IoC::bind('foo', function () {
        return new Foo(IoC::make('bar'));
    });
    
    
    // 从容器中取得Foo
    $foo = IoC::make('foo');
    $foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething
```

这段代码使用了后期静态绑定

* 依赖注入容器的高级功能

1.自动绑定或者自动解析
2.注释解析器
3.延迟注入

```php
class Bim
    {
        public function doSomething()
        {
            echo __METHOD__, '|';
        }
    }
    
    class Bar
    {
        private $bim;
    
        public function __construct(Bim $bim)
        {
            $this->bim = $bim;
        }
    
        public function doSomething()
        {
            $this->bim->doSomething();
            echo __METHOD__, '|';
        }
    }
    
    class Foo
    {
        private $bar;
    
        public function __construct(Bar $bar)
        {
            $this->bar = $bar;
        }
    
        public function doSomething()
        {
            $this->bar->doSomething();
            echo __METHOD__;
        }
    }
    
    class Container
    {
        private $s = array();
    
        public function __set($k, $c)
        {
            $this->s[$k] = $c;
        }
    
        public function __get($k)
        {
            // return $this->s[$k]($this);
            return $this->build($this->s[$k]);
        }
    
        /**
         * 自动绑定（Autowiring）自动解析（Automatic Resolution）
         *
         * @param string $className
         * @return object
         * @throws Exception
         */
        public function build($className)
        {
            // 如果是匿名函数（Anonymous functions），也叫闭包函数（closures）
            if ($className instanceof Closure) {
                // 执行闭包函数，并将结果
                return $className($this);
            }
    
            /** @var ReflectionClass $reflector */
            $reflector = new ReflectionClass($className);
    
            // 检查类是否可实例化, 排除抽象类abstract和对象接口interface
            if (!$reflector->isInstantiable()) {
                throw new Exception("Can't instantiate this.");
            }
    
            /** @var ReflectionMethod $constructor 获取类的构造函数 */
            $constructor = $reflector->getConstructor();
    
            // 若无构造函数，直接实例化并返回
            if (is_null($constructor)) {
                return new $className;
            }
    
            // 取构造函数参数,通过 ReflectionParameter 数组返回参数列表
            $parameters = $constructor->getParameters();
    
            // 递归解析构造函数的参数
            $dependencies = $this->getDependencies($parameters);
    
            // 创建一个类的新实例，给出的参数将传递到类的构造函数。
            return $reflector->newInstanceArgs($dependencies);
        }
    
        /**
         * @param array $parameters
         * @return array
         * @throws Exception
         */
        public function getDependencies($parameters)
        {
            $dependencies = [];
    
            /** @var ReflectionParameter $parameter */
            foreach ($parameters as $parameter) {
                /** @var ReflectionClass $dependency */
                $dependency = $parameter->getClass();
    
                if (is_null($dependency)) {
                    // 是变量,有默认值则设置默认值
                    $dependencies[] = $this->resolveNonClass($parameter);
                } else {
                    // 是一个类，递归解析
                    $dependencies[] = $this->build($dependency->name);
                }
            }
    
            return $dependencies;
        }
    
        /**
         * @param ReflectionParameter $parameter
         * @return mixed
         * @throws Exception
         */
        public function resolveNonClass($parameter)
        {
            // 有默认值则返回默认值
            if ($parameter->isDefaultValueAvailable()) {
                return $parameter->getDefaultValue();
            }
    
            throw new Exception('I have no idea what to do here.');
        }
    }
    
    // ----
    $c = new Container();
    $c->bar = 'Bar';
    $c->foo = function ($c) {
        return new Foo($c->bar);
    };
    // 从容器中取得Foo
    $foo = $c->foo;
    $foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething
    
    // ----
    $di = new Container();
    
    $di->foo = 'Foo';
    
    /** @var Foo $foo */
    $foo = $di->foo;
    
    var_dump($foo);
    /*
    Foo#10 (1) {
      private $bar =>
      class Bar#14 (1) {
        private $bim =>
        class Bim#16 (0) {
        }
      }
    }
    */
    
    $foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething
```
以上代码的原理参考PHP官方文档：反射，PHP 5 具有完整的反射 API，添加了对类、接口、函数、方法和扩展进行反向工程的能力。 此外，反射 API 提供了方法来取出函数、类和方法中的文档注释。

若想进一步提供一个数组访问接口，如$di->foo可以写成$di'foo']，则需用到[ArrayAccess（数组式访问）接口 。

一些复杂的容器会有许多特性，下面列出一些相关的github项目，欢迎补充。

##2016.11.2
###安装php7 mongoDB扩展

* 如果在php/bin目录下有pecl install 那么可以一键安装pecl install mongodb

* 如果没有，那么你需要源码编译安装
	
	首先你需要在[mongodb-php扩展](https://pecl.php.net/package/mongodb)下载一个mongodb的源码包
	
	然后
	
		tar -zxvf mongodb-xxx.tgz
    	cd mongodb-xxx
    	phpize
    	./configure --with-php-config=/xxx/php-config --with-openssl-dir = /usr/local/Cellar/openssl/xxxx
    	make && make install
    最后，在php.ini中加入扩展extension=mongodb.so，可以使用php -i|grep php.ini来定位到php.ini绝对路径

###mongoDB 中的 capped collections
Capped collections 就是固定大小的collection。
它有很高的性能以及队列过期的特性(过期按照插入的顺序). 有点和 "RRD" 概念类似。
Capped collections是高性能自动的维护对象的插入顺序。它非常适合类似记录日志的功能 和标准的collection不同，你必须要显式的创建一个capped collection， 指定一个collection的大小，单位是字节。collection的数据存储空间值提前分配的。
要注意的是指定的存储大小包含了数据库的头信息。

	db.createCollection("mycoll", {capped:true, size:100000})

* 在capped collection中，你能添加新的对象。
* 能进行更新，然而，对象不会增加存储空间。如果增加，更新就会失败 。
* 数据库不允许进行删除。使用drop()方法删除collection所有的行。
* 注意: 删除之后，你必须显式的重新创建这个collection。
在32bit机器中，capped collection最大存储为1e9( 1X109)个字节。

##2016.11.8
###go语言的空接口强制类型转换

* 循环使用反射来处理
* 如果要是转换成字典需要unsafe

##2016.11.10
###socket聊天室的思路

用户登录时，握手等，以流的形式处理，三个数组或者list来存储流数据，一个作为处理主进程的，处理握手，处理登录，一个作为处理读数据的，一个作为写数据的，

##2016.12.8
###数据库架构

最好不要在主库上进行数据备份，大型活动前取消这类计划
mysql不支持多CPU的并发运算，所以对数据库来说，一条sql执行10ms和100ms是有天壤之别的
大量的并发量，数据库的连接数被占满
数据库问题其实主要的问题就是sql慢查询的问题和磁盘IO的问题

##2017.1.10
###go语言支持IPC的方法

IPC的意思是Interprocess Communication 
IPC有三种  基于通讯  基于信号  基于同步
基于通讯有两种 数据传送  共享内存
数据传送有两种 管道 消息队列 => 管道用来传送字节流  消息队列传送结构化的数据
go语言支持的IPC主要是管道、信号、Socket

##2017.2.15
###进程的衍生

如果进程的父进程挂了，子进程不会中断而是被祖先进程（即内核启动进程“收养”）成为它的直接进程

##2017.2.23
###什么是进程描述符

进程描述符并不是一个简单的符号，而是一个非常复杂的数据结构，记录了进程的优先级，状态，虚拟地址范围以及各种访问权限
进程描述符不仅仅包含有自己的操作系统中的唯一标识符PID，还包含其父进程的PPID

##2017.3.9
###进程的标识

PID并不传达与进程有关的任何信息，PPID一样，但是PPID确实体现了两个进程之间的亲缘关系，我们可以利用这一点来找到守护进程

##2017.3.13
###进程的状态

每个进程在不同时刻都有可能会有不同的状态，这些进程的状态一共可以分成6个
1.可运行状态：将要运行在CPU上
2.可中断的睡眠状态：当进程正在等待某个事件的时候，会被放在对应事件的等待队列中
3.不可中断的睡眠状态：不会对任何信号做出响应
4.暂停状态或者跟踪状态：向进程发送SIGSTOP的状态，就会进入暂停状态，向暂停状态的进程发送SIGCONT信号会使得该进程转向可运行状态
5.僵尸状态：即将结束，绝大多数资源被回收，有一些信息未删除
6.退出状态：当一个进程消亡的时候，内核会给其父进程发送一个SIGCHLD信号以告知此情况

##2017.3.20
###go语言的http请求
golang要请求远程网页，可以使用net/http包中的client提供的方法实现。查看了官方网站有一些示例，没有太全面的例子，于是自己整理了一下。

get请求

get请求可以直接http.Get方法，非常简单。

func httpGet() {
    resp, err := http.Get("http://www.01happy.com/demo/accept.php?id=1")
    if err != nil {
        // handle error
    }
 
    defer resp.Body.Close()
    body, err := ioutil.ReadAll(resp.Body)
    if err != nil {
        // handle error
    }
 
    fmt.Println(string(body))
}
post请求

一种是使用http.Post方式

func httpPost() {
    resp, err := http.Post("http://www.01happy.com/demo/accept.php",
        "application/x-www-form-urlencoded",
        strings.NewReader("name=cjb"))
    if err != nil {
        fmt.Println(err)
    }
 
    defer resp.Body.Close()
    body, err := ioutil.ReadAll(resp.Body)
    if err != nil {
        // handle error
    }
 
    fmt.Println(string(body))
}
Tips：使用这个方法的话，第二个参数要设置成”application/x-www-form-urlencoded”，否则post参数无法传递。

一种是使用http.PostForm方法

func httpPostForm() {
    resp, err := http.PostForm("http://www.01happy.com/demo/accept.php",
        url.Values{"key": {"Value"}, "id": {"123"}})
 
    if err != nil {
        // handle error
    }
 
    defer resp.Body.Close()
    body, err := ioutil.ReadAll(resp.Body)
    if err != nil {
        // handle error
    }
 
    fmt.Println(string(body))
 
}
复杂的请求

有时需要在请求的时候设置头参数、cookie之类的数据，就可以使用http.Do方法。


func httpDo() {
    client := &http.Client{}
 
    req, err := http.NewRequest("POST", "http://www.01happy.com/demo/accept.php", strings.NewReader("name=cjb"))
    if err != nil {
        // handle error
    }
 
    req.Header.Set("Content-Type", "application/x-www-form-urlencoded")
    req.Header.Set("Cookie", "name=anny")
 
    resp, err := client.Do(req)
 
    defer resp.Body.Close()
 
    body, err := ioutil.ReadAll(resp.Body)
    if err != nil {
        // handle error
    }
 
    fmt.Println(string(body))
}
同上面的post请求，必须要设定Content-Type为application/x-www-form-urlencoded，post参数才可正常传递。

如果要发起head请求可以直接使用http client的head方法，比较简单

## 2017.4.7
### Redis list 之增删改查
一、增加

1、lpush [lpush key valus...]  类似于压栈操作，将元素放入头部

```ssh
127.0.0.1:6379> lpush plist ch0 ch1 ch2
(integer) 3
127.0.0.1:6379> lrange plist 0 3
1) "ch2"
2) "ch1"
3) "ch0"
127.0.0.1:6379> lpush plist ch4
(integer) 4
127.0.0.1:6379> lrange plist 0 4
1) "ch4"
2) "ch2"
3) "ch1"
4) "ch0"
```

2 、lpushx [lpushx key valus]:只能插入已经存在的key,且一次只能插入一次

```ssh
127.0.0.1:6379> lpushx pl ch
(integer) 0
127.0.0.1:6379> lpushx plist ch5 ch6
(error) ERR wrong number of arguments for 'lpushx' command
127.0.0.1:6379> lpushx plist ch5
(integer) 5
127.0.0.1:6379> lrange plist 0 5
1) "ch5"
2) "ch4"
3) "ch2"
4) "ch1"
5) "ch0"
```

3、rpush  [rpush key valus...] ：将元素push在list的尾部

```ssh
127.0.0.1:6379> rpush plist ch6
(integer) 6
127.0.0.1:6379> lrange plist 0 6
1) "ch5"
2) "ch4"
3) "ch2"
4) "ch1"
5) "ch0"
6) "ch6"
127.0.0.1:6379> rpush plist ch7 ch8
(integer) 8
127.0.0.1:6379> lrange plist 0 8
1) "ch5"
2) "ch4"
3) "ch2"
4) "ch1"
5) "ch0"
6) "ch6"
7) "ch7"
8) "ch8"
```

4、rpushx [rpushx key valus...] :相对于lpushx

5、linsert [linsert key before/after pivot value]:将值插入到pivot的前面或后面。返回列表元素个数。如果参照点pivot不存在不插入。如果有多个pivot，以离表头最近的为准

```ssh
127.0.0.1:6379> linsert plist before ch1 chi
(integer) 9
127.0.0.1:6379> lrange plist 0 9
1) "ch5"
2) "ch4"
3) "ch2"
4) "chi"
5) "ch1"
6) "ch0"
7) "ch6"
8) "ch7"
9) "ch8"
127.0.0.1:6379> linsert plist before chii chi2
(integer) -1
127.0.0.1:6379> linsert plist after chi cha
(integer) 10
127.0.0.1:6379> lrange plist 0 10
 1) "ch5"
 2) "ch4"
 3) "ch2"
 4) "chi"
 5) "cha"
 6) "ch1"
 7) "ch0"
 8) "ch6"
 9) "ch7"
10) "ch8"
//以上插入操作均是返回list的长度
```


二、删除

1、lpop 、rpop：分别为删除头部和尾部，返回被删除的元素

```ssh
127.0.0.1:6379> lpop plist
"ch5"
127.0.0.1:6379> lrange plist 0 10
1) "ch4"
2) "ch2"
3) "chi"
4) "cha"
5) "ch1"
6) "ch0"
7) "ch6"
8) "ch7"
9) "ch8"
127.0.0.1:6379> rpop plist
"ch8"
127.0.0.1:6379> lrange plist 0 10
1) "ch4"
2) "ch2"
3) "chi"
4) "cha"
5) "ch1"
6) "ch0"
7) "ch6"
8) "ch7"
```

2 、ltrim [ltrim key  range_l range_r]:保留区域类的元素，其他的删除

```ssh
127.0.0.1:6379> ltrim plist 0 3
OK
127.0.0.1:6379> lrange plist 0 10
1) "ch4"
2) "ch2"
3) "chi"
4) "cha"
```

3、lrem [lrem key count value] :移除等于value的元素，当count>0时，从表头开始查找，移除count个；当count=0时，从表头开始查找，移除所有等于value的；当count<0时，从表尾开始查找，移除|count| 个。

cout >0

```ssh
127.0.0.1:6379> lrange plist 0 10
 1) "ch0"
 2) "ch0"
 3) "ch0"
 4) "ch4"
 5) "chi"
 6) "cha"
 7) "ch0"
 8) "ch0"
 9) "ch0"
10) "ch0"
127.0.0.1:6379> lrem plist 5 ch0
(integer) 5
127.0.0.1:6379> lrange plist 0 10
1) "ch4"
2) "chi"
3) "cha"
4) "ch0"
5) "ch0"
```

count <0

```ssh
127.0.0.1:6379> lrange plist 0 10
 1) "ch0"
 2) "ch9"
 3) "ch0"
 4) "ch0"
 5) "ch0"
 6) "ch4"
 7) "chi"
 8) "cha"
 9) "ch0"
10) "ch0"
127.0.0.1:6379> lrem plist -5 ch0
(integer) 5
127.0.0.1:6379> lrange plist 0 10
1) "ch0"
2) "ch9"
3) "ch4"
4) "chi"
5) "cha"
```

三、修改
lset [lset key index value] : 设置列表指定索引的值，如果指定索引不存在则报错

```ssh
127.0.0.1:6379> lset plist 0 ch2
OK
127.0.0.1:6379> lrange plist 0 10
1) "ch2"
2) "ch9"
3) "ch4"
4) "chi"
5) "cha"
```

四、查询
1、lindex [lindex key index]:通过索引index获取列表的元素、key>=0从头到尾，key<0从尾到头

```ssh
127.0.0.1:6379> lrange plist 0 10
1) "ch2"
2) "ch9"
3) "ch4"
4) "chi"
5) "cha"
127.0.0.1:6379> lindex plist 0
"ch2"
127.0.0.1:6379> lindex plist -0
"ch2"
127.0.0.1:6379> lindex plist -1
"cha"
127.0.0.1:6379> lindex plist 5
(nil)
```

2、lrange [lrange key range_l range_r]:0 表头、-1表尾

## 2017.04.10
### go语言redis redigo

* redis操作：
 
```golang
// tcp连接redis
 
  rs, err := redis.Dial("tcp", host)
 
  // 操作完后自动关闭 
 
  defer rs.Close()
 
 // 操作redis时调用Do方法，第一个参数传入操作名称（字符串），然后根据不同操作传入key、value、数字等
 // 返回2个参数，第一个为操作标识，成功则为1，失败则为0；第二个为错误信息
 value, err := redis.String(rs.Do("GET", key))
 if err != nil {
    fmt.Println("fail")
 }
 
 若value的类型为int，则用redis.Int转换
 
 若value的类型为string，则用redis.String转换
 
 若value的类型为json，则用redis.Byte转换
 
 // 存json数据
 key := "aaa"
 imap := map[string]string{"key1": "111", "key2": "222"}
 // 将map转换成json数据
 value, _ := json.Marshal(imap)
 // 存入redis
 n, err := rs.Do("SETNX", key, value)
 if err != nil {
     fmt.Println(err)
 }
 if n == int64(1) {
     fmt.Println("success")
 }
// 取json数据
// 先声明imap用来装数据
var imap map[string]string
key := "aaa"<br>// json数据在go中是[]byte类型，所以此处用redis.Bytes转换
value, err := redis.Bytes(rs.Do("GET", key))
if err != nil {
    fmt.Println(err)
}
// 将json解析成map类型
errShal := json.Unmarshal(value, &imap)
if errShal != nil {
    fmt.Println(err)
}
fmt.Println(imap["key1"])
fmt.Println(imap["key2"])
```

* 一个订阅发布功能

```golang
package models

import (
    "github.com/garyburd/redigo/redis"
    "github.com/astaxie/beego"
    "time"
    "fmt"
)

var (
    //定义常亮
    RedisClient *redis.Pool
    REDIS_HOST string
    REDIS_PORT string
    REDIS_DB int
)

func init() {
    //从配置文件中获取redis的ip以及db
    REDIS_HOST = beego.AppConfig.String("redis_host")
    REDIS_PORT = beego.AppConfig.String("redis_port")
    REDIS_DB = beego.AppConfig.DefaultInt("redis_db", 0)
    // 建立连接池
    RedisClient = &redis.Pool{
        // 从配置文件获取maxidle以及maxactive，取不到则用后面的默认值
        MaxIdle:     beego.AppConfig.DefaultInt("redis_maxidle", 100),
        MaxActive:   beego.AppConfig.DefaultInt("redis_maxactive", 1024),
        IdleTimeout: 180 * time.Second,
        Dial: func() (redis.Conn, error) {
            c, err := redis.Dial("tcp", REDIS_HOST+":"+REDIS_PORT)
            if err != nil {
                return nil, err
            }
            // 选择db
            //c.Do("SELECT", REDIS_DB)
            return c, nil
        },
    }
}

/**
 *redis订阅信息
 *
 */
func Subscribe() {
    c := RedisClient.Get()
    psc := redis.PubSubConn{c}
    psc.Subscribe("redChatRoom")

    defer func() {
        c.Close()
        psc.Unsubscribe("redChatRoom")　　//取消订阅
    } ()
    for {
        switch v := psc.Receive().(type) {
        case redis.Message:
            fmt.Printf("%s: messages: %s\n", v.Channel, v.Data)
        case redis.Subscription:
            //fmt.Printf("%s: %s %d\n", v.Channel, v.Kind, v.Count)
            continue
        case error:
            fmt.Println(v)
            return
        }
    }
}

/**
 *redis发布信息
 *
 */
func Pubscribe(s string) {
    c := RedisClient.Get()
    defer c.Close()

    _, err := c.Do("PUBLISH", "redChatRoom", s)
    if err != nil {
        fmt.Println("pub err: ", err)
        return
    }
}

func test() {
    // 从池里获取连接
    rc := RedisClient.Get()
    // 用完后将连接放回连接池
    defer rc.Close()
    //rc.Do()
    //n, _ := rc.Do("EXPIRE", key, 24*3600)  
    //value, err := redis.String(rs.Do("GET", key))
    return
}
```

## 2017.04.15
### go语言redigo存储struct的几个例子

* 例子1

```golang
package main

import (
    "github.com/garyburd/redigo/redis"
    "log"
)

func main() {
    conn, err := redis.Dial("tcp", ":6379")
    if err != nil {
        log.Fatalf("Couldn't connect to Redis: %v\n", err)
    }
    defer conn.Close()

    stockData := map[string]map[string]string{
        "GOOG": {"company_name": "Google Inc.", "open_price": "803.99", "ask_price": "795.50", "close_price": "802.66", "bid_price": "793.36"},
        "MSFT": {"ask_price": "N/A", "open_price": "28.30", "company_name": "Microsoft Corpora", "bid_price": "28.50", "close_price": "28.37"},
    }

    // Example 1: Write command arguments out explicitly.

    for sym, row := range stockData {
        if _, err := conn.Do("HMSET", sym,
            "company_name", row["company_name"],
            "open_price", row["open_price"],
            "ask_price", row["ask_price"],
            "bid_price", row["bid_price"]); err != nil {
            log.Fatal(err)
        }
    }

    printAndDel(conn, "example 1", stockData)

    // Example 2: Construct command arguments using range over a row map.

    for sym, row := range stockData {
        args := []interface{}{sym}
        for k, v := range row {
            args = append(args, k, v)
        }
        if _, err := conn.Do("HMSET", args...); err != nil {
            log.Fatal(err)
        }
    }

    printAndDel(conn, "example 2", stockData)

    // Example 3: Construct command arguments using Redigo helper function.

    for sym, row := range stockData {
        if _, err := conn.Do("HMSET", redis.Args{sym}.AddFlat(row)...); err != nil {
            log.Fatal(err)
        }
    }

    printAndDel(conn, "example 3", stockData)
}

func printAndDel(conn redis.Conn, message string, stockData map[string]map[string]string) {
    log.Print(message)
    for sym := range stockData {
        values, err := redis.Values(conn.Do("HGETALL", sym))
        if err != nil {
            log.Fatal(err)
        }
        log.Print(sym)
        for i := 0; i < len(values); i += 2 {
            log.Printf("  %s: %s", values[i], values[i+1])
        }
    }
    for sym := range stockData {
        if _, err := conn.Do("DEL", sym); err != nil {
            log.Fatal(err)
        }
    }
}
```
* 例子2

```golang
package main

import (
    "github.com/garyburd/redigo/redis"
    "log"
)

type Stock struct {
    CompanyName string `redis:"company_name"`
    OpenPrice   string `redis:"open_price"`
    AskPrice    string `redis:"ask_price"`
    ClosePrice  string `redis:"close_price"`
    BidPrice    string `redis:"bid_price"`
}

func main() {
    conn, err := redis.Dial("tcp", ":6379")
    if err != nil {
        log.Fatalf("Couldn't connect to Redis: %v\n", err)
    }
    defer conn.Close()

    stockData := map[string]*Stock{
        "GOOG": &Stock{CompanyName: "Google Inc.", OpenPrice: "803.99", AskPrice: "795.50", ClosePrice: "802.66", BidPrice: "793.36"},
        "MSFT": &Stock{AskPrice: "N/A", OpenPrice: "28.30", CompanyName: "Microsoft Corpora", BidPrice: "28.50", ClosePrice: "28.37"},
    }

    for sym, row := range stockData {
        if _, err := conn.Do("HMSET", redis.Args{sym}.AddFlat(row)...); err != nil {
            log.Fatal(err)
        }
    }

    for sym := range stockData {
        values, err := redis.Values(conn.Do("HGETALL", sym))
        if err != nil {
            log.Fatal(err)
        }
        var stock Stock
        if err := redis.ScanStruct(values, &stock); err != nil {
            log.Fatal(err)
        }
        log.Printf("%s: %+v", sym, &stock)
    }
}
```

## 2017.04.20
### mysql5.7新特性

1. 在server层提供了操作JSON的函数，将JSON编码成BLOB然后交给存储引擎层进行处理
2. MySQL相对于Mongodb的优势：可以混合存储结构化和非结构化的数据，同时拥有关系型数据库和非关系型数据库的优点，而且能够支持事物处理

```ssh
CREATE TABLE t1 (jdoc JSON);
INSERT INTO t1 VALUES('{"key1": "value1", "key2": "value2"}');
```

## 2017.04.23
### laravel Excel

* 导出

```php
	public function export(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
```
如果你要导出csv或者xlsx文件，只需将export方法中的参数改成csv或xlsx即可。

如果还要将该Excel文件保存到服务器上，可以使用store方法：

```php
Excel::create('学生成绩',function($excel) use ($cellData){
     $excel->sheet('score', function($sheet) use ($cellData){
         $sheet->rows($cellData);
     });
})->store('xls')->export('xls');
```
文件默认保存到storage/exports目录下，如果出现文件名中文乱码，将上述代码文件名做如下修改即可：

```php
iconv('UTF-8', 'GBK', '学生成绩')
```

* 导入

```php
public function Importexcel($files){  
  
    $res = [];  
    Excel::load($files, function($reader) use( &$res ) {  
        $reader = $reader->getSheet(0);  
        $res = $reader->toArray();  
    });  
      
    return $res;  
}  
```

Basics 基础

A new file can be created using thecreatemethod with the filename as first parameter.

创建一个文件，使用第一个参数作为文件名。

Excel::create('Filename');
To manipulate the creation of the file you can use the callback

可以使用回调函数操作创建的文件。

Excel::create('Filename', function($excel) {

// Call writer methods here

});
Changing properties

更改属性

There are a couple of properties we can change inside the closure. Most of them are set to the config values by default. See  app/config/packages/maatwebsite/excel/config.php.

有几个属性可以改变    大多数设置了默认。

Excel::create('Filename', function($excel) {

 // Set the title  设置标题

                 $excel->setTitle('Our new awesome title');

// Chain the setters  设置创作人

                    $excel->setCreator('Maatwebsite')

                              ->setCompany('Maatwebsite');

// Call them separately   设置 介绍说明

                     $excel->setDescription('A demonstration to change the file properties');

});
Go to the reference guide to see a list of available properties.

去参考指南以查看可用属性的列表。

Exporting导出

To download the created file, use->export($ext) or ->download($ext).
下载创建的excel

Export to Excel5 (xls)格式

Excel::create('Filename', function($excel) {

})->export('xls');
// or

->download('xls');
Export to Excel2007 (xlsx)格式

->export('xlsx');
// or

->download('xlsx');
Export to CSV格式

->export('csv');
// or

->download('csv');
You can set the default enclosure and delimiter inside the config

在配置文件里设置 范围 和 定界符

Export to PDF 导出为PDF格式

To export files to pdf, you will have to include"dompdf/dompdf": "~0.6.1","mpdf/mpdf": "~5.7.3"or"tecnick.com/tcpdf": "~6.0.0"in yourcomposer.jsonand change theexport.pdf.driverconfig setting accordingly.

->export('pdf');

如果想要导出格式为PDF，则需要安装扩展

NewExcelFile injections

新的Excel文件 注入

Following the Laravel 5.0 philosophy with its new awesome FormRequest injections, we introduce you NewExcelFile injections.

NewExcelFile class

This NewExcelFile is a wrapper for a new Excel file. Inside thegetFilename()you can declare the wanted filename.

class UserListExport extends \Maatwebsite\Excel\Files\NewExcelFile {

public function getFilename()

        {

           return 'filename';

          }

}
Usage  使用 用途

You can inject these NewExcelFiles inside the __constructor or inside the method (when using Laravel 5.0), in e.g. the controller.

class ExampleController extends Controller {

public function exportUserList(UserListExport $export)

{

// work on the export

return $export->sheet('sheetName', function($sheet)

{

})->export('xls');

}
}
Export Handlers

导出事件处理器

To decouple your Excel-export code completely from the controller, you can use the export handlers.

class ExampleController extends Controller {

public function exportUserList(UserListExport $export)

{

// Handle the export

$export->handleExport();

}
}
ThehandleExport()method will dynamically call a handler class which is your class name appended withHandler

class UserListExportHandler implements \Maatwebsite\Excel\Files\ExportHandler {

public function handle(UserListExport $export)

{

// work on the export

return $export->sheet('sheetName', function($sheet)

{

})->export('xls');

}
}
Store on server   把文件保存到服务器上

To store the created file on the server, use->store($ext, $path = false, $returnInfo = false)or->save().
Normal export to default storage path

By default the file will be stored inside theapp/storage/exportsfolder, which has been defined in theexport.phpconfig file.

Excel::create('Filename', function($excel) {

// Set sheets

})->store('xls');
Normal export to custom storage path   一般导出到自定义的路径

If you want to use a custom storage path (e.g. to separate the files per client), you can set the folder as the second parameter.

->store('xls', storage_path('excel/exports'));
Store and export  保存并导出

->store('xls')->export('xls');
Store and return storage info  保存并显示保存信息

If you want to return storage information, set the third paramter to true or change the config setting insideexport.php.

->store('xls', false, true);
KeyExplanation

fullFull path with filename

pathPath without filename

fileFilename

titleFile title

extFile extension

Make sure your storage folder iswritable!

Sheets  工作表

Creating a sheet   创建一个工作表

To create a new sheet inside our newly created file, use->sheet('Sheetname').

Excel::create('Filename', function($excel) {

$excel->sheet('Sheetname', function($sheet) {

// Sheet manipulation

});

})->export('xls');
Creating multiple sheets   创建多个工作表

You can set as many sheets as you like inside the file:

Excel::create('Filename', function($excel) {

// Our first sheet

$excel->sheet('First sheet', function($sheet) {

});

// Our second sheet

$excel->sheet('Second sheet', function($sheet) {

});

})->export('xls');
Changing properties   修改属性

There are a couple of properties we can change inside the closure. Most of them are set to the config values by default. Seeapp/config/packages/maatwebsite/excel/config.php.

Excel::create('Filename', function($excel) {

$excel->sheet('Sheetname', function($sheet) {

$sheet->setOrientation('landscape');

});

})->export('xls');
Go to the reference guide to see a list of available properties.

Default page margin    页边距  页边空白

It's possible to set the default page margin inside the config fileexcel::export.sheets. It accepts boolean, single value or array.

To manually set the page margin you can use:->setPageMargin()
// Set top, right, bottom, left

$sheet->setPageMargin(array(

0.25, 0.30, 0.25, 0.30

));

// Set all margins

$sheet->setPageMargin(0.25);
Password protecting a sheet   使用密码保护一个工作表

A sheet can be password protected with$sheet->protect():
// Default protect   默认设置

                 $sheet->protect('password');

// Advanced protect       更高级的设置

$sheet->protect('password', function(\PHPExcel_Worksheet_Protection $protection) {

              $protection->setSort(true);

});
Creating a sheet from an array      用一个数组创建一个工作表

Array

To create a new file from an array use->fromArray($source, $nullValue, $startCell, $strictNullComparison, $headingGeneration)inside the sheet closure.
Excel::create('Filename', function($excel) {  

          $excel->sheet('Sheetname', function($sheet) {

                        $sheet->fromArray(array(   使用fromArray()

                                      array('data1', 'data2'),

                                      array('data3', 'data4')

                        ));

           });

})->export('xls');
Alternatively you can use->with().  或者使用 with()

$sheet->with(array(

                array('data1', 'data2'),

                array('data3', 'data4')

));
If you want to pass variables inside the closure, useuse($data)

$data = array(

             array('data1', 'data2'),

             array('data3', 'data4')

);
Excel::create('Filename', function($excel) use($data) {

                    $excel->sheet('Sheetname', function($sheet) use($data) {

                    $sheet->fromArray($data);

         });

})->export('xls');
Null comparision

By default 0 is shown as an empty cell. If you want to change this behaviour, you can pass true as 4th parameter:

// Will show 0 as 0

$sheet->fromArray($data, null, 'A1', true);

To change the default behaviour, you can useexcel::export.sheets.strictNullComparisonconfig setting.

Eloquent model

It's also possible to pass an Eloquent model and export it by using->fromModel($model). The method accepts the same parameters as fromArray

Auto heading generation

By default the export will use the keys of your array (or model attribute names) as first row (header column). To change this behaviour you can edit the default config setting (excel::export.generate_heading_by_indices) or passfalseas 5th parameter:

// Won't auto generate heading columns

$sheet->fromArray($data, null, 'A1', false, false);

Row manipulation   一行发操作

Manipulate certain row   操作某一行

Change cell values

// Manipulate first row           设置第一行

$sheet->row(1, array(

'test1', 'test2'

));
// Manipulate 2nd row            设置第二行

$sheet->row(2, array(

'test3', 'test4'

));
Manipulate row cells      操作行单元格

// Set black background         设置黑色背景

$sheet->row(1, function($row) {

               // call cell manipulation methods

               $row->setBackground('#000000');

});
Append row  附加行

// Append row after row 2   第二行后添加 附加行

$sheet->appendRow(2, array(

              'appended', 'appended'

));
// Append row as very last   最后添加附加行

$sheet->appendRow(array(

              'appended', 'appended'

));
Prepend row   前置行

// Add before first row

$sheet->prependRow(1, array(

               'prepended', 'prepended'

));
// Add as very first

$sheet->prependRow(array(

                   'prepended', 'prepended'

));
Append multiple rows    附加多行

// Append multiple rows

$sheet->rows(array(

              array('test1', 'test2'),

              array('test3', 'test4')

));
// Append multiple rows

$sheet->rows(array(

                array('test5', 'test6'),

                array('test7', 'test8')

));
Cell manipulation  单元格操作

$sheet->cell('A1', function($cell) {

// manipulate the cell

});
$sheet->cells('A1:A5', function($cells) {

// manipulate the range of cells

});

Set background

To change the background of a range of cells we can use->setBackground($color, $type, $colorType)

// Set black background

$cells->setBackground('#000000');

Change fonts

// Set with font color

$cells->setFontColor('#ffffff');

// Set font family

$cells->setFontFamily('Calibri');

// Set font size

$cells->setFontSize(16);

// Set font weight to bold

$cells->setFontWeight('bold');

// Set font

$cells->setFont(array(

'family'    => 'Calibri',

'size'      => '16',

'bold'      =>  true

));

Set borders

// Set all borders (top, right, bottom, left)

$cells->setBorder('solid', 'none', 'none', 'solid');

// Set borders with array

$cells->setBorder(array(

'borders' => array(

'top'  => array(

'style' => 'solid'

),

)

));

Set horizontal alignment    设置水平对齐方式

// Set alignment to center

$cells->setAlignment('center');
Set vertical alignment    设置垂直对其方式

// Set vertical alignment to middle

$cells->setValignment('middle');
Sheet styling   工作表样式

General styling

If you want to change the general styling of your sheet (not cell or range specific), you can use the->setStyle()method.

// Set font with ->setStyle()`

$sheet->setStyle(array(

             'font' => array(

                           'name'      =>  'Calibri',

                            'size'      =>  15,

                            'bold'      =>  true

               )

));
Fonts

To change the font for the current sheet use->setFont($array):

$sheet->setFont(array(

'family'    => 'Calibri',

'size'      => '15',

'bold'      => true

));

Separate setters

// Font family

$sheet->setFontFamily('Comic Sans MS');

// Font size

$sheet->setFontSize(15);

// Font bold

$sheet->setFontBold(true);

Borders

You can set borders for the sheet, by using:

// Sets all borders

$sheet->setAllBorders('thin');

// Set border for cells

$sheet->setBorder('A1', 'thin');

// Set border for range

$sheet->setBorder('A1:F10', 'thin');

Go to the reference guide to see a list of available border styles

Freeze rows

If you want to freeze a cell, row or column, use:

// Freeze first row

$sheet->freezeFirstRow();

// Freeze the first column

$sheet->freezeFirstColumn();

// Freeze the first row and column

$sheet->freezeFirstRowAndColumn();

// Set freeze

$sheet->setFreeze('A2');

Auto filter

To enable the auto filter use->setAutoFilter($range = false).

// Auto filter for entire sheet

$sheet->setAutoFilter();

// Set auto filter for a range

$sheet->setAutoFilter('A1:E10');

Cell size

Set column width

To set the column width use->setWidth($cell, $width).

// Set width for a single column

$sheet->setWidth('A', 5);

// Set width for multiple cells

$sheet->setWidth(array(

'A'    =>  5,

'B'    =>  10

));

Set row height

To set the row height use->setHeight($row, $height).

// Set height for a single row

$sheet->setHeight(1, 50);

// Set height for multiple rows

$sheet->setHeight(array(

1    =>  50,

2    =>  25

));

Set cell size

To set the cell size use->setSize($cell, $width, $height).

// Set size for a single cell

$sheet->setSize('A1', 500, 50);

$sheet->setSize(array(

'A1' => array(

'width'    => 50

'height'    => 500,

)

));

Auto size

By default the exported file be automatically auto sized. To change this behaviour you can either change the config or use the setters:

// Set auto size for sheet

$sheet->setAutoSize(true);

// Disable auto size for sheet

$sheet->setAutoSize(false);

// Disable auto size for columns

$sheet->setAutoSize(array(

'A', 'C'

));

The default config setting can be found in:export.php.

Column merging

Merging cells

To merge a range of cells, use->mergeCells($range).

$sheet->mergeCells('A1:E1');

Merging columns and rows

To merge columns and rows, use->setMergeColumn($array).

$sheet->setMergeColumn(array(

'columns' => array('A','B','C','D'),

'rows' => array(

array(2,3),

array(5,11),

)

));

Column formatting

To tell Excel how it should interpret certain columns, you can use->setColumnFormat($array).

// Format column as percentage

$sheet->setColumnFormat(array(

'C' => '0%'

));

// Format a range with e.g. leading zeros

$sheet->setColumnFormat(array(

'A2:K2' => '0000'

));

// Set multiple column formats

$sheet->setColumnFormat(array(

'B' => '0',

'D' => '0.00',

'F' => '@',

'F' => 'yyyy-mm-dd',

));

Go to the reference guide to see a list of available formats.

Calling PHPExcel's native methods

It's possible to call all native PHPExcel methods on the$exceland$sheetobjects.

Calling Workbook methods

Example:

// Get default style for this workbook

$excel->getDefaultStyle();

Calling worksheet methods

Example:

// Protect cells

$sheet->protectCells('A1', $password);

Head over to PHPOffice to learn more about the native methods.

## 2017.4.27
### 消息队列的基本概念理解

* 队列的操作有入队和出队

> 也就是你有一个程序在产生内容然后入队（生产者） 另一个程序读取内容，内容出队（消费者）

> 当你不需要立即获得结果，但是并发量又不能无限大的时候，差不多就是你需要使用消息队列的时候。

>比如你写日志，因为可能一个客户端有多个操作去写，又有很多个客户端，显然并发不能无穷大，于是你就需要把写日志的请求放入到消息队列里，在消费者那边依次把队列中产生的日志写到数据库里。

* 队列是一种数据结构

> 内部是用数组或链表实现的，队列的特点是只能队头放入，队尾取出，即先入先出，具体应用看下生产者消费者

* 通俗的说，就是一个容器

> 你把消息丢进去，不需要立即处理。然后有个程序去从你的容器里面把消息一条条读出来处理。 消息队列，可以是activeMQ，kafka之类的，也可以是数据库的一张任务表。

* 个人觉得消息队列，主要有两个作用：

>1.降低耦合

>2.消息可以暂时存在在消息队列中，等待消息接收者根据自身的负载处理能力控制处理消息的处理速度，减小在大并发访问时候的压力。

## 2017.5.3
### 消息队列的基本概念理解（2）

* 消息队列产生的背景

在不同进程之间传递消息的时候，两个进程之间耦合度过高，改动一个进程，引发必须修改另一个进程，为了隔离这两个进程，在两个进程之间抽离出一层（一个模块），所有两进程之间传递的消息，都必须通过消息队列来传递，单独修改某一个进程，不会影响另一个，而且为了实现标准化，将消息的格式规范化了，并且，某一个进程接受的消息太多，一下子无法处理完，并且也有先后顺序，必须对收到的消息进行排队，因此诞生了事实上的消息队列

* 消息队列主要能够解决的问题

1. 系统解耦：项目开始时，无法确定最终需求，不同的进程间，添加一层，实现解耦，方便今后的扩展
2. 消息缓存：系统中，不同进程处理消息速度不同，MQ，可以实现不同Process之间的缓冲，即，写入MQ的速度可以尽可能地快，而处理消息的速度可以适当调整（或快、或慢）

* 场景案例

下面针对系统解耦、消息缓存两点，来分析实际应用消息队列过程中，可能遇到的问题。虚拟场景：Process\_A通过消息队列MQ\_1向Process\_B传递消息，几个问题：

>针对MQ\_1中一条消息message\_1，如何确保Process\_B从MQ\_1中只取一次message\_1，不会重复多次取出message\_1？

>如果MQ\_1中message\_1已经被Process\_B取出，正在处理的关键时刻，Process\_B崩溃了，哭啊，我的问题是，如果重启Process\_B，是否会丢失message\_1？

回答： 

> * 提升了系统的可靠性: 冗余：Process\_B崩溃之后，数据并不会丢失，因为MQ多采用put-get-delete模式，即，仅当确认message被完成处理之后，才从MQ中移除message；

> * 可恢复：MQ实现解耦，部分进程崩溃，不会拖累整个系统瘫痪，例，Process\_B崩溃之后，Process\_A仍可向MQ中添加message，并等待Process\_B恢复；

> * 可伸缩：有较强的峰值处理能力，通常应用会有突发的访问流量上升情况，使用足够的硬件资源时刻待命，空闲时刻较长，资源浪费，而消息队列却能够平滑峰值流量，缓解系统组件的峰值压力；

> * 提升系统可扩展性：调整模块：由于实现解耦，可以很容易调整，消息入队速率、消息处理速率、增加新的Process；

> * 单次送达：保证MQ中一个message被处理一次，并且只被处理一次。本质：get获取一个message后，这一message即被预定，同一进程不会再次获取这一message；当且仅当进程处理完这一message后，MQ中会delete这个message。否则，过一段时间后，这一message自动解除被预订状态，进程能够重新预定这个message；

> * 排序保证：即，满足队列的FIFO，先入先出策略；

> * 异步通信：很多场景下，不会立即处理消息，这是，可以在MQ中存储message，并在某一时刻再进行处理；

> * 数据流的阶段性能定位：获取用户某一操作的各个阶段（通过message来标识），捕获不同阶段的耗时，可用于定位系统瓶颈。 

## 2017.5.7
### laravel的PUT和DELETE请求处理

* 当使用PUT或者DELETE请求的时候，浏览器表单的请求应该把form-data改成x-www-form-urlencoded

## 2017.5.9
### PHP和redis实现消息队列

###### 使用消息队列的一些场景：

* 把瞬间服务器的请求处理换成异步处理，缓解服务器的压力

* 实现数据顺序排列获取

###### redis实现消息队列步骤如下：

* redis函数rpush,lpop

* 建议定时任务入队列

* 创建定时任务出队列

###### 把数据插入到队列中

```php
<?php
 /**
  * white.php
  */

 
$redis = new Redis();
 
$redis->connect('127.0.0.1',6379);
 
$password = '123456';
 
$redis->auth($password);
 
$arr = array('h','e','l','l','o','w','o','r','l','d');
 
foreach($arr as $k=>$v){
 
  $redis->rpush("mylist",$v);
 
}
```

###### 定时扫描出队列

```php
<?php
/**
 * read.php
 */

$redis = new Redis();
 
$redis->connect('127.0.0.1',6379);
 
$password = '123456';
 
$redis->auth($password);
 
//list类型出队操作
 
$value = $redis->lpop('mylist');
 
if($value){
 
 echo "出队的值".$value;
 
}else{
 
  echo "出队完成";
 
}
 
```

###### 运行

* 建立定时任务

 \$ php white.php

 \$ php read.php

* 定时任务执行队列写入结果如下

```ssh
127.0.0.1:6379> lrange mylist 0 -1
 
 1) "h"
 
 2) "e"
 
 3) "l"
 
 4) "l"
 
 5) "o"
 
 6) "w"
 
 7) "o"
 
 8) "r"
 
 9) "l"
 
10) "d"
```
　　

* 定时任务执行出队列后：

```ssh
127.0.0.1:6379> lrange mylist 0 -1

1) "e"

2) "l"

3) "l"

4) "o"

5) "w"

6) "o"

7) "r"

8) "l"

9) "d"
```

## 2017.5.11
### go并发小结

1 概念
1.1 goroutine是Go并行设计的核心，goroutine的本质是轻量级线程
1.2 golang的runtime实现了对轻量级线程即goroutine的智能调度管理
1.3 P、M、G原理
1.3.1 runtime有P、M、G三个概念，P对应操作系统进程--对程序的抽象， W对应操作系统线程--对寄存器的抽象，G对应goroutine--go实现的轻量级线程， 也即GreenThreads用户态线程 P、M由内核负责调度，G由runtime负责调度，也能实现被多个处理器调用 P用M执行G，并且runtime内部维护了一个G的队列deque存放当前可执行的G， 当G执行结束，M空闲下来，P从deque中取出下一个G继续在M中执行
1.3.2 当G执行了带阻塞的系统调用时，M会被阻塞进而被系统挂起， P会将G留在M继续执行，并从deque取出新的G、新启动一个M来执行G 当G-M重新变成就绪状态之后，P又会在合适的状态继续执行G-M
1.3.3 当P对象的G全部执行完之后，可以从别的P对象的deque中拿一半的G放到自己的deque执行
1.3.4 进一步优化
1.3.4.1 如果G阻塞，P会创建新的M装载G执行
1.3.4.2 这在分布式、高并发的网络RPC/Web场景下非常浪费系统资源导致效率低下
1.3.4.3 Go的优势就在于，在可能导致阻塞的系统调用上， 尽管Go提供的系统调用接口为阻塞方式调用，但是内部实现是非阻塞， 当goroutine进行系统调用阻塞之后，当前的G被设置为阻塞，但是M并不会被阻塞， 仍然可以继续取其他的G继续执行，这样就不会创建新的M，增加系统开销
1.3.4.4 goroutine被设置为阻塞之后什么时候再次被设置为就绪状态，Go抽象了netpoller对象对IO进行多路复用， 在linux上使用epoll实现，当G阻塞时，netpoller将阻塞的文件描述符注册到epoll示例进行epoll_wait， 文件描述符就绪之后通知给阻塞的G，G就绪之后就可以继续执行了 这种方式避免了传统的多进程、多线程堆积方式， golang使每一个线程尽可能的忙碌起来进行计算，而不是阻塞在IO调用上， 这在高并发的网络通信场景下非常有效
1.3.5 参考资料
1.3.5.1 http://m.yl1001.com/group_article/3231471449287668.htm
1.3.5.2 http://tieba.baidu.com/p/3542454435?share=9105&fr=share
1.3.5.3 http://m.blog.csdn.net/article/details?id=50283557
1.3.5.4 http://www.tuicool.com/m/articles/Qr6BRz
1.3.5.5 内存上限问题
2 goroutine使用
2.1 goroutine通过go关键字实现，其实就是一个普通的函数，如：go hello(a, b, c)
2.2 与线程思路一样，main相当于主线程，即主goroutine，如果不设置，主goroutine不会主动等待所有goroutine结束之后结束main
2.3 GOMAXPROCS设置问题
2.3.1 默认情况下，调度器仅使用单线程，也就是说只实现了并发
2.3.2 想要发挥多核处理器的并行，需要在我们的程序中显式调用 runtime.GOMAXPROCS(n)
2.3.3 参考
2.3.3.1 http://bbs.csdn.net/topics/390618790?page=1
2.3.3.2 https://zhidao.baidu.com/question/1509937302744176180.html
2.3.3.3 https://www.zhihu.com/question/22503180
2.3.3.4 http://www.hankcs.com/program/cpp/multi-core_cpu_to_open_several_threads_best.html
2.3.3.5 http://www.jb51.net/article/61605.htm
2.4 runtime.Gosched()表示让CPU把时间片让给别人,下次某个时候继续恢复执行该goroutine
3 channel使用
3.1 Go提供了一个很好的机制channel供goroutine之间相互通信
3.2 channel可以与Unix shell 中的双向管道做类比：可以通过它发送或者接收值，也可以直接认为就是线程队列
3.3 需要注意： 定义一个channel时，也需要定义发送到channel的值的类型 而且必须使用make创建初始化channel
3.4 channel通过操作符<-来接收和发送数据，操作符在ch左侧表示接收数据即出队，操作符在右侧表示发送数据即入队
3.5 Unbuffered Channel
3.5.1 默认情况下，channel是不带缓存的 也就是说，channel接收和发送数据都是阻塞的，除非另一端已经准备好 所以如果使用默认的channel，则必须有多个goroutine存在， 单个goroutine不可能既准备好了发送数据也同时准备好了接收数据 所以说： 无缓冲channel是在多个goroutine之间同步很棒的工具，这也是无缓冲channel的主要用途
3.5.2 错误示例
3.5.2.1
3.5.3 错误结果
3.5.3.1
3.5.4 常见问题参考
3.5.4.1 http://stackoverflow.com/questions/36505012/go-fatal-error-all-goroutines-are-asleep-deadlock
3.5.4.2 http://stackoverflow.com/questions/26927479/go-language-fatal-error-all-goroutines-are-asleep-deadlock
3.5.4.3 http://studygolang.com/articles/2410
3.5.4.4 http://tieba.baidu.com/p/2685997128
3.5.4.5 http://studygolang.com/articles/814
3.5.4.6 http://www.oschina.net/question/2304895_230270
3.5.5 sync.WaitGroup实现routine同步
3.5.5.1 sync.WaitGroup也可以用于控制main routine等待所有子routine完成
3.5.5.2 http://stackoverflow.com/questions/26927479/go-language-fatal-error-all-goroutines-are-asleep-deadlock
3.5.6 select监控多个channel，主动发送QUIT信号
3.5.6.1 https://github.com/astaxie/build-web-application-with-golang/blob/master/zh/02.7.md#goroutine
3.5.6.2 可以监控多个channel
3.5.6.3 可以监控没有可读可写的消息
3.5.6.4 可以设置超时控制
3.6 Buffered Channel
3.6.1 长度为1的channel不是默认的非缓存channel，非缓存channel长度相当于0，所以是阻塞的！
3.6.2 语法： ch := make(chan type, value)
3.6.3 channel遍历
3.6.3.1 for i := range c // until channel c closed
3.6.3.2 前提是c必须要在生产者中正确关闭，否则main routine出现异常，没有数据继续写入或者读出
3.6.3.3 for i := range c能够不断的读取channel里面的数据，直到该channel被显式的关闭
3.6.3.4 测试是否关闭
3.6.3.4.1 v, ok := <-cha // ok == false is close and no data
3.6.3.5 应该在生产者的地方关闭channel，而不是消费的地方去关闭它，这样容易引起panic
3.6.3.6 channel不像文件之类的，不需要经常去关闭，只有当你确实没有任何发送数据了， 或者你想显式的结束range循环之类的
4 runtime
4.1 Goexit
4.1.1 退出当前执行的goroutine，但是defer函数还会继续调用
4.2 Gosched
4.2.1 让出当前goroutine的执行权限，调度器安排其他等待的任务运行，并在下次某个时候从该位置恢复执行
4.3 NumCPU
4.3.1 返回 CPU 核数量，此处是逻辑核，包括超线程
4.4 NumGoroutine
4.4.1 返回正在执行和排队的任务总数
4.5 GOMAXPROCS
4.5.1 用来设置可以并行计算的CPU核数的最大值，并返回之前的值

## 2017.5.23
### react.js  angular.js   vue.js  比较


作者：徐飞
链接：https://www.zhihu.com/question/39943474/answer/83905933
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

Angular，React，Vue，这三者其实面对的是同一个领域，那就是Web应用，什么是Web应用呢，我之前有一篇大致讲了：构建单页Web应用 · Issue #5 · xufei/blog · GitHub这三者中，Angular的适用领域相对窄一些，React可以拓展到服务端，移动端Native部分，而Vue因为比较轻量，还能用于业务场景非常轻的页面中。在Web应用中，我们需要解决的问题可以归纳为三类：- 状态- 组织- 效率1. 状态什么是状态？在一个业务界面中，我们可能会根据某些数据去生成一块界面，然后通过界面上的某些操作，改变一些数据，从而影响界面的另外一些部分。这里面就存在两种关系，一种是从数据到界面，一种是从界面到数据。能够描述界面当前状况的数据，就可以被称为状态。如果不对状态作抽象，很可能会导致逻辑的混乱，比如说，一个地方点了，要改多个地方，这种代码直接写，很容易写乱的，所以，不同的框架采用不同的方式进行了处理。比如说MVVM流的Angular和Vue，还有Avalon，Regular，Knockout，都是走的这一流派，通过类似模板的语法，描述界面状态与数据的绑定关系，然后通过内部转换，把这个结构建立起来，当界面发生变化的时候，按照配置规则去更新相应的数据，然后，再根据配置好的规则去，从数据更新界面状态。React走的是另外一个流派，就是所谓的函数式，在这个里面，推崇的是单向数据流：给定原始界面（或数据），施加一个变化，就能推导出另外一个状态（界面或者数据的更新）。在这里需要额外提一下ReactiveJS，它的理念又有所不同，是基于Reactive的。2. 组织刚才这些，都可以看作是满足最基本的需求，那就是业务的正确性。在这之后，就有另外的诉求了，首当其冲的就是整个业务代码的组织。所谓组织，指的是两个方面，一方面是模块关系，另一方面是业务模型。我们是怎样解决模块关系的呢？共识就是组件化。整个应用形成倒置的组件树，每个组件提供对外接口，然后内部只关注自己的实现。这些东西说起来简单，但实际做的时候还是有非常多需要考虑的东西，包括组件的定义，约束，管理，测试等等，而在Web这个体系中，组件化也有一些不太适合的场景，需要做一些权衡，这方面详细说就比较复杂了，需要好多篇幅才能说清楚，可以看看我这篇：Web应用组件化的权衡 · Issue #22 · xufei/blog · GitHub那么，业务模型又是指什么呢？我们提到React的时候，就会听到Flux，Redux之类的东西，为什么又要有它们呢？我们必须认识到，脱离了这类东西，纯上层的组件化是不牢固的，如果你感受不到，只有一个原因：你的项目的业务层太薄。业务模型指的是所处领域中的业务数据、规则、流程的集合。即使抛开所有展示层，这一层也是应当要能够运作起来的。那么，这跟Redux之类又有什么关系呢？我们刚才提到组件化，整个应用形成了一个组件树，组件之间可能会需要通讯，它们通讯的内容可能是简单的界面事件，也可能是业务含义较深，能够牵一发而动全身的。界面是怎么来的？是由初始界面加上状态形成的，为了能够反映界面的变化，我们必须使得对业务模型的每一个扰动都收敛到确切的状态，所以，这也就是Redux这类东西的意义所在。所以，没有Redux之类辅助方案的React，是不完整的。而Redux本身，也不是局限到只能作为React辅助方案的，它的理念，对于Angular，Vue，照样是非常重要的补充。在同一业务场景下，对于每个框架来说，数据模型层面临的问题都是一样的，在这一层并没有任何分别。另外，Angular 2中引入了RxJS，这个东西处理这方面也是有很大优势的。在这里我要插一句自己的想法，很多学习能力较强的朋友，当他发现FP，FRP之类编程模型的时候，会非常喜欢，但对于大型项目，需要很多人协作的状况来说，不一定是好事。用面向过程，面向对象的那些方式，虽然笨重，但好处是门槛低，符合大多数人的理解和思维方式，并且可以复用几十年积累的各种设计模式和经验。所以，如果不是小而精悍的团队，我对引入FP和FRP都是比较保守的。在这些东西下层，还有Relay，GraphQL等等致力于业务模型同步的方案，但这个引入代价同样是非常大。再插另外一句：很多人吐槽Angular大而全笨重，吐槽React全家桶，但其实世界上大部分人是没有框架整合能力的，小而美的库最后整合了，在面临各种业务需求之后不断引入新模块，也还是一个大而全的方案。在绝大部分场景下，还是有一整套标配模块比较好。你看ExtJS他也单独提供ExtCore模块，但不但竞争不过jQuery，连mootools和prototype都竞争不过，用它的人几乎都是用全方案的。3. 效率效率也分两种，一种是开发效率，一种是运行效率。我们前面提到，组件化，这是提升开发效率的一种手段，在组件化这个点上，各路框架的组织方式大同小异，反正最终都是组件树。具体到单个组件的实现上，我个人是倾向于MVVM流的，之前 @题叶  做过对比，MVVM系的代码量会少一些，开发效率稍高一点。其中，Angular因为实现的特殊性，有作用域继承之类的双刃剑黑魔法，开发效率的不稳定因素要高不少，深刻理解的人用起来效率很高，不理解的用了到处是坑。再看运行效率，这里面，Angular是较低的那个，主要在于数据变更检测方式，但这也不是绝对的，在部分场景下，脏检测未必就没有优势，这个记得 @郑海波论述过。运行效率的另外一面主要是创建和修改DOM，在创建上，大家是没有太大差异的，而在修改DOM的时候，React首创的虚拟DOM有很大优势，所以其他框架内部实现也在逐渐借鉴。


## 2017.6.1
### docker-compose

Compose是用于定义和运行复杂Docker应用的工具。你可以在一个文件中定义一个多容器的应用，然后使用一条命令来启动你的应用，然后所有相关的操作都会被自动完成。

1. 安装Docker和Compose

```ssh
 # 当前最新的Docker是1.6.2，Compose为1.2.0
curl -s https://get.docker.io/ubuntu/ | sudo sh
sudo apt-get update
sudo apt-get install lxc-docker
 # 参考http://docs.docker.com/compose/install/#install-compose
curl -L https://github.com/docker/compose/releases/download/1.2.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose上面这个方法真的慢出翔，可以通过Python pip安装。
apt-get install python-pip python-dev
pip install -U docker-compose
```
这样compose就安装好了，查看一下compose的版本信息：

```ssh
chmod +x /usr/local/bin/docker-compose
docker-compose -version
docker-compose 1.2.0
```

2. 使用Compose

编写docker-compose.yaml来定义你的应用，他们可以在下个互隔离的容器中组成你的应用

在上面的yaml文件中，我们可以看到compose文件的基本结构。首先是定义一个服务名，下面是yaml服务中的一些选项条目：

```ssh
	image :镜像的ID
	build :直接从pwd的Dockerfile来build，而非通过image选项来pull
	links ：连接到那些容器。每个占一行，格式为SERVICE[:ALIAS],例如 – db[:database]
	external_links ：连接到该compose.yaml文件之外的容器中，比如是提供共享或者通用服务的容器服务。格式同links
	command ：替换默认的command命令
	ports : 导出端口。格式可以是：
	ports:-"3000"-"8000:8000"-"127.0.0.1:8001:8001"
	expose ：导出端口，但不映射到宿主机的端口上。它仅对links的容器开放。格式直接指定端口号即可。
	volumes ：加载路径作为卷，可以指定只读模式：
	volumes:-/var/lib/mysql
	 - cache/:/tmp/cache
	 -~/configs:/etc/configs/:ro
	volumes_from ：加载其他容器或者服务的所有卷
	environment:- RACK_ENV=development
	  - SESSION_SECRET
	env_file ：从一个文件中导入环境变量，文件的格式为RACK_ENV=development
	extends :扩展另一个服务，可以覆盖其中的一些选项。一个sample如下：
	common.yml
	webapp:
	  build:./webapp
	  environment:- DEBUG=false- SEND_EMAILS=false
	development.yml
	web:extends:
	    file: common.yml
	    service: webapp
	  ports:-"8000:8000"
	  links:- db
	  environment:- DEBUG=true
	db:
	  image: postgres
	net ：容器的网络模式，可以为”bridge”, “none”, “container:[name or id]”, “host”中的一个。
	dns ：可以设置一个或多个自定义的DNS地址。
	dns_search :可以设置一个或多个DNS的扫描域。
	其他的 working_dir, entrypoint, user, hostname, domainname, mem_limit, privileged, restart, stdin_open, tty, cpu_shares ，和 docker run 命令是一样的，这些命令都是单行的命令。例如：
	cpu_shares:73
	working_dir:/code
	entrypoint: /code/entrypoint.sh
	user: postgresql
	hostname: foo
	domainname: foo.com
	mem_limit:1000000000
	privileged:true
	restart: always
	stdin_open:true
	tty:true
```

## 2017.6.7

### 倒排索引

* 倒排索引

```ssh
    倒排索引是一种数据结构，用来存储在全文搜索下某个单词在一个文档或者一组文档中的存储位置的映射。它是文档检索系统中最常用的数据结构。

    倒排索引(Inverted Index)：倒排索引是实现“单词-文档矩阵”的一种具体存储形式，通过倒排索引，可以根据单词快速获取包含这个单词的文档列表。

    传统的索引是：索引ID->文档内容，而倒排索引是：文档内容（分词）->索引ID。可以类比正向代理和反向代理的区别来理解。正向代理把内部请求代理到外部，反向代理把外部请求代理到内部。所以应该理解为转置索引比较合适。

    倒排索引主要由两个部分组成：“单词词典”和“倒排文件”。

    单词词典是倒排索引中非常重要的组成部分，它用来维护文档集合中出现过的所有单词的相关信息，同时用来记载某个单词对应的倒排列表在倒排文件中的位置信息。在支持搜索时，根据用户的查询词，去单词词典里查询，就能够获得相应的倒排列表，并以此作为后续排序的基础。

    对于一个规模很大的文档集合来说，可能包含几十万甚至上百万的不同单词，能否快速定位某个单词直接影响搜索时的响应速度，所以需要高效的数据结构来对单词词典进行构建和查找，常用的数据结构包括哈希加链表结构和树形词典结构。
```

* 倒排索引基础知识

```ssh
    文档(Document)：一般搜索引擎的处理对象是互联网网页，而文档这个概念要更宽泛些，代表以文本形式存在的存储对象，相比网页来说，涵盖更多种形式，比如Word，PDF，html，XML等不同格式的文件都可以称之为文档。再比如一封邮件，一条短信，一条微博也可以称之为文档。在本书后续内容，很多情况下会使用文档来表征文本信息。
    文档集合(Document Collection)：由若干文档构成的集合称之为文档集合。比如海量的互联网网页或者说大量的电子邮件都是文档集合的具体例子。
    文档编号(Document ID)：在搜索引擎内部，会将文档集合内每个文档赋予一个唯一的内部编号，以此编号来作为这个文档的唯一标识，这样方便内部处理，每个文档的内部编号即称之为“文档编号”，后文有时会用DocID来便捷地代表文档编号。
    单词编号(Word ID)：与文档编号类似，搜索引擎内部以唯一的编号来表征某个单词，单词编号可以作为某个单词的唯一表征。
    Indexer程序就是根据配置好地分词算法，将获取到的记录进行分词，然后用倒排索引做数据结构保存起来。
```

## 2017.6.15

### mysql 全文索引

1.基础知识

```sh
    1.MySQL全文索引的几个注意事项
    2.全文索引的语法
    3.几种搜索类型的简介
    4.几种搜索类型的实例
```

## 2017.8.15

### 在做技术选型的时候应该选择vue还是angular还是react

```sh
angular 是通过directive实现复杂的dom修改，但是作为一个MVVM框架显得过重，不适用那些对性能要求比较高的站点，地东端的web站，其UI组件的封装相对复杂，不利于重用

react 本身不是完整的MVC，MVVM框架，只负责view层，在很多web前端的场景下不适用于MVC的开发模式，而且react也可以非常完整的实现web component react是的数据单项绑定，是的react数据响应非常快
```

## 2017.9.12

### go语言的defer

```sh

#示例代码一：
func funcA() int {
    x := 5
    defer func() {
        x += 1
    }()
    return x
}
#示例代码二：
func funcB() (x int) {
    defer func() {
        x += 1
    }()
    return 5
}
<!--more-->
#示例代码三：
func funcC() (y int) {
    x := 5
    defer func() {
        x += 1
    }()
    return x
}
 
#示例代码四：
func funcD() (x int) {
    defer func(x int) {
        x += 1
    }(x)
    return 5
}

解析这几段代码，主要需要理解清楚以下几点知识：
1、return语句的处理过程
return xxx 语句并不是一条原子指令，其在执行的时候会进行语句分解成 返回变量=xxx return，最后执行return
2、defer语句执行时机
上文说过，defer语句是在函数关闭的时候调用，确切的说是在执行return语句的时候调用，注意，是return 不是return xxx
3、函数参数的传递方式
Go语言中普通的函数参数的传递方式是值传递，即新辟内存拷贝变量值，不包括slice和map，这两种类型是引用传递
4、变量赋值的传递方式
Go语言变量的赋值跟函数参数类似，也是值拷贝，不包括slice和map，这两种类型是内存引用

按照以上原则，解析代码：

#示例代码一：
func funcA() int {
    x := 5
    temp=x      #temp变量表示未显示声明的return变量
    func() {
        x += 1
    }()
    return
}
返回temp的值，在将x赋值给temp后，temp未发生改变，最终返回值为5


#示例代码二：
func funcB() (x int) {
    x = 5
    func() {
        x += 1
    }()
    return
}
返回x的值，先对其复制5，接着函数中改变为6，最终返回值为6


#示例代码三：
func funcC() (y int) {
    x := 5
    y = x       #这里是值拷贝
    func() {
        x += 1
    }()
    return
}
返回y的值，在将x赋值给y后，y未发生改变，最终返回值为5


#示例代码四：
func funcD() (x int) {
    x := 5
    func(x int) { #这里是值拷贝
        x += 1
    }(x)
    return
}
返回x的值，传递x到匿名函数中执行的时候，传递的是x的拷贝，其内部修改不影响外部x的值，最终返回值为5

```


## 2017.10.5

### 深入理解JavaScript中的this

this 不是变量，不是属性，不能为其赋值，它始终指向调用它的对象
感觉还TM太虚了，只要记住最重要的一条即可 ”它始终指向调用它的对象“ ，所以找到调用this的对象，就知道this到底指向谁了

1、

?
1
alert(this);
瞅瞅，弹出来的是么子，要么是”object window“ ,要么 "object" 总之就对象了，是那个对象呢？
?
1
alert(this === window);
结果为'true' 所以了，现在调用它的对象是window了
2、

?
1
2
3
4
var test = function(){
  alert(this);
}
test();
猜猜上面弹出什么，是不是和"alert(this)" 这句一样的
?
1
2
3
4
var test = function(){
  alert(this === window);
 }
test();
运行上面的代码，是不是弹出了'true' ?
事情就这样完了？
要这么简单的话，何必那么多人都去论述这个鸟了？
3、

再来

?
1
2
3
4
var test = function(){
  alert(this === window);
 }
new test();
哎哎，这次咋成'false'呢？

记住”this 始终指向调用它的对象“，第”1、“处调用该段代码的直接对象是全局对象，即"window" ；第”2、“处虽然是函数，但是调用其的仍然是”window“(不要弄混了，函数虽然是对象，但是调用它的是另一个对象)；第”3、“处，使用了”new“ 这时其实已经发生变化了，这是一个构造函数，构造函数创建时创建了一个新的空的对象，即”new test()“创建了一个新的对象，然后再由这个对象指向函数"test"中的代码，因此此时this不在是window对象，而是该构造函数创建的新对象。
4、

?
1
2
3
4
5
6
7
var test ={
  'a':1,
  'b':function(){
   alert(this === test)
  }
 }
test.b();
有了上面的论点，这下一下子清楚了吧！
5、

?
1
2
3
4
5
6
7
8
var test ={
  'a':1,
  'b':function(){
   alert(this === test)
  }
 }
var test1 = test;
test1.b();
so, 你不会认为结果为"false"吧，错了，虽然'test1'的值为'test'  但是'test1'不还是'test'对象么，它有新产生对象，你暂且理解为引用的了，两个都指向一个对象，奉上下面一段代码为证

?
1
2
3
4
5
6
7
8
9
var test ={
  'a':1,
  'b':function(){
   alert(this === test)
  }
 }
var test1 = test;
test.a = 2;
alert(test1.a);
如果弹出了”1“，你来骂我
6、再整个复杂的

?
1
2
3
4
5
6
7
8
9
var test ={
  'a':1,
  'b':{
   'b1':function(){
    alert(this === test);
   }
  }
 }
test.b.b1();
这是"true"还是"false"呢？
按照上面的理论，这时"this"不再直接被'test'调用了，而是被'test.b' 调用, 奉上下面一段代码为证

?
1
2
3
4
5
6
7
8
9
var test ={
  'a':1,
  'b':{
   'b1':function(){
    alert(this === test.b);
   }
  }
 }
test.b.b1();
 7、好再整个复杂点的

?
1
2
3
4
5
6
7
var test = function(){
  var innerTest = function(){
   alert(this === test);
  }
  innerTest();
 }
test();
你不会认为弹出"true"吧，不是按照上面的理论'innerTest'是被'test'调用的，然后'this'就指向'test'吗？
额，错就错在是谁调用的'innerTest', 其实这种函数都是'window'对象调用的，及时你嵌套一千层，调用各个函数的都是'window'对象,奉上下面这段代码为证

?
1
2
3
4
5
6
7
8
9
10
11
var test = function(){
  var innerTest = function(){
   alert(this === window);
   var innerTest1 = function(){
    alert(this === window);
   }
   innerTest1();
  }
  innerTest();
 }
test();
8、再来一段特殊的

?
1
2
3
4
5
6
var test = function(){
  alert(this === window);
 }
var test1 = {
}
test.apply(test1);
这个我觉得大家都不会猜错，该函数的作用就是”调用一个对象的一个方法，以另一个对象替换当前对象“ 所以了'window' 对象已经被替代为'test1'，自然为'false'了,奉上如下代码以为证明

?
1
2
3
4
5
6
var test = function(){
  alert(this === test1);
 }
 var test1 = {
  }
test.apply(test1);
 那么诸如'call'之类的也就相似了
9、再来一个原型的继承，区别于字面量的继承

?
1
2
3
4
5
6
7
8
9
10
11
var test = function(){
 }
 var my = function(){
  this.a = function(){
   alert(this === mytest2);
  }
 }
 var mytest = new my();
 test.prototype = mytest;
 var mytest2 = new test();
 mytest2.a();
10、还剩下些什么了，可能就是'dom'对象了

?
1
2
3
4
5
6
7
<script>
  var mytest = function(context){
   alert(context.getAttribute('id'));
   alert(this === window);
  }
 </script>
 <div id="test" onclick="mytest(this)">aaaa</div>


## 2017.10.23

### !!!go语言并发学习笔记，(深入理解)

如果不是我对真正并行的线程的追求，就不会认识到Go有多么的迷人。

Go语言从语言层面上就支持了并发，这与其他语言大不一样，不像以前我们要用Thread库 来新建线程，还要用线程安全的队列库来共享数据。

以下是我入门的学习笔记。

首先，并行!=并发, 两者是不同的，可以参考:http://concur.rspace.googlecode.com/hg/talk/concur.html

Go语言的goroutines、信道和死锁
goroutine
Go语言中有个概念叫做goroutine, 这类似我们熟知的线程，但是更轻。

以下的程序，我们串行地去执行两次loop函数:

func loop() {
    for i := 0; i < 10; i++ {
        fmt.Printf("%d ", i)
    }
}


func main() {
    loop()
    loop()
}
毫无疑问，输出会是这样的:

0 1 2 3 4 5 6 7 8 9 0 1 2 3 4 5 6 7 8 9
下面我们把一个loop放在一个goroutine里跑，我们可以使用关键字go来定义并启动一个goroutine:

func main() {
    go loop() // 启动一个goroutine
    loop()
}
这次的输出变成了:

0 1 2 3 4 5 6 7 8 9
可是为什么只输出了一趟呢？明明我们主线跑了一趟，也开了一个goroutine来跑一趟啊。

原来，在goroutine还没来得及跑loop的时候，主函数已经退出了。

main函数退出地太快了，我们要想办法阻止它过早地退出，一个办法是让main等待一下:

func main() {
    go loop()
    loop()
    time.Sleep(time.Second) // 停顿一秒
}
这次确实输出了两趟，目的达到了。

可是采用等待的办法并不好，如果goroutine在结束的时候，告诉下主线说“Hey, 我要跑完了！”就好了， 即所谓阻塞主线的办法，回忆下我们Python里面等待所有线程执行完毕的写法:

for thread in threads:
    thread.join()
是的，我们也需要一个类似join的东西来阻塞住主线。那就是信道

信道
信道是什么？简单说，是goroutine之间互相通讯的东西。类似我们Unix上的管道（可以在进程间传递消息）， 用来goroutine之间发消息和接收消息。其实，就是在做goroutine之间的内存共享。

使用make来建立一个信道:

var channel chan int = make(chan int)
// 或
channel := make(chan int)
那如何向信道存消息和取消息呢？ 一个例子:

func main() {
    var messages chan string = make(chan string)
    go func(message string) {
        messages <- message // 存消息
    }("Ping!")

    fmt.Println(<-messages) // 取消息
}
默认的，信道的存消息和取消息都是阻塞的 (叫做无缓冲的信道，不过缓冲这个概念稍后了解，先说阻塞的问题)。

也就是说, 无缓冲的信道在取消息和存消息的时候都会挂起当前的goroutine，除非另一端已经准备好。

比如以下的main函数和foo函数:

var ch chan int = make(chan int)

func foo() {
    ch <- 0  // 向ch中加数据，如果没有其他goroutine来取走这个数据，那么挂起foo, 直到main函数把0这个数据拿走
}

func main() {
    go foo()
    <- ch // 从ch取数据，如果ch中还没放数据，那就挂起main线，直到foo函数中放数据为止
}
那既然信道可以阻塞当前的goroutine, 那么回到上一部分「goroutine」所遇到的问题「如何让goroutine告诉主线我执行完毕了」 的问题来, 使用一个信道来告诉主线即可:

var complete chan int = make(chan int)

func loop() {
    for i := 0; i < 10; i++ {
        fmt.Printf("%d ", i)
    }

    complete <- 0 // 执行完毕了，发个消息
}


func main() {
    go loop()
    <- complete // 直到线程跑完, 取到消息. main在此阻塞住
}
如果不用信道来阻塞主线的话，主线就会过早跑完，loop线都没有机会执行、、、

其实，无缓冲的信道永远不会存储数据，只负责数据的流通，为什么这么讲呢？

从无缓冲信道取数据，必须要有数据流进来才可以，否则当前线阻塞

数据流入无缓冲信道, 如果没有其他goroutine来拿走这个数据，那么当前线阻塞

所以，你可以测试下，无论如何，我们测试到的无缓冲信道的大小都是0 (len(channel))

如果信道正有数据在流动，我们还要加入数据，或者信道干涩，我们一直向无数据流入的空信道取数据呢？ 就会引起死锁

死锁
一个死锁的例子:

func main() {
    ch := make(chan int)
    <- ch // 阻塞main goroutine, 信道c被锁
}
执行这个程序你会看到Go报这样的错误:

fatal error: all goroutines are asleep - deadlock!
何谓死锁? 操作系统有讲过的，所有的线程或进程都在等待资源的释放。如上的程序中, 只有一个goroutine, 所以当你向里面加数据或者存数据的话，都会锁死信道， 并且阻塞当前 goroutine, 也就是所有的goroutine(其实就main线一个)都在等待信道的开放(没人拿走数据信道是不会开放的)，也就是死锁咯。

我发现死锁是一个很有意思的话题，这里有几个死锁的例子:

只在单一的goroutine里操作无缓冲信道，一定死锁。比如你只在main函数里操作信道:

func main() {
    ch := make(chan int)
    ch <- 1 // 1流入信道，堵塞当前线, 没人取走数据信道不会打开
    fmt.Println("This line code wont run") //在此行执行之前Go就会报死锁
}
如下也是一个死锁的例子:

var ch1 chan int = make(chan int)
var ch2 chan int = make(chan int)

func say(s string) {
    fmt.Println(s)
    ch1 <- <- ch2 // ch1 等待 ch2流出的数据
}

func main() {
    go say("hello")
    <- ch1  // 堵塞主线
}
其中主线等ch1中的数据流出，ch1等ch2的数据流出，但是ch2等待数据流入，两个goroutine都在等，也就是死锁。

其实，总结来看，为什么会死锁？非缓冲信道上如果发生了流入无流出，或者流出无流入，也就导致了死锁。或者这样理解 Go启动的所有goroutine里的非缓冲信道一定要一个线里存数据，一个线里取数据，要成对才行 。所以下面的示例一定死锁:

c, quit := make(chan int), make(chan int)

go func() {
   c <- 1  // c通道的数据没有被其他goroutine读取走，堵塞当前goroutine
   quit <- 0 // quit始终没有办法写入数据
}()

<- quit // quit 等待数据的写
仔细分析的话，是由于：主线等待quit信道的数据流出，quit等待数据写入，而func被c通道堵塞，所有goroutine都在等，所以死锁。

简单来看的话，一共两个线，func线中流入c通道的数据并没有在main线中流出，肯定死锁。

但是，是否果真 所有不成对向信道存取数据的情况都是死锁?

如下是个反例:

func main() {
    c := make(chan int)

    go func() {
       c <- 1
    }()
}
程序正常退出了，很简单，并不是我们那个总结不起作用了，还是因为一个让人很囧的原因，main又没等待其它goroutine，自己先跑完了， 所以没有数据流入c信道，一共执行了一个goroutine, 并且没有发生阻塞，所以没有死锁错误。

那么死锁的解决办法呢？

最简单的，把没取走的数据取走，没放入的数据放入， 因为无缓冲信道不能承载数据，那么就赶紧拿走！

具体来讲，就死锁例子3中的情况，可以这么避免死锁:

c, quit := make(chan int), make(chan int)

go func() {
    c <- 1
    quit <- 0
}()

<- c // 取走c的数据！
<-quit
另一个解决办法是缓冲信道, 即设置c有一个数据的缓冲大小:

c := make(chan int, 1)
这样的话，c可以缓存一个数据。也就是说，放入一个数据，c并不会挂起当前线, 再放一个才会挂起当前线直到第一个数据被其他goroutine取走, 也就是只阻塞在容量一定的时候，不达容量不阻塞。

这十分类似我们Python中的队列Queue不是吗？

无缓冲信道的数据进出顺序
我们已经知道，无缓冲信道从不存储数据，流入的数据必须要流出才可以。

观察以下的程序:

var ch chan int = make(chan int)

func foo(id int) { //id: 这个routine的标号
    ch <- id
}

func main() {
    // 开启5个routine
    for i := 0; i < 5; i++ {
        go foo(i)
    }

    // 取出信道中的数据
    for i := 0; i < 5; i++ {
        fmt.Print(<- ch)
    }
}
我们开了5个goroutine，然后又依次取数据。其实整个的执行过程细分的话，5个线的数据 依次流过信道ch, main打印之, 而宏观上我们看到的即 无缓冲信道的数据是先到先出，但是 无缓冲信道并不存储数据，只负责数据的流通

缓冲信道
终于到了这个话题了, 其实缓存信道用英文来讲更为达意: buffered channel.

缓冲这个词意思是，缓冲信道不仅可以流通数据，还可以缓存数据。它是有容量的，存入一个数据的话 , 可以先放在信道里，不必阻塞当前线而等待该数据取走。

当缓冲信道达到满的状态的时候，就会表现出阻塞了，因为这时再也不能承载更多的数据了，「你们必须把 数据拿走，才可以流入数据」。

在声明一个信道的时候，我们给make以第二个参数来指明它的容量(默认为0，即无缓冲):

var ch chan int = make(chan int, 2) // 写入2个元素都不会阻塞当前goroutine, 存储个数达到2的时候会阻塞
如下的例子，缓冲信道ch可以无缓冲的流入3个元素:

func main() {
    ch := make(chan int, 3)
    ch <- 1
    ch <- 2
    ch <- 3
}
如果你再试图流入一个数据的话，信道ch会阻塞main线, 报死锁。

也就是说，缓冲信道会在满容量的时候加锁。

其实，缓冲信道是先进先出的，我们可以把缓冲信道看作为一个线程安全的队列：

func main() {
    ch := make(chan int, 3)
    ch <- 1
    ch <- 2
    ch <- 3

    fmt.Println(<-ch) // 1
    fmt.Println(<-ch) // 2
    fmt.Println(<-ch) // 3
}
信道数据读取和信道关闭
你也许发现，上面的代码一个一个地去读取信道简直太费事了，Go语言允许我们使用range来读取信道:

func main() {
    ch := make(chan int, 3)
    ch <- 1
    ch <- 2
    ch <- 3

    for v := range ch {
        fmt.Println(v)
    }
}
如果你执行了上面的代码，会报死锁错误的，原因是range不等到信道关闭是不会结束读取的。也就是如果 缓冲信道干涸了，那么range就会阻塞当前goroutine, 所以死锁咯。

那么，我们试着避免这种情况，比较容易想到的是读到信道为空的时候就结束读取:

ch := make(chan int, 3)
ch <- 1
ch <- 2
ch <- 3
for v := range ch {
    fmt.Println(v)
    if len(ch) <= 0 { // 如果现有数据量为0，跳出循环
        break
    }
}
以上的方法是可以正常输出的，但是注意检查信道大小的方法不能在信道存取都在发生的时候用于取出所有数据，这个例子 是因为我们只在ch中存了数据，现在一个一个往外取，信道大小是递减的。

另一个方式是显式地关闭信道:

ch := make(chan int, 3)
ch <- 1
ch <- 2
ch <- 3

// 显式地关闭信道
close(ch)

for v := range ch {
    fmt.Println(v)
}
被关闭的信道会禁止数据流入, 是只读的。我们仍然可以从关闭的信道中取出数据，但是不能再写入数据了。

等待多gorountine的方案
那好，我们回到最初的一个问题，使用信道堵塞主线，等待开出去的所有goroutine跑完。

这是一个模型，开出很多小goroutine, 它们各自跑各自的，最后跑完了向主线报告。

我们讨论如下2个版本的方案:

只使用单个无缓冲信道阻塞主线

使用容量为goroutines数量的缓冲信道

对于方案1, 示例的代码大概会是这个样子:

var quit chan int // 只开一个信道

func foo(id int) {
    fmt.Println(id)
    quit <- 0 // ok, finished
}

func main() {
    count := 1000
    quit = make(chan int) // 无缓冲

    for i := 0; i < count; i++ {
        go foo(i)
    }

    for i := 0; i < count; i++ {
        <- quit
    }
}
对于方案2, 把信道换成缓冲1000的:

quit = make(chan int, count) // 容量1000
其实区别仅仅在于一个是缓冲的，一个是非缓冲的。

对于这个场景而言，两者都能完成任务, 都是可以的。

无缓冲的信道是一批数据一个一个的「流进流出」

缓冲信道则是一个一个存储，然后一起流出去


## 2017.11.13

### 如何优雅的关闭go channel

Channel关闭原则

不要在消费端关闭channel，不要在有多个并行的生产者时对channel执行关闭操作。

也就是说应该只在[唯一的或者最后唯一剩下]的生产者协程中关闭channel，来通知消费者已经没有值可以继续读了。只要坚持这个原则，就可以确保向一个已经关闭的channel发送数据的情况不可能发生。

暴力关闭channel的正确方法

如果想要在消费端关闭channel，或者在多个生产者端关闭channel，可以使用recover机制来上个保险，避免程序因为panic而崩溃。

func SafeClose(ch chan T) (justClosed bool) {
	defer func() {
		if recover() != nil {
			justClosed = false
		}
	}()
	
	// assume ch != nil here.
	close(ch) // panic if ch is closed
	return true // <=> justClosed = true; return
}
使用这种方法明显违背了上面的channel关闭原则，然后性能还可以，毕竟在每个协程只会调用一次SafeClose，性能损失很小。

同样也可以在生产消息的时候使用recover方法。

 func SafeSend(ch chan T, value T) (closed bool) {
	defer func() {
		if recover() != nil {
			// The return result can be altered 
			// in a defer function call.
			closed = true
		}
	}()
	
	ch <- value // panic if ch is closed
	return false // <=> closed = false; return
}
礼貌的关闭channel方法

还有不少人经常使用用sync.Once来关闭channel，这样可以确保只会关闭一次

 type MyChannel struct {
	C    chan T
	once sync.Once
}

func NewMyChannel() *MyChannel {
	return &MyChannel{C: make(chan T)}
}

func (mc *MyChannel) SafeClose() {
	mc.once.Do(func() {
		close(mc.C)
	})
}
同样我们也可以使用sync.Mutex达到同样的目的。

type MyChannel struct {
	C      chan T
	closed bool
	mutex  sync.Mutex
}

func NewMyChannel() *MyChannel {
	return &MyChannel{C: make(chan T)}
}

func (mc *MyChannel) SafeClose() {
	mc.mutex.Lock()
	if !mc.closed {
		close(mc.C)
		mc.closed = true
	}
	mc.mutex.Unlock()
}

func (mc *MyChannel) IsClosed() bool {
	mc.mutex.Lock()
	defer mc.mutex.Unlock()
	return mc.closed
}
要知道golang的设计者不提供SafeClose或者SafeSend方法是有原因的，他们本来就不推荐在消费端或者在并发的多个生产端关闭channel，比如关闭只读channel在语法上就彻底被禁止使用了。

优雅的关闭channel的方法

上文的SafeSend方法一个很大的劣势在于它不能用在select块的case语句中。而另一个很重要的劣势在于像我这样对代码有洁癖的人来说，使用panic/recover和sync/mutex来搞定不是那么的优雅。下面我们引入在不同的场景下可以使用的纯粹的优雅的解决方法。

多个消费者，单个生产者。这种情况最简单，直接让生产者关闭channel好了。

package main

import (
	"time"
	"math/rand"
	"sync"
	"log"
)

func main() {
	rand.Seed(time.Now().UnixNano())
	log.SetFlags(0)
	
	// ...
	const MaxRandomNumber = 100000
	const NumReceivers = 100
	
	wgReceivers := sync.WaitGroup{}
	wgReceivers.Add(NumReceivers)
	
	// ...
	dataCh := make(chan int, 100)
	
	// the sender
	go func() {
		for {
			if value := rand.Intn(MaxRandomNumber); value == 0 {
				// The only sender can close the channel safely.
				close(dataCh)
				return
			} else {			
				dataCh <- value
			}
		}
	}()
	
	// receivers
	for i := 0; i < NumReceivers; i++ {
		go func() {
			defer wgReceivers.Done()
			
			// Receive values until dataCh is closed and
			// the value buffer queue of dataCh is empty.
			for value := range dataCh {
				log.Println(value)
			}
		}()
	}
	
	wgReceivers.Wait()
}
多个生产者，单个消费者。这种情况要比上面的复杂一点。我们不能在消费端关闭channel，因为这违背了channel关闭原则。但是我们可以让消费端关闭一个附加的信号来通知发送端停止生产数据。

package main

import (
	"time"
	"math/rand"
	"sync"
	"log"
)

func main() {
	rand.Seed(time.Now().UnixNano())
	log.SetFlags(0)
	
	// ...
	const MaxRandomNumber = 100000
	const NumSenders = 1000
	
	wgReceivers := sync.WaitGroup{}
	wgReceivers.Add(1)
	
	// ...
	dataCh := make(chan int, 100)
	stopCh := make(chan struct{})
	// stopCh is an additional signal channel.
	// Its sender is the receiver of channel dataCh.
	// Its reveivers are the senders of channel dataCh.
	
	// senders
	for i := 0; i < NumSenders; i++ {
		go func() {
			for {
				// The first select here is to try to exit the goroutine
				// as early as possible. In fact, it is not essential
				// for this example, so it can be omitted.
				select {
				case <- stopCh:
					return
				default:
				}
				
				// Even if stopCh is closed, the first branch in the
				// second select may be still not selected for some
				// loops if the send to dataCh is also unblocked.
				// But this is acceptable, so the first select
				// can be omitted.
				select {
				case <- stopCh:
					return
				case dataCh <- rand.Intn(MaxRandomNumber):
				}
			}
		}()
	}
	
	// the receiver
	go func() {
		defer wgReceivers.Done()
		
		for value := range dataCh {
			if value == MaxRandomNumber-1 {
				// The receiver of the dataCh channel is
				// also the sender of the stopCh cahnnel.
				// It is safe to close the stop channel here.
				close(stopCh)
				return
			}
			
			log.Println(value)
		}
	}()
	
	// ...
	wgReceivers.Wait()
}
就上面这个例子，生产者同时也是退出信号channel的接受者，退出信号channel仍然是由它的生产端关闭的，所以这仍然没有违背channel关闭原则。值得注意的是，这个例子中生产端和接受端都没有关闭消息数据的channel，channel在没有任何goroutine引用的时候会自行关闭，而不需要显示进行关闭。

多个生产者，多个消费者

这是最复杂的一种情况，我们既不能让接受端也不能让发送端关闭channel。我们甚至都不能让接受者关闭一个退出信号来通知生产者停止生产。因为我们不能违反channel关闭原则。但是我们可以引入一个额外的协调者来关闭附加的退出信号channel。

package main

import (
	"time"
	"math/rand"
	"sync"
	"log"
	"strconv"
)

func main() {
	rand.Seed(time.Now().UnixNano())
	log.SetFlags(0)
	
	// ...
	const MaxRandomNumber = 100000
	const NumReceivers = 10
	const NumSenders = 1000
	
	wgReceivers := sync.WaitGroup{}
	wgReceivers.Add(NumReceivers)
	
	// ...
	dataCh := make(chan int, 100)
	stopCh := make(chan struct{})
		// stopCh is an additional signal channel.
		// Its sender is the moderator goroutine shown below.
		// Its reveivers are all senders and receivers of dataCh.
	toStop := make(chan string, 1)
		// The channel toStop is used to notify the moderator
		// to close the additional signal channel (stopCh).
		// Its senders are any senders and receivers of dataCh.
		// Its reveiver is the moderator goroutine shown below.
	
	var stoppedBy string
	
	// moderator
	go func() {
		stoppedBy = <- toStop
		close(stopCh)
	}()
	
	// senders
	for i := 0; i < NumSenders; i++ {
		go func(id string) {
			for {
				value := rand.Intn(MaxRandomNumber)
				if value == 0 {
					// Here, a trick is used to notify the moderator
					// to close the additional signal channel.
					select {
					case toStop <- "sender#" + id:
					default:
					}
					return
				}
				
				// The first select here is to try to exit the goroutine
				// as early as possible. This select blocks with one
				// receive operation case and one default branches will
				// be optimized as a try-receive operation by the
				// official Go compiler.
				select {
				case <- stopCh:
					return
				default:
				}
				
				// Even if stopCh is closed, the first branch in the
				// second select may be still not selected for some
				// loops (and for ever in theory) if the send to
				// dataCh is also unblocked.
				// This is why the first select block is needed.
				select {
				case <- stopCh:
					return
				case dataCh <- value:
				}
			}
		}(strconv.Itoa(i))
	}
	
	// receivers
	for i := 0; i < NumReceivers; i++ {
		go func(id string) {
			defer wgReceivers.Done()
			
			for {
				// Same as the sender goroutine, the first select here
				// is to try to exit the goroutine as early as possible.
				select {
				case <- stopCh:
					return
				default:
				}
				
				// Even if stopCh is closed, the first branch in the
				// second select may be still not selected for some
				// loops (and for ever in theory) if the receive from
				// dataCh is also unblocked.
				// This is why the first select block is needed.
				select {
				case <- stopCh:
					return
				case value := <-dataCh:
					if value == MaxRandomNumber-1 {
						// The same trick is used to notify
						// the moderator to close the
						// additional signal channel.
						select {
						case toStop <- "receiver#" + id:
						default:
						}
						return
					}
					
					log.Println(value)
				}
			}
		}(strconv.Itoa(i))
	}
	
	// ...
	wgReceivers.Wait()
	log.Println("stopped by", stoppedBy)
}
以上三种场景不能涵盖全部，但是它们是最常见最通用的三种场景，基本上所有的场景都可以划分为以上三类。

结论


## 2017.11.26  

### 各类web前端框架的应用场景

##### react的应用场景

```sh
1.我们在业务比较复杂的情况下还要保持着很高的性能 
2.重用组件库，组件组合，高度可重用
```


## 2018.2.5

### 13和77的模数是一样的

##### x\*13%1000\s*77%1000

## 2018.3.15

### Tendermint

参考资料 [区块链 PoS 共识——Tendermint](https://blog.csdn.net/omnispace/article/details/79653258)

* 用来保证数据一致性，故障的节点能够看到相同的事务日志并计算出相同的状态
* 分布式系统需要具备容忍节点离线或者出错，拜占庭容错
* 包含两个组件：共识引擎和通用应用接口
* 共识引擎：tendermint core 确保交易记录在任何一个节点都能一致被排序
* 通用应用接口：ABCI，交易可以被任何变成语言处理
* 大部分共识方案预先打包内置状态机（存储键值对或者通过脚本），然而Tendermint可以对任意编程语言编码的应用实现BFT状态机复制，并且开发环境对开发者也很适合
* Tendermint 保证了永远都不会违背其安全性 – 也就是说，验证人永远不会在同一高度提交冲突块。为了达到这一点，它引入了一些 “锁定”（locking）的规则，一旦一个验证人预提交了一个块，它就被“锁定”在了那个块上。然后，1.它必须为被锁定的那个块进行预投票 2.只有在之后的轮中，有了那个块的一个波卡，它才能够解锁，并为一个新块进行预提交。
* Tendermint里面对高度为h的块共识的每一轮包括3个步骤：Propose（提议），Prevote（预投票），Precommit（预提交）。当在某一轮达成共识(收到大于2/3的Precommit投票)后，就会进入对下一个高度的共识，从第0轮开始
* 简单来说PoLC就是Prevote的投票集。
*  要想成功提交一个块，需要有两个阶段的投票：预投票和预提交。在同一轮提交中，只有超过2/3 的验证人对同一个块进行了预提交，这个块才能被提交到链上。
*  这也意味这 Tendermint 可以作为其他区块链项目即插可用的共识引擎， 替换原有的共识模块。
*  Tendermint 从特定区块链应用(例如 Bitcoin-core 和 go-ethereum) 的把共识引擎和 P2P 网络分离。区块链应用的细节抽象为一个接口，并通过 socket 协议实现。
*  如果想要在 ABCI 上实现一个比特币类(Bitcoin-like)的系统，Tendermint 将会负责：

在节点间共享区块和交易
给所有交易建立一个规范且不可篡改的顺序
而区块链应用 (也就是 bitcoin-coer) 负责：

维护 UTXO 数据库
验证交易的加密签名
阻止交易花费尚未存在的交易
允许客户端查询 UTXO 数据库

## 2018.3.30

### 一些区块链的小问题

* 锁定脚本和解锁脚本：锁定脚本就是增加障碍，要有条件才能动用这笔资金，类似于公钥私钥
* 比特币的网络拥堵的解决方案：①把一些交易转到链下，闪电网络的方式，作为一个支付结算的系统 ②通过侧链来扩展比特币，不去改动比特币，把一些交易放在侧链上 ③隔离见证签名单独提出来，人为欺骗比特币的大小检测
* 提高以太坊的tps，会牺牲一些安全性的东西
* 合约的触发规则，比如给一个用户发送一比以太币，这种都叫触发
* 不做全网共识，在地址片内做共识
* ipfs文件系统，把文件打散存放在网络的各个节点，不像以前的互联网去按照域名的地址之类的去寻找这个文件，文件打散后每个部分的文件都去做一个哈希的签名，然后把这些部分块链接在一起，在寻找这些文件的方式上采用指纹的获取方式，有可能是替代TCP的网络方案

## 2018.4.30

### 共识算法基础

叛徒的总数不能超过3分之一

* 拜占庭协议：

特征：单一来源有一个初始值

属性：①协议，所有的非缺陷进程必须统一同一个值 ②正确性，如果元进程是非缺陷的，那么所有非缺陷进程必须统一元进程的初始值 ③可结束性，每个非缺陷进程必须确定最终的一个值

* 设计一个分布式系统的假设需要
①故障模型，是为了解决拜占庭问题还是非拜占庭问题
②通信问题，同步问题，半异步（延迟限制），异步（延迟无限制）
③通信网络连接，节点间的直连数
④信息发送者身份，实名还是匿名
⑤通信通道稳定性
⑥消息认证性：认证消息和非认证消息

* _TODO_ FLP 网络通信的异步通信是可靠地，消息是异步的而且消息不会丢失 CAP定理，用BASE（基本可用，软状态，最终一致性）替换ACID（原子性，）

* 公有链（比特币和以太坊）中共识算法决定记账权，私链和联盟链（强调强一致性）中共识算法不仅决定记账权还要决定交易的顺序
* 强一致性1就一定是1，非强一致性就是1有（非常小的）可能是0
* 共识算法的选择：应用场景DPos的效率高，如果是虚拟货币参与度和公平性还有安全性决定pow
* 如果在公有链的情况下，共识算法选择一个最终一致性，能够处理拜占庭故障的，共识成本POW和POS，共识的效率也要高，安全性也要高，在pos上作恶的成本很低；如果是联盟链或者私有链的情况下需要保证一个强一致性的，故障类型比较灵活，主要考虑共识的效率

## 2018.4.30

### 共识算法基础

* paxos是强一致性的共识算法，可以容忍f<n/2个节点的错误（非拜占庭错误），这个算法是为了避免对协调者的依赖，为了处理多节点Crash-Recovery的故障，其中包含三种角色 1.proposer，提出一个被希望接受的值 2.accepter接受提议或者拒绝提议 3.learner不参与决策，但是要知道最后的结果 paxos是一个两阶段的协议，但是比2pc有更强的故障恢复力，主要是通过多数集对结果的确认
* PBFT 5轮通信，扩展性比较差，对并发情况比较难以处理，需要f轮达成共识，f就是错误节点的个数

## 2018.5.9

### 分叉

* 硬分叉真正两条链，最终算力小的分叉会被抛弃
* 多练闪电网络，多练一条网络上有多条链，侧链的话一定需要有一个主链，在侧链扩展主链的功能，闪电网络直接通知支付结算结果
    

