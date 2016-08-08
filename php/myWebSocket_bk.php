<?php
error_reporting(E_ALL & ~E_NOTICE);
ob_implicit_flush();
set_time_limit(0);
$room = new ChatRoom;
$room->run();
class ChatRoom {
	public $master;
	public $sockets;
	public $users;
	public $flag = 1;

	public function __construct() {
		$this->webSocket();
		$this->sockets = array('s' => $this->master);
	}

	public function run() {
		// socket_close($this->sockets);
		echo "-----------所有的sockets:-------------\n";
		var_dump($this->sockets);
		echo "---------------------------\n";
		echo "-----------所有的users:-------------\n";
		var_dump($this->users);
		echo "---------------------------\n";

		while (1) {
			// $this->log("这是第" . $this->flag . "次循环");
			echo "-----------这是第{$this->flag}次循环------------\n";
			$changes = $this->sockets; //建立一个变化数组，存放着socket的文件描述符，当它有变化的时候，socket_select函数才会返回
			$check = socket_select($changes, $write = NULL, $except = NULL, NULL);
			if (!$check) {
				die("socket_select error:");
			}

			foreach ($changes as $key => $value) {
				$this->log('$value是否和master相等：' . $this->my_json_encode($value == $this->master));
				if ($value == $this->master) {
					$client = socket_accept($this->master);
					// var_dump($client);
					$this->log("client：" . $this->my_json_encode($client));
					$this->sockets[] = $client; //拼接sockets数组
					$this->log("this->sockets数组" . $this->my_json_encode($this->sockets));
					$this->users[] = array(
						'socket' => $client,
						'is_hand_shake' => false,
					);
					$this->log("client：" . $this->my_json_encode($this->users));
				} else {
					if (($msg_sock = socket_accept($value)) < 0) {
						$this->log("socket_accept() failed: reason: " . socket_strerror($msg_sock));
						break;
					} else {
						$buffer = socket_read($msg_sock, 8192, PHP_NORMAL_READ);
						$this->log("old-buffer:" . $this->my_json_encode($buffer));
						$len = socket_recv($msg_sock, $buffer, 2048, 0);
						$this->log("new-buffer-with-len:" . $this->my_json_encode($buffer) . "len:" . $len);
						// $msg = $this->decode($buffer);
						$k = $this->search($msg_sock);
						if (!$this->users[$k]['is_hand_shake']) {
							$this->handShake($k, $buffer);
						} else {
							// var_dump($buffer);
							$msg = $this->uncode($buffer);
							$this->log("我们伟大的msg:" . $this->my_json_encode($msg));
						}
					}
				}
				// socket_close($value);
				$this->flag++;
			}

		}
		// socket_close($this->master);
		$this->log("all-sockets:" . $this->my_json_encode($this->sockets));
		// sleep(1);
	}

	public function webSocket() {
		if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
			$this->log("socket_create() 失败的原因是:" . socket_strerror($sock));
		}

		if (($ret = socket_bind($sock, '127.0.0.1', '9999')) < 0) {
			$this->log("socket_bind() 失败的原因是:" . socket_strerror($ret));
		}

		if (($ret = socket_listen($sock, 4)) < 0) {
			$this->log("socket_listen() 失败的原因是:" . socket_strerror($ret));
		}
		$this->master = $sock;
	}
	public function log($log_data) {
		$fd = fopen('./log/' . date('Ym') . '.log', "a");
		$str = "[#@" . date("Y/m/d h:i:s", time()) . "#]------" . $log_data;
		fwrite($fd, $str . "\n");
		fclose($fd);
	}
	public function my_json_encode($data) {
		return json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function search($sock) {
		foreach ($this->users as $k => $v) {
			if ($sock == $v['socket']) {
				return $k;
			}

		}
		return false;
	}

	public function handShake($k, $buffer) {
		$buf = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
		$key = trim(substr($buf, 0, strpos($buf, "\r\n")));

		$new_key = base64_encode(sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));

		$new_message = "HTTP/1.1 101 Switching Protocols\r\n";
		$new_message .= "Upgrade: websocket\r\n";
		$new_message .= "Sec-WebSocket-Version: 13\r\n";
		$new_message .= "Connection: Upgrade\r\n";
		$new_message .= "Sec-WebSocket-Accept: " . $new_key . "\r\n\r\n";

		socket_write($this->users[$k]['socket'], $new_message, strlen($new_message));
		$this->users[$k]['is_hand_shake'] = true;
		return true;

	}

	public function close($sock) {
		$k = array_search($sock, $this->sockets);
		socket_close($sock);
		unset($this->sockets[$k]);
		unset($this->users[$k]);
		$this->e("key:$k close");
	}

/**
 * 对$buffer = socket_read($msg_sock, 8192);获得到的buffer进行解密
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
	public function decode($str) {
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

/**
 * 对消息加密的方法
 * @param  [type] $msg [description]
 * @return [type]      [description]
 */
	public function encode($msg) {
		$msg = preg_replace(array('/\r$/', '/\n$/', '/\r\n$/'), '', $msg);
		$frame = array();
		$frame[0] = '81';
		$len = strlen($msg);
		$frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
		$frame[2] = $this->ord_hex($msg);
		$data = implode('', $frame);
		return pack("H*", $data);
	}
}
?>