var mongoose = require('mongoose')
var CommentSchema = require('./schema/commentSchema')
var Comment = mongoose.model('Comment', CommentSchema)

module.exports = Comment