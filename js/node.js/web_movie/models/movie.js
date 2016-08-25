var mongoose = require('mongoose')
var MovieSchema = require('./schema/movieSchema')
var Movie = mongoose.model('Movie', MovieSchema)

module.exports = Movie