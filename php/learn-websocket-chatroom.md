//客户端
1 <?php
 2 //确保在连接客户端时不会超时
 3 set_time_limit(0);
 4 
 5 $ip = '127.0.0.1';
 6 $port = 1935;
 7 
 8 /*
 9  +-------------------------------
10  *    @socket通信整个过程
11  +-------------------------------
12  *    @socket_create
13  *    @socket_bind
14  *    @socket_listen
15  *    @socket_accept
16  *    @socket_read
17  *    @socket_write
18  *    @socket_close
19  +--------------------------------
20  */
21 
22 /*----------------    以下操作都是手册上的    -------------------*/
23 if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
24     echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
25 }
26 
27 if(($ret = socket_bind($sock,$ip,$port)) < 0) {
28     echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
29 }
30 
31 if(($ret = socket_listen($sock,4)) < 0) {
32     echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
33 }
34 
35 $count = 0;
36 
37 do {
38     if (($msgsock = socket_accept($sock)) < 0) {
39         echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
40         break;
41     } else {
42         
43         //发到客户端
44         $msg ="测试成功！\n";
45         socket_write($msgsock, $msg, strlen($msg));
46         
47         echo "测试成功了啊\n";
48         $buf = socket_read($msgsock,8192);
49         
50         
51         $talkback = "收到的信息:$buf\n";
52         echo $talkback;
53         
54         if(++$count >= 5){
55             break;
56         };
57         
58     
59     }
60     //echo $buf;
61     socket_close($msgsock);
62 
63 } while (true);
64 
65 socket_close($sock);
66 ?>

//客户端
1 <?php
 2 error_reporting(E_ALL);
 3 set_time_limit(0);
 4 echo "<h2>TCP/IP Connection</h2>\n";
 5 
 6 $port = 1935;
 7 $ip = "127.0.0.1";
 8 
 9 /*
10  +-------------------------------
11  *    @socket连接整个过程
12  +-------------------------------
13  *    @socket_create
14  *    @socket_connect
15  *    @socket_write
16  *    @socket_read
17  *    @socket_close
18  +--------------------------------
19  */
20 
21 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
22 if ($socket < 0) {
23     echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
24 }else {
25     echo "OK.\n";
26 }
27 
28 echo "试图连接 '$ip' 端口 '$port'...\n";
29 $result = socket_connect($socket, $ip, $port);
30 if ($result < 0) {
31     echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
32 }else {
33     echo "连接OK\n";
34 }
35 
36 $in = "Ho\r\n";
37 $in .= "first blood\r\n";
38 $out = '';
39 
40 if(!socket_write($socket, $in, strlen($in))) {
41     echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
42 }else {
43     echo "发送到服务器信息成功！\n";
44     echo "发送的内容为:<font color='red'>$in</font> <br>";
45 }
46 
47 while($out = socket_read($socket, 8192)) {
48     echo "接收服务器回传信息成功！\n";
49     echo "接受的内容为:",$out;
50 }
51 
52 
53 echo "关闭SOCKET...\n";
54 socket_close($socket);
55 echo "关闭OK\n";
56 ?>


//讲解

