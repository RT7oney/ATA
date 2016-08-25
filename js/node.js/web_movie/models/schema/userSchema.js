var mongoose = require('mongoose')
var bcrypt = require('bcrypt')

var UserSchema = new mongoose.Schema({
    name: {
        unique: true,
        type: String,
    },
    password: String,
    meta: {
        createAt: {
            type: Date,
            default: Date.now()
        },
        updateAt: {
            type: Date,
            default: Date.now()
        }
    },
})

UserSchema.pre('save', function(next) {
    if (this.isNew) {
        this.meta.createAt = this.meta.updateAt = Date.now()
    } else {
        this.meta.updateAt = Date.now()
    }
    // 先生成一个随机的盐，然后把这个盐和密码混合后进行加密
    bcrypt.genSalt(10, function(err, salt) {
        if (err) return next(err)
        bcrypt.hash(user.password, salt, function(err, hash) {
            if (err) return next(err)
            user.password = hash
            next()
        })
    })
    next()
})
// 实例方法是具体的对象才能调用的方法
UserSchema.methods = {
	// 用户登录的密码匹配
	comparePassword:function(_password,cb){
		bcrypt.compare(_password,this.password,function(err,isMatch){
			if (err) return cn(err)
			cb(null,isMatch)
		})
	}
}
// 静态方法是模型就可以调用的方法
UserSchema.statics = {
    // console.log(this)
    fetch: function(cb) {
        console.log(this)
        return this
            .find({})
            .sort('meta.updateAt')
            .exec(cb)
    },
    findById: function(id, cb) {
        return this
            .findOne({ _id: id })
            .exec(cb)
    }
}

module.exports = UserSchema
