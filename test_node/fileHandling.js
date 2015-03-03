var mysql = require('mysql');
connection = mysql.createConnection({
	host: "localhost",
	user:"root",
	database: "project",
	multipleStatements: true

});
var request = require('request');
var fs = require('fs');



exports.getFile = function (req, res) {

	console.log("Getting File");
	var shareId = req.param('shareid');

	var temp ="";

	request.get('https://s3-ap-southeast-1.amazonaws.com/docs-test/input.html', function(err, response, body){
		if(err) {
			console.log(err);
			res.send("err");
		} else if(response.statusCode == 200) {
			console.log(body);
			res.send(body);
		}

	});




	// fs.readFile('/var/www/local_documendz/uploaded/jhg76140kd84/input.html', function(err, data) {
	// 	if(err) {
	// 		console.log(err);
	// 		res.send("error");
	// 	} else {
	// 		console.log(data);
			
	// 	}
	// });

};