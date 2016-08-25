var mongoose = require('mongoose')
var UserSchema = require('./schema/userSchema')
var User = mongoose.model('User', UserSchema)

module.exports = User