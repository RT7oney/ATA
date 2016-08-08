package main

//介绍有关go语言的原生态模板处理方法，以及表单的处理方法
import (
	"fmt"
	"html/template"
	"net/http"
)

func main() {
	http.Handle("/", Hey)
	http.ListenAndServe(":8080", nil)
}

const tpl = `
<html>
	<head>
		<title>Hey</title>
	</head>
	<body>
		<form method="post" action="/">
			Username:<input type="text" name="uname">
			Password:<input type="password" name="pwd">
			<button type="submit">Submit</button>
		</form>
	</body>
</html>
`

func Hey(w http.ResponseWriter, r *http.Request) {
	if r.Method == "GET" {
		t := template.New("hey")
		t.Parse(tpl)
		t.Execute(w, nil)
	} else {
		fmt.Println(r.FormValue("uname"))
	}
}

/**
 *
获取GET参数
网上比较常见的一个版本是：
r.ParseForm()
if len(r.Form["id"]) > 0 {
	fmt.Fprintln(w, r.Form["id"][0])
}
其中r表示*http.Request类型，w表示http.ResponseWriter类型。
r.Form是url.Values字典类型，r.Form["id"]取到的是一个数组类型。因为http.request在解析参数的时候会将同名的参数都放进同一个数组里，所以这里要用[0]获取到第一个。
这种取法在通常情况下都没有问题，但是如果是如下请求则无法取到需要的值：
<form action="http://localhost:9090/?id=1" method="POST">
    <input type="text" name="id" value="2" />
    <input type="submit" value="submit" />
</form>
因为r.Form包含了get和post参数，并且以post参数为先，上例post参数和get参数都有id，所以应当会取到post参数2。虽然这种情况并不多见，但是从严谨的角度来看程序上还是应当处理这种情况。立马补上改进代码：
queryForm, err := url.ParseQuery(r.URL.RawQuery)
if err == nil && len(queryForm["id"]) > 0 {
	fmt.Fprintln(w, queryForm["id"][0])
}
代码比较简单，就是分析url问号后的参数。事实上这个也是标准库ParseForm中关于get参数解析代码。
获取POST参数
这里要分两种情况：
普通的post表单请求，Content-Type=application/x-www-form-urlencoded
有文件上传的表单，Content-Type=multipart/form-data
第一种情况比较简单，直接用PostFormValue就可以取到了。
fmt.Fprintln(w, r.PostFormValue("id"))
第二种情况复杂一些，如下表单：
<form action="http://localhost:9090" method="POST" enctype="multipart/form-data">
    <input type="text" name="id" value="2" />
    <input type="file" name="pic" />
    <input type="submit" value="submit" />
</form>
因为需要上传文件，所以表单enctype要设置成multipart/form-data。此时无法通过PostFormValue来获取id的值，因为golang库里还未实现这个方法：

	case ct == "multipart/form-data":
		// handled by ParseMultipartForm (which is calling us, or should be)
		//TODO(bradfitz):there are too many possible
		//orders to call too many function here
		//Clean this up and write more tests
		//request_test.go contains the start of this
		//in TestParseMultipartFormOrder and others

golang中不能用PostForm获取post参数

幸好golang中可以提供了另外一个属性MultipartForm来处理这种情况。
r.ParseMultipartForm(32 << 20)
if r.MultipartForm != nil {
	values := r.MultipartForm.Value["id"]
	if len(values) > 0 {
		fmt.Fprintln(w, values[0])
	}
}
感谢：在测试post的时候，一开始都是以第二种情况来测试的，所以造成了一个误区以为PostFormValue无法取到值。这里感谢@九头蛇龙 的纠正。
获取COOKIE参数
cookie, err := r.Cookie("id")
if err == nil {
	fmt.Fprintln(w, "Domain:", cookie.Domain)
	fmt.Fprintln(w, "Expires:", cookie.Expires)
	fmt.Fprintln(w, "Name:", cookie.Name)
	fmt.Fprintln(w, "Value:", cookie.Value)
}
r.Cookie返回*http.Cookie类型，可以获取到domain、过期时间、值等数据。
小结
在折腾的过程中看了下net/http包中的源码，感觉在web开发中还是有很多不完善的地方。作为使用者来讲，最希望就是直接通过一个方法取到相应的值就可以了，期待官方团队尽早完善。
*/
