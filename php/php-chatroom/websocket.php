<?php
error_reporting(E_ALL & ~E_NOTICE);
ob_implicit_flush();

$sk = new Sock('192.168.1.113', 8000);
$sk->run();
class Sock {
	public $sockets;
	public $users;
	public $master;
	public $while_flag = 1;
	public $foreach_flag = 1;

	public function __construct($address, $port) {
		$this->master = $this->WebSocket($address, $port);
		$this->sockets = array('s' => $this->master);
		// $this->e("初始化this->master：" . json_encode($this->master));
		// $this->e("初始化this->sockets：" . json_encode($this->sockets));
	}

	function run() {
		while (true) {
			echo "--------this is the $this->while_flag times WHILE circle!--------";
			echo "!!!all begin:!!!!\n";
			echo "--------this->sockets----------\n";
			var_dump($this->sockets);
			echo "--------this->users----------\n";
			var_dump($this->users);
			echo "-------------------------------\n";

			$changes = $this->sockets;
			echo "-------------run-while------changes:30\n";
			var_dump($changes);
			echo "-------------------------------\n";
			// $this->e("run方法中的foreach里面的21行的changes：" . json_encode($changes));
			$check = socket_select($changes, $write = NULL, $except = NULL, NULL);
			if (!$check) {
				$this->e("socket_select:error");
				die;
			}
			// var_dump($changes);
			foreach ($changes as $k => $sock) {
				// var_dump($k . "\n");
				echo "--------this is the $this->foreach_flag times FOREACH circle!--------";
				echo "---------foreach------sock:42\n";
				var_dump($sock);
				echo "-------------------------------\n";
				// $this->e("run方法中的foreach里面的29行的sock：" . json_encode($sock));
				echo "?????????sock==this->master????????\n";
				var_dump($sock == $this->master);
				echo "-------------------------------\n";
				if ($sock == $this->master) {
					$client = socket_accept($this->master);
					echo "------------client------client:51\n";
					var_dump($client);
					echo "-------------------------------\n";
					echo "------------this->master:50----------\n";
					var_dump($this->master);
					echo "-------------------------------\n";
					// $this->e("run方法中的foreach里面的34行的client：" . json_encode($client));
					//$key=uniqid();
					$this->sockets[] = $client; //拼接sockets数组
					$this->users[] = array(
						'socket' => $client,
						'shou' => false,
					);
				} else {
					echo "--------0  buffer--------\n";
					var_dump($buffer);
					echo "-------------------------------\n";
					$len = socket_recv($sock, $buffer, 2048, 0);
					echo "--------1  buffer--------\n";
					var_dump($buffer);
					echo "-------------------------------\n";
					$this->e("run方法中的foreach里面的43行的len：" . json_encode($len));
					$k = $this->search($sock);
					// $this->e("run方法中的foreach里面的45行的k：" . json_encode($k));
					if ($len < 7) {
						$name = $this->users[$k]['name'];
						// $this->e("run方法中的foreach里面的48行的name：" . json_encode($name));
						$this->close($sock);
						$this->send2($name, $k);
						continue;
					}
					if (!$this->users[$k]['shou']) {
						echo "--------握手 buffer--------\n";
						var_dump($buffer);
						echo "-------------------------------\n";
						$this->woshou($k, $buffer);
					} else {
						echo "---------消息 buffer--------\n";
						var_dump($buffer);
						echo "-------------------------------\n";
						$buffer = $this->uncode($buffer);
						echo "--------解码 buffer--------\n";
						var_dump($buffer);
						echo "-------------------------------\n";
						// $this->e("run方法中的foreach里面的57行的buffer：" . json_encode($buffer));
						$this->send($k, $buffer);
					}
				}
				$this->foreach_flag++;
			}
			$this->while_flag++;
		}

	}

	function close($sock) {
		$k = array_search($sock, $this->sockets);
		socket_close($sock);
		unset($this->sockets[$k]);
		unset($this->users[$k]);
		$this->e("key:$k close");
	}

	function search($sock) {
		foreach ($this->users as $k => $v) {
			if ($sock == $v['socket']) {
				return $k;
			}

		}
		return false;
	}

	function WebSocket($address, $port) {
		$server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_bind($server, $address, $port);
		socket_listen($server);
		$this->e('Server Started : ' . date('Y-m-d H:i:s'));
		$this->e('Listening on   : ' . $address . ' port ' . $port);
		// var_dump($server);die;
		return $server;
	}

	function woshou($k, $buffer) {
		echo "--------who is shaking hand? $k ---------\n";
		$buf = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
		$key = trim(substr($buf, 0, strpos($buf, "\r\n")));

		$new_key = base64_encode(sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));

