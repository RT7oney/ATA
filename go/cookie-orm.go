package main

import (
	"net/http"
)

func main() {
	http.HandleFunc("/", Cookie)
	http.ListenAndServe(":8080", nil)
}

func Cookie(w http.ResponseWriter, r *http.Request) {
	//第一种传统的设置方法
	ck := &http.Cookie{
		Name:   "myCookie",
		Value:  "hello",
		Path:   "/",
		Domain: "localhost",
		MaxAge: 120,
	}
	http.SetCookie(w, ck)
	ck2, err := r.Cookie("myCookie")
}
