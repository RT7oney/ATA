/**
 * Go中虽然没有class，但是依旧有Method
 * 通过显示说明receiver来实现与某个类型的结合
 * 只能为同一个包中的类型定义方法
 * Receiver可以是类型的值或者指针
 * 不存在方法的重载
 * 可以使用值或者指针来调用方法，编译器会自动完成转换
 * 从某种意义上说，方法是函数的语法糖，因为receiver其实就是方法所接受的第一个参数
 * 如果外部结构和嵌入结构存在同名方法，则优先调用外部结构的方法
 * 类型别名不会拥有底层类型所附带的方法
 * 方法可以调用结构中的非公开字段
 */
//注意结构体type A struct{
//	Name 首字母大写表示是可以导出的字段
//	name 首字母小写表示是私有的字段
//}
package main

import (
	"fmt"
)

type A struct {
	Name string
}
type B struct {
	Name string
}

func main() {
	a := &A{} //可以使用这样的方法来调用
	// a := A{}
	a.myPrint()
	// *a.myPrint() //不可以使用这种方法来调用，会出问题
	fmt.Println(a.Name)
	//值类型只是做到了值拷贝，得到一个副本；引用类型传递做到了指针的拷贝，得到内存中的原始值
	b := B{}
	b.myPrint()
	fmt.Println(b.Name)
}

func (a *A) myPrint() {
	a.Name = "a have name now!!!"
	fmt.Println("A method")
}

func (b B) myPrint() {
	b.Name = "b have name now!!!"
	fmt.Println("B method")
}