// 设置一些基本的变量
$host = "192.168.1.99";
$port = 1234;
// 设置超时时间
set_time_limit(0);
// 创建一个Socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not createsocket\n");
//绑定Socket到端口
$result = socket_bind($socket, $host, $port) or die("Could not bind tosocket\n");
// 开始监听链接
$result = socket_listen($socket, 3) or die("Could not set up socketlistener\n");
// accept incoming connections
// 另一个Socket来处理通信
$spawn = socket_accept($socket) or die("Could not accept incomingconnection\n");
// 获得客户端的输入
$input = socket_read($spawn, 1024) or die("Could not read input\n");
// 清空输入字符串
$input = trim($input);
//处理客户端输入并返回结果
$output = strrev($input) . "\n";
socket_write($spawn, $output, strlen ($output)) or die("Could not write
output\n");
// 关闭sockets
socket_close($spawn);
socket_close($socket);

下面是其每一步骤的详细说明:

1.第一步是建立两个变量来保存Socket运行的服务器的IP地址和端口.你可以设置为你自己的服务器和端口(这个端口可以是1到65535之间的数字),前提是这个端口未被使用.

[Copy to clipboard]
PHP CODE:
// 设置两个变量
$host = "192.168.1.99";
$port = 1234;

2.在服务器端可以使用set_time_out()函数来确保PHP在等待客户端连接时不会超时.

[Copy to clipboard]
PHP CODE:
// 超时时间
set_time_limit(0);

3.在前面的基础上,现在该使用socket_creat()函数创建一个Socket了—这个函数返回一个Socket句柄,这个句柄将用在以后所有的函数中.

[Copy to clipboard]
PHP CODE:
// 创建Socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create
socket\n");

第一个参数”AF_INET”用来指定域名;
第二个参数”SOCK_STREM”告诉函数将创建一个什么类型的Socket(在这个例子中是TCP类型)

因此,如果你想创建一个UDP Socket的话,你可以使用如下的代码:

[Copy to clipboard]
PHP CODE:
// 创建 socket
$socket = socket_create(AF_INET, SOCK_DGRAM, 0) or die("Could not create
socket\n");

4.一旦创建了一个Socket句柄,下一步就是指定或者绑定它到指定的地址和端口.这可以通过socket_bind()函数来完成.

[Copy to clipboard]
PHP CODE:
// 绑定 socket to 指定地址和端口
$result = socket_bind($socket, $host, $port) or die("Could not bind to
socket\n");

5.当Socket被创建好并绑定到一个端口后,就可以开始监听外部的连接了.PHP允许你由socket_listen()函数来开始一个监听,同时你可以指定一个数字(在这个例子中就是第二个参数:3)

[Copy to clipboard]
PHP CODE:
// 开始监听连接
$result = socket_listen($socket, 3) or die("Could not set up socket
listener\n");

6.到现在,你的服务器除了等待来自客户端的连接请求外基本上什么也没有做.一旦一个客户端的连接被收到,socket_accept()函数便开始起作用了,它接收连接请求并调用另一个子Socket来处理客户端–服务器间的信息.

[Copy to clipboard]
PHP CODE:
//接受请求链接
// 调用子socket 处理信息
$spawn = socket_accept($socket) or die("Could not accept incoming
connection\n");

这个子socket现在就可以被随后的客户端–服务器通信所用了.

7.当一个连接被建立后,服务器就会等待客户端发送一些输入信息,这写信息可以由socket_read()函数来获得,并把它赋值给PHP的$input变量.

[Copy to clipboard]
PHP CODE:
// 读取客户端输入
$input = socket_read($spawn, 1024) or die("Could not read input\n");
?&gt;

socker_read的第而个参数用以指定读入的字节数,你可以通过它来限制从客户端获取数据的大小.

注意:socket_read函数会一直读取壳户端数据,直到遇见\n,\t或者\0字符.PHP脚本把这写字符看做是输入的结束符.

8.现在服务器必须处理这些由客户端发来是数据(在这个例子中的处理仅仅包含数据的输入和回传到客户端).这部分可以由socket_write()函数来完成(使得由通信socket发回一个数据流到客户端成为可能)

[Copy to clipboard]
PHP CODE:
// 处理客户端输入并返回数据
$output = strrev($input) . "\n";
socket_write($spawn, $output, strlen ($output)) or die("Could not write
output\n");

9.一旦输出被返回到客户端,父/子socket都应通过socket_close()函数来终止

[Copy to clipboard]
PHP CODE:
// 关闭 sockets
socket_close($spawn);
socket_close($socket);




经朋友推荐去一家手游公司面试，原谅我不厚道的只是好奇手游公司到底是啥样的才去的。工作虽然没找到，但是跟他们的技术总监套近乎聊了几乎一晚上，受益良多，知道了运营多个手游大体需要的技术，当然还是厚道的不爆料了。面试中被问及socket和多线程编程，对这两个知识点完全是空白，回来果断开始研究。还是那句话，不懂裁缝的厨师不是好司机。何况这两个知识也在前端开发的范畴之内。

对我来说最快的学习途径是实践，所以找两个东西来练手。一个是websocket一个是webwoker，今天先说第一个。

要理解socket就要先理解http和tcp的区别，简单说就是一个是短链，一个是长链，一个是去服务器拉数据，一个是服务器可以主动推数据。

而socket就是应用层与TCP/IP协议族通信的中间软件抽象层，它是一组接口。在设计模式中，Socket其实就是一个门面模式，它把复杂的TCP/IP协议族隐藏在Socket接口后面，对用户来说，一组简单的接口就是全部，让Socket去组织数据，以符合指定的协议。-来自网络。

那么如何用php+js做到服务器推呢？

客户端

客户端非常简单，利用现代浏览器的WebSocket API，这里介绍的很详细:http://msdn.microsoft.com/zh-cn/library/ie/hh673567

核心代码：

JAVASCRIPT
1
2
3
4
5
var wsServer = 'ws://127.0.0.1:8080'; 
var ws = new WebSocket(wsServer);
ws.onmessage = function (evt) { 
    do sth
};
前两行会向指定服务器发送一个握手请求，如果服务器返回合法的http头，则握手成功，之后可通过监听onmessage事件来处理服务器发来的消息。还有很多其他事件可监听，见前面的url。

服务器

思路

难点是服务器，没有了apache和nginx这些http服务器在前面顶着，只用php该怎么写？

这里有个教程讲的很深入 http://blog.csdn.net/shagoo/article/details/6396089

写之前捋一捋思路：

1 监听：首先要挂起一个进程来监听来自客户端的请求 
2 握手：对于第一次合法的请求，发送合法的header回去 
3 保持连接：有新消息到了就广播出去。直到客户端断开 
4 接受另一个请求，重复2和3

代码如下：

PHP

public function start_server() {
    $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    //允许使用本地地址
    socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, TRUE); 
    socket_bind($this->socket, $this->host, $this->port);
    //最多10个人连接，超过的客户端连接会返回WSAECONNREFUSED错误
    socket_listen($this->socket, $this->maxuser); 
    while(TRUE) {
        $this->cycle = $this->accept;
        $this->cycle[] = $this->socket;
        //阻塞用，有新连接时才会结束
        socket_select($this->cycle, $write, $except, null);
        foreach ($this->cycle as $k => $v) {
            if($v === $this->socket) {
                if (($accept = socket_accept($v)) < 0) {
                    continue;
                }
                //如果请求来自监听端口那个套接字，则创建一个新的套接字用于通信
                $this->add_accept($accept);
                continue;
            }
            $index = array_search($v, $this->accept);
            if ($index === NULL) {
                continue;
            }
            if (!@socket_recv($v, $data, 1024, 0) || !$data) {//没消息的socket就跳过
                $this->close($v);
                continue;
            }
            if (!$this->isHand[$index]) {
                $this->upgrade($v, $data, $index);
                if(!empty($this->function['add'])) {
                    call_user_func_array($this->function['add'], array($this));
                }
                continue;
            }
            $data = $this->decode($data);
            if(!empty($this->function['send'])) {
                call_user_func_array($this->function['send'], array($data, $index, $this));
            }
        }
        sleep(1);
    }
}
//增加一个初次连接的用户
private function add_accept($accept) {
    $this->accept[] = $accept;
    $index = array_keys($this->accept);
    $index = end($index);
    $this->isHand[$index] = FALSE;
}
//关闭一个连接
private function close($accept) {
    $index = array_search($accept, $this->accept);
    socket_close($accept);
    unset($this->accept[$index]);
    unset($this->isHand[$index]);
    if(!empty($this->function['close'])) {
        call_user_func_array($this->function['close'], array($this));
    }
}
//响应升级协议
private function upgrade($accept, $data, $index) {
    if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/",$data,$match)) {
        $key = base64_encode(sha1($match[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $upgrade  = "HTTP/1.1 101 Switching Protocol\r\n" .
                "Upgrade: websocket\r\n" .
                "Connection: Upgrade\r\n" .
                "Sec-WebSocket-Accept: " . $key . "\r\n\r\n";  //必须以两个回车结尾
        socket_write($accept, $upgrade, strlen($upgrade));
        $this->isHand[$index] = TRUE;
    }
}
关键地方有那么几个，一是while(true)挂起进程，不然执行一次后进程就退出了。二是socket_select和socket_accept函数的使用。三是客户端第一次请求时握手。

socket_select

这个函数是同时接受多个连接的关键，我的理解它是为了阻塞程序继续往下执行。

socket_select ($sockets, $write = NULL, $except = NULL, NULL);

$sockets可以理解为一个数组，这个数组中存放的是文件描述符。当它有变化（就是有新消息到或者有客户端连接/断开）时，socket_select函数才会返回，继续往下执行。 
$write是监听是否有客户端写数据，传入NULL是不关心是否有写变化。 
$except是$sockets里面要被排除的元素，传入NULL是”监听”全部。 
最后一个参数是超时时间 
如果为0：则立即结束 
如果为n>1: 则最多在n秒后结束，如遇某一个连接有新动态，则提前返回 
如果为null：如遇某一个连接有新动态，则返回

socket_accept

此函数接受唯一参数，即前面socket_create创建的socket文件(句柄)。返回一个新的资源，或者FALSE。本函数将会通知socket_listen()，将会传入一个连接的socket资源。一旦成功建立socket连接，将会返回一个新的socket资源，用于通信。如果有多个socket在队列中，那么将会先处理第一个。关键就是这里：如果没有socket连接，那么本函数将会等待，直到有新socket进来。

如果前面不用socket_select在没有socket的时候阻塞住程序，那么就卡在这里永远无法结束了。

后面的流程就很清晰了，当有一个新的客户端请求到达，用socket_accept创建一个资源，并加入到$this->accept连接池里面。并将它的标示isHand设为false，那么下次循环(因为$this->cycle[] = $this->socket;$this->cycle有变化，所以socket_select会返回)的时候就会执行upgrade握手。然后等待它的新消息即可。

程序经调试可以成功运行，php5.3+websocket13。有兴趣的同学可以下载：文件地址