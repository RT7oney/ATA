package main

import (
	// "bufio"
	"encoding/json"
	"fmt"
	"log"
	"net"
	"os"
	// "reflect"
)

func main() {
	var data map[string]string
	data = make(map[string]string) // 创建一个map去保存要发送的数据
	var msg = make([]byte, 1024)   // 创建一个字节切片去接收服务器返回的消息
	data["email"] = "2222@qq.com"
	data["password"] = "123qwe"
	jsonstr, err := json.Marshal(data)
	if err != nil {
		log.Fatal("json to map error : ", err)
	}
	// fmt.Println(reflect.TypeOf(string(jsonstr)))
	// fmt.Println(string(jsonstr))
	/**
	 * 建立socket连接，并向其写入数据
	 */
	conn, err := net.Dial("tcp", "192.168.1.113:10002")
	if err != nil {
		log.Fatal("Dial server:%d\n", err)
	}
	in, err := conn.Write([]byte(jsonstr))
	if err != nil {
		log.Fatal("Error when send to server: %d\n", err)
		return response(501, "向组件")
	}
	length, err := conn.Read(msg)
	if err != nil {
		log.Fatal("Error when read msg from server:%d\n", err)
	}
}

func response(code int, data string) {
	var ret = make(map[string]string)
	ret["code"] = code
	ret["msg"] = data
	jsonret, _ := json.Marshal(ret)
	return string(jsonret)
}
