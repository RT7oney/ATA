package main

//在客户端因为我们要实现和服务端通信，所以我们两边都需要包含相同的类型
import (
	"fmt"
	"log"
	"net/rpc"
	"os"
)

type Args struct {
	A, B int
}

type Quotient struct {
	Quo, Rem int
}

func main() { //这里面就是一个请求调用rpc的过程
	if len(os.Args) != 2 { //首先通过命令行参数取得远端服务的地址，这个判断就是如果传入的参数不为两个我们就认为他的参数不完整，或者就是我们找不到地址
		fmt.Println("Usage:", os.Args[0], "server") //os.Args[0]第一个元素是程序本身
		os.Exit(1)
	}
	severAddr := os.Args[1]
	//接下来调用rpc服务，首先要获得一个client对象
	//network走tcp因为http也是基于tcp
	client, err := rpc.DialHTTP(network, address)
	if err != nil {
		log.Fatal("dialing error:", err)
	}

	args := Args{17, 8}
	var reply int
	err = client.Call("Math.Multiply", args, &reply)
	if err != nil {
		log.Fatal("Math error:", err)
	}
	fmt.Printf("Math:%d*%d=%d\n", args.A, args.B, reply)

	var quo Quotient
	err = client.Call("Math.Divide", args, &quo)
	if err != nil {
		log.Fatal("Math error:", err)
	}
	fmt.Printf("Math:%d/%d=%d remainder %d\n", args.A, args.B, quo.Quo, quo.Rem)
}
