package main

import (
	"fmt"
	// "sort"
)

/***********************接口******************************/
// type USB interface {
// 	Name() string //string是返回类型
// 	Connect()
// }

// type PhoneConnecter struct {
// 	name string
// }

/********************************************************/
/***********************并发******************************/
var c chan string

/********************************************************/

// type A struct {
// 	name string
// }

// type B struct {
// 	name string
// }

// type human struct {
// 	sex int
// }

// type teacher struct {
// 	human
// 	name string
// 	age  int
// }

// type student struct {
// 	human
// 	name string
// 	age  int
// }

func main() {
	/**
	 * map的使用方法
	 */
	// var m map[int]map[int]string
	// m = make(map[int]map[int]string) //这一段代码首先要初始化最外层的map
	// a, ok := m[2][1]                 //判断第二层的map是否已经被初始化
	// if !ok {
	// 	m[2] = make(map[int]string)
	// }
	// m[2][1] = "GOOD"
	// a, ok = m[2][1]
	// fmt.Println(a, ok)
	/**
	 * for 循环
	 */
	// sm := make([]map[int]string, 5)
	// for _, v := range sm {
	// 	v = make(map[int]string, 1)
	// 	v[1] = "ok"
	// 	fmt.Println(v)
	// }
	// fmt.Println(sm)
	/**
	 * ex
	 */
	// m := map[int]string{1: "I", 2: "am", 3: "a", 4: "Killer", 5: "!!"}
	// // s := []int{}//不能这样写，要用make初始化
	// s := make([]int, 5)
	// i := 0
	// for k, _ := range m {
	// 	s[i] = k
	// 	i++
	// }
	// sort.Ints(s)
	// fmt.Println(s)
	/**
	 * 课堂作业
	 */
	// m1 := map[int]string{1: "a", 2: "b", 3: "c"}
	// s := make([]int)
	// m2 := make(map[string]int)
	// for k, v := range m1 {
	// 	m2[v] = k
	// }
	// fmt.Println(m2)
	// 闭包函数的作用是返回一个匿名函数
	//defer
	// fmt.Println("a")
	// defer fmt.Println("b")
	// defer fmt.Println("c")
	// for i := 0; i < 3; i++ {
	// 	defer fmt.Println(i) //这里是传参
	// } // 打印出来的是 2 1 0
	// for i := 0; i < 3; i++ {
	// 	defer func() {
	// 		fmt.Println(i) //这里是传地址，进行值拷贝的引用
	// 	}()
	// }
	/**
	 * go 语言异常处理机制
	 */
	// A()
	// B()
	// C()

	/**
	 * 课堂作业
	 */
	// var fs = [4]func(){}

	// for i := 0; i < 4; i++ {
	// 	defer fmt.Println("defer i = ", i) //这里遵循值拷贝
	// 	defer func() { fmt.Println("defer closure i = ", i) }()
	// 	fs[i] = func() { fmt.Println("closure i = ", i) } //这里的i并没有哪里去定义出来，所以是从外层函数中夺过来的，这就夺到了一个引用地址，就是外层for 循环的i的引用地址，所以在for循环执行的最后i已经等于4了，闭包函数的作用是最后返回一个匿名函数
	// }

	// for _, f := range fs {
	// 	f()
	// }
	/**
	 * go语言结构体
	 */
	// a := person{
	// 	name: "joe",
	// 	age:  19,
	// }
	// b := &person{
	// 	name: "gosheng",
	// 	age:  33,
	// } //推荐在对结构体初始化的时候采用“取地址符号”
	// fmt.Println(b)
	// // A(b) //引用传递，值拷贝
	// B(&a) //指针传递
	// fmt.Println(b)
	// a := student{name: "学生", age: 18, human: human{sex: 1}}
	// b := teacher{name: "老师", age: 33, human: human{sex: 2}}
	// a.sex = 200
	// b.human.sex = 100
	// fmt.Println(a, b)
	/**********************方法*******************************/
	// a := A{}
	// a.my_print()

	// b := B{}
	// b.my_print()
	/********************************************************/
	/**********************接口*******************************/
	// var a USB
	// a = PhoneConnecter{"PhoneConnecter"}
	// a.Connect()
	// Disconnect(a)
	/********************************************************/
	/**********************并发*******************************/
	/**
	 * go语言的一个小例子
	 */
	/****************************************/
	// c := make(chan bool)
	// go func() {
	// 	fmt.Println("Go Go Go!!!")
	// 	c <- true
	// }()
	// <-c //当main函数执行到这里的时候，一开始没有值，就会发生堵塞，然后会并发执行func里面的内容，在func里面的程序执行完成之后，最后会给c里面赋值，然后就会在最后结main函数
	/**
	 * 利用for range和close来控制goroutine
	 */
	c := make(chan bool)
	go func() {
		fmt.Println("Go Go Go!!!")
		c <- true
		close(c)
	}()
	for v := range c {
		fmt.Println(v)
	}
	/****************************************/
	c = make(chan string)
	go Pingpong()
	for i := 0; i < 10; i++ {
		// c <- i
		c <- fmt.Sprintf("From main: Hello,#%d", i)
		fmt.Println(<-c)
	}
	/********************************************************/

}

// func A(per person) {
// 	per.age = 13
// 	fmt.Println("A", per)
// }
// func B(per *person) {
// 	per.age = 13
// 	fmt.Println("B", per)
// }

// func A() {
// 	fmt.Println("Func A")
// }

// func B() {
// 	// panic("there is a panic in B()")//当使用recover的时候我们需要把panic放在后面执行
// 	defer func() {
// 		// if (err := recover() && err != nil){
// 		// 	fmt.Println("Recover in B")
// 		// }// 不能这么写
// 		if err := recover(); err != nil {
// 			fmt.Println("recover in B")
// 		}
// 	}()
// 	panic("there is a panic in B()")
// }

// func C() {
// 	fmt.Println("Func C")
// }
//
/**********************方法*******************************/
// func (a A) my_print() {
// 	fmt.Println("A")
// }

// func (b B) my_print() { //绑定的类型是不一样的上面是A类型，后面是B类性
// 	fmt.Println("B")
// }

/********************************************************/
/**********************接口*******************************/
// func (pc PhoneConnecter) Name() string {
// 	return pc.name
// }
// func (pc PhoneConnecter) Connect() {
// 	fmt.Println("Connected:", pc.name)
// }
// func Disconnect(usb USB) {
// 	if pc, ok := usb.(PhoneConnecter); ok { //usb.(PhoneConnecter)进行一个类型判断
// 		fmt.Println("Disconnected:", pc.name)
// 		return
// 	}
// 	fmt.Println("Unknown device.")
// }

/********************************************************/

/**********************并发*******************************/
func Pingpong() {
	i := 0
	for {
		fmt.Println(<-c)
		// c <- i
		c <- fmt.Sprintf("From Pingpong: Hi,#%d", i)
		i++
	}
}

/********************************************************/

/*************************一个坑**************************/
// package main//slice的使用

// import(
// 	"fmt"
// )

// func Pingpong(s []int) []int {
// 	s = append(s,3)
// 	return s
// }

// func main() {
// 	s:=make([]int,0)
// 	fmt.Println(s)
// 	s = Pingpong(s)
// 	fmt.Println(s)
// }
/********************************************************/
