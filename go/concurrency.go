// package main

// import (
// 	"fmt"
// 	// "runtime"
// )

// func main() {
// 	c := make(chan bool)
// 	for i := 0; i < 10; i++ {
// 		go Go(c, i)
// 	}
// 	<-c
// }

// func Go(c chan bool, index int) {
// 	a := 1
// 	for i := 0; i < 10000000; i++ {
// 		a += i
// 	}
// 	fmt.Println(index, a)
// 	if index == 9 {
// 		c <- true
// 	}
// }

//以上程序的执行结果会一直按照顺序来执行，这并不能体现出goroutine的优势
//所以我们这么修改
// package main

// import (
// 	"fmt"
// 	"runtime"
// )

// func main() {
// 	runtime.GOMAXPROCS(runtime.NumCPU()) //当把cpu变成多核的时候，有些就会没有执行完，main函数会退出，使用缓存的方法来解决问题
// 	c := make(chan bool, 10)
// 	for i := 0; i < 10; i++ {
// 		go Go(c, i)
// 	}
// 	for i := 0; i < 10; i++ {
// 		<-c
// 	}
// }

// func Go(c chan bool, index int) {
// 	a := 1
// 	for i := 0; i < 10000000; i++ {
// 		a += i
// 	}
// 	fmt.Println(index, a)
// 	c <- true
// }

//当然另外一种解决方案是我们可以通过一种等待组的方法来解决
//通过同步包来实现
package main

import (
	"fmt"
	"runtime"
	"sync"
)

func main() {
	runtime.GOMAXPROCS(runtime.NumCPU()) //当把cpu变成多核的时候，有些就会没有执行完，main函数会退出，使用缓存的方法来解决问题
	wg := sync.WaitGroup{}
	wg.Add(10)
	// c := make(chan bool, 10)
	for i := 0; i < 10; i++ {
		go Go(&wg, i)
	}
	wg.Wait()
}

func Go(wg *sync.WaitGroup, index int) {
	a := 1
	for i := 0; i < 10000000; i++ {
		a += i
	}
	fmt.Println(index, a)
	wg.Done()
}

//
