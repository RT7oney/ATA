var mongoose = require('mongoose')
var CatetorySchema = require('./schema/catetorySchema')
var Catetory = mongoose.model('Catetory', CatetorySchema)

module.exports = Catetory