		$new_message = "HTTP/1.1 101 Switching Protocols\r\n";
		$new_message .= "Upgrade: websocket\r\n";
		$new_message .= "Sec-WebSocket-Version: 13\r\n";
		$new_message .= "Connection: Upgrade\r\n";
		$new_message .= "Sec-WebSocket-Accept: " . $new_key . "\r\n\r\n";

		socket_write($this->users[$k]['socket'], $new_message, strlen($new_message));
		$this->users[$k]['shou'] = true;
		return true;

	}

	function uncode($str) {
		$mask = array();
		$data = '';
		$msg = unpack('H*', $str);
		$head = substr($msg[1], 0, 2);
		if (hexdec($head{1}) === 8) {
			$data = false;
		} else if (hexdec($head{1}) === 1) {
			$mask[] = hexdec(substr($msg[1], 4, 2));
			$mask[] = hexdec(substr($msg[1], 6, 2));
			$mask[] = hexdec(substr($msg[1], 8, 2));
			$mask[] = hexdec(substr($msg[1], 10, 2));

			$s = 12;
			$e = strlen($msg[1]) - 2;
			$n = 0;
			for ($i = $s; $i <= $e; $i += 2) {
				$data .= chr($mask[$n % 4] ^ hexdec(substr($msg[1], $i, 2)));
				$n++;
			}
		}
		return $data;
	}

	function code($msg) {
		$msg = preg_replace(array('/\r$/', '/\n$/', '/\r\n$/'), '', $msg);
		$frame = array();
		$frame[0] = '81';
		$len = strlen($msg);
		$frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
		$frame[2] = $this->ord_hex($msg);
		$data = implode('', $frame);
		return pack("H*", $data);
	}

	function ord_hex($data) {
		$msg = '';
		$l = strlen($data);
		for ($i = 0; $i < $l; $i++) {
			$msg .= dechex(ord($data{$i}));
		}
		return $msg;
	}

	function send($k, $msg) {
		/*$this->send1($k,$this->code($msg),'all');*/
		parse_str($msg, $g);
		$this->e($msg);
		$ar = array();
		if ($g['type'] == 'add') {
			$this->users[$k]['name'] = $g['name'];
			/*TEST*/
			$this->users[$k]['head'] = $g['head'];
			$ar['add'] = true;
			$ar['content'] = '欢迎' . $g['name'] . '加入！';
			$ar['users'] = $this->getusers();
			$to = 'all';
		} else if ($g['type'] == 'talk') {
			$ar['content'] = $g['content'];
			$ar['from'] = $g['from'];
			$ar['to'] = $g['to'];
			$to = $g['to'];
		}
		$msg = json_encode($ar);
		$this->e($msg);
		$msg = $this->code($msg);
		echo '-------send and coded msg---------217' . "\n";
		var_dump($msg);
		echo '-------------------------------------' . "\n";
		$this->send1($k, $msg, $to, 'send');
		//socket_write($this->users[$k]['socket'],$msg,strlen($msg));
	}

	function getusers() {
		$ar = array();
		foreach ($this->users as $k => $v) {
			// $ar[$k] = $v['name'];
			/*TEST*/
			$ar[$k] = array(
				$v['name'],
				$v['head'],
			);
		}
		return $ar;
	}

	function send1($k, $str, $to = 'all', $who) {
		// $this->e("send1方法中的189行的三个参数：" . json_encode($k));
		// $this->e("send1方法中的189行的三个参数：" . json_encode($str));
		// $this->e("send1方法中的189行的三个参数：" . json_encode($to));
		// $this->e("send1方法中的189行的user：" . json_encode($this->users));
		// print_r($this->users);
		echo 'who use the send1:--' . $who . "\n";
		echo 'k:--' . $k . "\n";
		echo 'str:--' . $str . "\n";
		echo 'key:--' . $to . "\n";

		if ($to == 'all') {
			foreach ($this->users as $v) {
				socket_write($v['socket'], $str, strlen($str));
			}
		} else {
			if ($k != $to) {
				socket_write($this->users[$k]['socket'], $str, strlen($str));
			}
			socket_write($this->users[$to]['socket'], $str, strlen($str));
		}
	}

	function send2($name, $k) {
		$ar['remove'] = true;
		$ar['removekey'] = $k;
		$ar['content'] = $name . '退出聊天室';
		$str = $this->code(json_encode($ar));
		$this->send1(false, $str, 'all', 'send2');
	}

	function e($str) {
		$path = dirname(__FILE__) . '/log.txt';
		$str = '[#@' . date("Y-m-d H:i:s") . '#]------' . $str . "\n";
		error_log($str, 3, $path);
		echo iconv('utf-8', 'gbk//IGNORE', $str);
	}
}
?>