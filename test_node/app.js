"use strict";

var fs = require('fs');
 
var ssl_options = {
  key: fs.readFileSync('/etc/ssl/crt/documendz.key'),
  cert: fs.readFileSync('/etc/ssl/crt/primary.crt'),
  ca: [fs.readFileSync('/etc/ssl/crt/intermediate.crt')]
  
};


var express = require('express'),
    app = express(),
    server = require('https').createServer(ssl_options,app),
    io = require('socket.io').listen(server),
    format = require('util').format,
    fileHandling = require('./fileHandling.js'),
    // globalDb = "",
    dbQueries = require('./databaseQueries.js');
    server.listen(9000);

var cookieParser = require('socket.io-cookie');

var userMap = {};

app.get('/', function(req, res) {
    res.sendFile(__dirname + "/index.html");
});


//nspIndex = io.of("/index");
//io.use(cookieParser);
//io.use(function(socket, next){
//   console.log("Session ID",socket.request.headers.cookie.PHPSESSID);   
//   userMap[socket.request.headers.cookie.PHPSESSID] = {};
//   next();
//});
//New socket Connection
//nspIndex.on('connection', newUserSocket);

// app.use(function(req,res,next) {
// //res.send("Not auth");
// // res.end();

// // res.header("Ace")
// next();
// });

app.use(function(req, res, next) {

    // Website you wish to allow to connect
    res.setHeader('Access-Control-Allow-Origin', '*');

    // Request methods you wish to allow
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

    // Request headers you wish to allow
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type');

    // Set to true if you need the website to include cookies in the requests sent
    // to the API (e.g. in case you use sessions)
    res.setHeader('Access-Control-Allow-Credentials', true);

    next();
});


app.get('/pulldata/annotationdata/:shareid', dbQueries.pullAnnotationData);
app.get('/pulldata/historydata/:shareid', dbQueries.pullHistoryData);
app.get('/getfile/:shareid', fileHandling.getFile);


io.on('connection', newUserSocket);
// new user socket funtion on socket connection
function newUserSocket(socket) {
    console.log("connected");
    socket.on("joined", function() {
        console.log("New conncted");
    });

    //get user id and share id
    socket.on("documentInfo", getDocumentInfo);
    socket.on("disconnect", clientDisconnected);
    socket.on("sendChangeData", sendChangeData);
}

function sendChangeData(data) {
    // console.log(data);
    //console.log(this.documentInfo);
    data.data.userName = this.documentInfo.userName;
    // console.log(data);
    this.to(this.documentInfo.shareId).emit("getChangeData", data);

    try {
        
    dbQueries.fireQuery(data.data, data.type, this.documentInfo.userId, this.documentInfo.shareId);
}
catch(e) {

console.log(e);

}
}

function getDocumentInfo(data) {

    console.log(data);  
    // console.log(this.id);
    //check if the user is alrealy on server
    if (!(data.userId in userMap)) {

        userMap[data.userId] = {};

        console.log("New User Connected: " + data.userId + " Creating User map" + " Share Id :" + data.shareId);

        userMap[data.userId][this.id] = {
            shareId: data.shareId
        };


    } else {

        console.log("Adding New User Socket to User Map" + data.userId + " Share Id " + data.shareId);
        userMap[data.userId][this.id] = {
            shareId: data.shareId
        };

    }

    this.documentInfo = {
        userId: data.userId,
        shareId: data.shareId,
        userName: data.name
    };


    this.join(data.shareId, userRoomJoined(this.documentInfo.shareId));
    //socket_id = this.id;
    //console.log(userMap);
    //Number of sockets present of current user
    console.log("Number of sockets present of current user : " + Object.keys(userMap[this.documentInfo.userId]).length);
    //console.log(userMap[data.userId]);

    dbQueries.checkDocumentExist(data.shareId);

}




function userRoomJoined(data) {

    console.log("New User joined room : " + data);

}

function clientDisconnected() {

    if (Object.keys(userMap[this.documentInfo.userId]).length === 1) {
        // if one or more tabs are open do not delete the user

        console.log("Deleting Whole User : " + this.documentInfo.userId);
        delete userMap[this.documentInfo.userId];
        console.log(userMap);
    } else {
        // if not more then one tab was open delete the user from the list

        console.log("Deleting Socket of User : " + this.documentInfo.userId);
        delete userMap[this.documentInfo.userId][this.id];
        console.log(userMap);
    }

    // console.log("Current User Map : " + userMap);

}