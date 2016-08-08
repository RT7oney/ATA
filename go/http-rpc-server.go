package main

import (
	"errors"
	"fmt"
	"net"
	"net/http" //如果是tcp则不用
	"net/rpc"
	"os"
)

//作为rpc函数调用的要求，作为一个服务要有一个类型（可以是任意类型，只是一个封装而已），有了一个类型一定要有一个方法（方法就是rpc的服务，里面有固定的签名）

type Args struct {
	A, B int
}

type Math int

func (m *Math) Multiply(args *Args, reply *int) error { // 在multiply方法中，前面的那个args参数是我们要接受的参数，后面的reply是需要在客户端的返回结果，而后面的error才是真正的这个函数方法的返回值
	*reply = args.A * args.B
	return nil
}

type Quotient struct {
	Quo, Rem int
}

func (m *Math) Divide(args *Args, reply *Quotient) error {
	if args.B == 0 {
		return errors.New("can't divide by 0 !!")
	}
	reply.Quo = args.A / args.B
	reply.Rem = args.A % args.B
	return nil
}

func main() {
	math := new(Math)
	rpc.Register(math) //把math对象注册进去
	/*************http*****************/
	// rpc.HandleHTTP()

	// err := http.ListenAndServe(":1234", nil)
	// if err != nil {
	// 	fmt.Println(err.Error())
	// }
	/*************tcp*****************/
	tcpAddr, err := net.ResolveTCPAddr("tpc", ":1234")
	if err != nil {
		fmt.Println("Fatal error:", err)
		os.Exit(2)
	}
	Listener, err := net.ListenTCP("tcp", tcpAddr)
	if err != nil {
		fmt.Println("Fatal error:", err)
		os.Exit(2)
	}
	for {
		conn, err := listener.Accept()
		if err != nil {
			fmt.Println("conn error:", err)
			continue
		}
		rpc.ServeConn(conn)
	}
}
