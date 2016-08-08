/**************************版本1*******************************/
// package main

// import (
// 	"io"
// 	"log"
// 	"net/http"
// )

// func main() {
// 	//设置路由的访问规则
// 	http.HandleFunc("/lala", sayHello) //这个handler是定义了一个指定接受什么样的参数的格式，需要把一个函数作为参数传递进去，路由才能注册成功
// 	err := http.ListenAndServe(":8080", nil)
// 	if err != nil {
// 		log.Fatal(err)
// 	}
// }

// func sayHello(w http.ResponseWriter, r *http.Request) { //有一个参数的要求beego是go_http服务器的高层封装

// net/http的包中的
// http.HandleFunc(ResposeWriter,*Request)
// 因为request是一个结构体，我们使用指针拷贝不用浪费其他值拷贝所消耗的资源
// 	io.WriteString(w, "Hellooooooo,ryannanana")
// }

/**************************版本2********************************/
// package main

// import (
// 	"io"
// 	"log"
// 	"net/http"
// )

// func main() {
// 	mux := http.NewServeMux() //使用mux来做一个路由的控制
// 	mux.Handle("/", &myHandler{})
// 	mux.HandleFunc("/hello", sayHello)
// 	err := http.ListenAndServe(":8080", mux)
// 	if err != nil {
// 		log.Fatal(err)
// 	}
// }

// type myHandler struct{}

// func (*myHandler) ServerHTTP(w http.ResponseWriter, r *http.Request) {
// 	io.WriteString(w, "URL:"+r.URL.String())
// }

// func sayHello(w http.ResponseWriter, r *http.Request) { //有一个参数的要求
// 	io.WriteString(w, "Hellooooooo,ryannanana")
// }

/**************************版本3********************************/
// package main

// import (
// 	"io"
// 	"log"
// 	"net/http"
// 	"time"
// )

// var mux map[string]func(http.ResponseWriter, *http.Request)

// func main() {
// 	server := http.Server{
// 		Addr:        ":8080",
// 		Handler:     &myHandler{},
// 		ReadTimeout: 5 * time.Second,
// 	}

// 	mux = make(map[string]func(http.ResponseWriter, *http.Request))
// 	mux["/hello"] = sayHello
// 	mux["/bye"] = sayBye

// 	err := server.ListenAndServer()
// 	if err != nil {
// 		log.Fatal(err)
// 	}
// }

// type myHandler struct{}

// func (*myHandler) ServerHTTP(w http.ResponseWriter, r *http.Request) {
// 	if h, ok := mux[r.URL.String()]; ok {
// 		h(w, r)
// 		return
// 	}

// 	io.WriteString(w, "URL:"+r.URL.String())
// }

// func sayHello(w http.ResponseWriter, r *http.Request) { //有一个参数的要求
// 	io.WriteString(w, "Hellooooooo,ryannanana")
// }

// func sayBye(w http.ResponseWriter, r *http.Request) { //有一个参数的要求
// 	io.WriteString(w, "Byeeeeeeee,ryannanana")
// }
