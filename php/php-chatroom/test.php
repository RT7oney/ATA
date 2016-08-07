function uncode($str,$key){
		$mask = array();
		$data = '';
		$msg = unpack('H*',$str);
		$head = substr($msg[1],0,2);
		if ($head == '81' && !isset($this->slen[$key])) {
			$len=substr($msg[1],2,2);
			$len=hexdec($len);
			if(substr($msg[1],2,2)=='fe'){
				$len=substr($msg[1],4,4);
				$len=hexdec($len);
				$msg[1]=substr($msg[1],4);
			}else if(substr($msg[1],2,2)=='ff'){
				$len=substr($msg[1],4,16);
				$len=hexdec($len);
				$msg[1]=substr($msg[1],16);
			}
			$mask[] = hexdec(substr($msg[1],4,2));
			$mask[] = hexdec(substr($msg[1],6,2));
			$mask[] = hexdec(substr($msg[1],8,2));
			$mask[] = hexdec(substr($msg[1],10,2));
			$s = 12;
			$n=0;
		}else if($this->slen[$key] > 0){
			$len=$this->slen[$key];
			$mask=$this->ar[$key];
			$n=$this->n[$key];
			$s = 0;
		}

		$e = strlen($msg[1])-2;
		for ($i=$s; $i<= $e; $i+= 2) {
			$data .= chr($mask[$n%4]^hexdec(substr($msg[1],$i,2)));
			$n++;
		}
		$dlen=strlen($data);

		if($len > 255 && $len > $dlen+intval($this->sjen[$key])){
			$this->ar[$key]=$mask;
			$this->slen[$key]=$len;
			$this->sjen[$key]=$dlen+intval($this->sjen[$key]);
			$this->sda[$key]=$this->sda[$key].$data;
			$this->n[$key]=$n;
			return false;
		}else{
			unset($this->ar[$key],$this->slen[$key],$this->sjen[$key],$this->n[$key]);
			$data=$this->sda[$key].$data;
			unset($this->sda[$key]);
			return $data;
		}

	}


	function code($msg){
		$frame = array();
		$frame[0] = '81';
		$len = strlen($msg);
		if($len < 126){
			$frame[1] = $len<16?'0'.dechex($len):dechex($len);
		}else if($len < 65025){
			$s=dechex($len);
			$frame[1]='7e'.str_repeat('0',4-strlen($s)).$s;
		}else{
			$s=dechex($len);
			$frame[1]='7f'.str_repeat('0',16-strlen($s)).$s;
		}
		$frame[2] = $this->ord_hex($msg);
		$data = implode('',$frame);
		return pack("H*", $data);
	}
