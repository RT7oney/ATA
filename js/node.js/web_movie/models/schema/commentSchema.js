var mongoose = require('mongoose')
    // var bcrypt = require('bcrypt')
var Schema = mongoose.Schema
var ObjId = Schema.Types.ObjectId // 这里用到了objectId作为字段类型，也是为了实现关联文档的查询，我们希望评论的数据结构简单一点
    //
    // ObjectId在mongoDB里面是一个特殊而重要的类型，每一个schema都会默认配置这样一个属性，属性名就是_id，除非自己定义，你才可以覆盖它，同时索引也是默认用主键来索引的，所以要在mongoDB这种非关系型数据库中（是没有join特性的）实现关联查询，所以mongoose封装了一个population的功能，也就是当你在定义schema的时候，可以指定某一个字段是引用另一个schema，那么你在获取document的时候，可以通过popular方法，让mongoose通过引用schema和id找到关联的那个文档，然后用这个文档的内容去替换掉原来文档的内容
    // 可以用在文档上，模型上，query对象上，在不同对象上参数也不太一样，都接受option的参数，path,用空格分隔的引用字段的名称，select就是填充引用document的哪些字段，match是指定查询的一些附加条件，model指定引用的model，option就包括排序等等
    // 在mongoose的引用类型中，推荐使用objectId 
var CommentSchema = new mongoose.Schema({
    movie: { type: ObjId, ref: 'Movie' /*指向MOVIE的模型*/ },
    from: { type: ObjId, ref: 'User' /*指向MOVIE的模型*/ },
    reply: [{
        from: { type: ObjectId, ref: 'User' },
        to: { type: ObjectId, ref: 'User' },
        content: String,
    }],
    to: { type: ObjId, ref: 'User' /*指向MOVIE的模型*/ },
    content: String,
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

CommentSchema.pre('save', function(next) {
        if (this.isNew) {
            this.meta.createAt = this.meta.updateAt = Date.now()
        } else {
            this.meta.updateAt = Date.now()
        }
        // 先生成一个随机的盐，然后把这个盐和密码混合后进行加密
        bcrypt.genSalt(10, function(err, salt) {
            if (err) return next(err)
            bcrypt.hash(Comment.password, salt, function(err, hash) {
                if (err) return next(err)
                Comment.password = hash
                next()
            })
        })
        next()
    })
    // 实例方法是具体的对象才能调用的方法
CommentSchema.methods = {
        // 用户登录的密码匹配
        comparePassword: function(_password, cb) {
            bcrypt.compare(_password, this.password, function(err, isMatch) {
                if (err) return cn(err)
                cb(null, isMatch)
            })
        }
    }
    // 静态方法是模型就可以调用的方法
CommentSchema.statics = {
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

module.exports = CommentSchema
