/*************************以类型的形式*******************************/
// package main

// //一个只接受8080请求的中间件，在安全策略中使用
// import (
// 	"net/http"
// )

// type SingleHost struct {
// 	handler     http.Handler
// 	allowedHost string
// }

// func (this *SingleHost) ServerHTTP(w http.ResponseWriter, r *http.Request) {
// 	if r.Host == this.allowedHost {
// 		this.handler.ServeHTTP(w, r)
// 	} else {
// 		w.WriteHeader(403)
// 	}
// }

// func myHandler(w http.ResponseWriter, r *http.Request) {
// 	w.Write([]byte("hello world"))
// }

// func main() {
// 	single := &SingleHost{
// 		handler:     http.HandlerFunc(myHandler),
// 		allowedHost: "example.com",
// 	}
// 	http.ListenAndServe(":8080", SingleHost)
// }

/*************************以闭包的形式*******************************/

// package main

// import (
// 	"net/http"
// )

// func SingleHost(handler http.Handler, allowedHost string) http.Handler {
// 	fn := func(w http.ResponseWriter, r *http.Request) {
// 		println(r.Host)
// 		if r.Host == allowedHost {
// 			handler.ServeHTTP(w, r)
// 		} else {
// 			w.WriteHeader(403)
// 		}
// 	}
// 	return http.HandlerFunc(fn)
// } //中间件

// func myHandler(w http.ResponseWriter, r *http.Request) {
// 	w.Write([]byte("hello world\n")) //这个在客户端可以显示
// 	// println("hello world")         //这个在服务器端可以显示
// } //非中间件，正常响应的流程

// func main() {
// 	single := SingleHost(http.HandlerFunc(myHandler), "localhost:8080")
// 	http.ListenAndServe(":8080", single)
// }
//

/*************************追加响应的内容*******************************/
// package main

// import (
// 	"net/http"
// )

// type AppendMiddleware struct {
// 	handler http.Handler //嵌入
// } //实现一个类型

// //为类型实现一个http方法
// func (this *AppendMiddleware) ServerHTTP() {
// 	//首先进行一个默认的响应
// 	this.handler.ServeHTTP(w, r)            //正常的响应结束
// 	w.Write([]byte("this is middleware\n")) // 然后告诉客户端这里进行了中间件处理
// }

// //实现一个myHandler进行一个正常响应的需求
// func myHandler(w http.ResponseWriter, r *http.Request) {
// 	w.Write([]byte("hello world\n"))
// }

// func main() {
// 	mid := &AppendMiddleware{http.HandlerFunc(myHandler)} //表示在执行myHandler之前放入一个中间件
// 	http.ListenAndServe(":8080", mid)
// }

/*************************自定义响应的中间件*******************************/
package main

import (
	"net/http"
	"net/http/httptest"
)

type ModifierMiddleware struct {
	handler http.Handler //实现了这个接口的字段
}

func (this *ModifierMiddleware) ServerHTTP() {
	rec := httptest.NewRecorder()  //新建一个recorder
	this.handler.ServeHTTP(rec, r) //先获得正常的http请求，所以需要调用真正的serverhttp的方法，传入一个recorder，把所有的情况都记录下来，最后一并返回给客户端

	for k, v := range rec.Header() {
		//然后做一个迭代操作，这个recorder当中的handler，用户的真正的这个serverhttp方法中的可能对handler有一系列的操作，我们需要全部把他们捕捉到，然后再设置到真正的响应流当中
		w.Header()[k] = v
	}

	w.Header().Set("goooooo", "vip") //对header的自定义的操作，如果不用recorder，那么header都是已经全部提交出去的，只有在这种情况下在可以自定义请求头
	w.WriteHeader(418)
	w.Write([]byte("mmmmdddddiwaredddd"))
	w.Write(rec.Body.Bytes()) //最后有一个非常关键的一步骤，我们在调用底层的handler的servehttp方法的时候呢，我们是将所有的结果都存在recorder里面
}

func myHandler(w http.ResponseWriter, r *http.Request) {
	w.Write([]byte("hello world"))
}

func main() {
	mid := &ModifierMiddleware{http.HandlerFunc(myHandler)}
	http.ListenAndServe(":8080", mid)
}
