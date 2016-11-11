
# MeNA-API
AshToArt
***
### 2016.08.31：
* 请求接口的流程：
>1.开发者先注册（填写有效的身份证号码和手机号），然后系统返回给他一个api_token(这个时候通过组件返回给接口用户的api_token(aka:the_id)和用户的dev_name，通过这两个参数去生成一个app_key)
> 
> 2.开发者拿着apitoken去请求/dev/get-app-key然后获取appkey
> 
> 3.开发者需要使用appkey+timestamp字符串拼接之后的md5值作为sign
> 
> 4.开发者在请求接口的时候需要带上系统级参数api_token和timestamp和sign
>
> 5.接口处理开发者的请求，使用开发者传上来的api_token去寻找用户的app_key判断是否过期，然后通过开发者的timestamp和查询到的app_key去计算开发者的签名是否合法



### 2016.09.01:
#### <font color=red>todo:</font>
* 如果在将数据通过json.Unmarshal([]byte,&m)这里的&m使用空接口的形式，这个时候应该怎么处理

#### <font color=green>done:</font>
* movieMod.go
* movidCtr.go
* DevCtr.go
* <font color=red>go语言的结构体的字段首字母一定要大写</font>
<!-- lang:go -->
			type Msg struct {
				Code string
				Msg  string
				Data map[string]string
			}
			var m Msg
			err := json.Unmarshal([]byte(res["msg"]), &m)
			if err != nil {
				fmt.Println("===错误===")
				fmt.Println(err)
				msg = common.Response(501, "服务器内部错误")
			} else {
				// fmt.Println("===json 解析===")
				t := reflect.TypeOf(m.Data)
				// v := reflect.ValueOf(m.Data)
				// fmt.Println(m)
				// fmt.Println(m.Code)
				// switch m.Data.(type) {
				// case string:
				// 	fmt.Println("yeah")
				// default:
				// 	fmt.Println("······")
				// }
				fmt.Println("===类型===")
				fmt.Println(t)
				fmt.Println("===值===")
				fmt.Println(m.Data)

				//
				// for i := 0; i < t.NumField(); i++ {
				// 	f := t.Field(i)
				// 	val := v.Field(i).Interface()
				// 	fmt.Println(f)
				// 	fmt.Println(val)
				// }
				//

				//
				// switch v := m.(type) {
				// default:
				// 	fmt.Println("===switch===")
				// 	fmt.Println(reflect.TypeOf(v))
				// } // 接口的类型选择
			
			}
* 首先 我们来看一下这个json 字串
<!---->

	{
   		 "resp": {
        	"respCode": "000000",
       		 "respMsg": "成功",
       		 "app": {
           		 "appId": "d12abd3da59d47e6bf13893ec43730b8"
        		}
    		}
	}
go 内置了json字串的解析包 "encoding/json"

接下来 就需要对结构体的定义了。

按照json库的分析，其实每一个花括号就是一个结构体

那么拆解的结构体如下：

	//代表最里层的结构体
	type appInfo struct {
    	Appid string `json:"appId"`
	}

	//代表第二层的结构体
	type response struct {
    	RespCode string  `json:"respCode"`
    	RespMsg  string  `json:"respMsg"`
    	AppInfo  appInfo `json:"app"`
	}

	type JsonResult struct {
    	Resp response `json:"resp"`   //代表最外层花括号的结构体 
	}
结构体的命名必须遵循第一个字母大写，否则json库会忽略掉该成员，

而后面的json:“xxx” xxx则需要和json字串里的名字相符合： 如最外层的 json:"**resp**" 和json字符串里的｛“resp”一致

然后实际的代码解析如下

	package main
	import (
    	"fmt"
        "encoding/json"
	)
	type appInfo struct {
   	 	Appid string `json:"appId"`
	}
	type response struct {
    	RespCode string  `json:"respCode"`
    	RespMsg  string  `json:"respMsg"`
    	AppInfo  appInfo `json:"app"`
	}
	type JsonResult struct {
    	Resp response `json:"resp"`
	}
	func main() {
    	jsonstr := `{"resp": {"respCode": "000000","respMsg": "成功","app":{"appId": "d12abd3da59d47e6bf13893ec43730b8"}}}`
    	var JsonRes JsonResult 
        json.Unmarshal(body, &JsonRes)
        fmt.Println("after parse", JsonRes)
	}
