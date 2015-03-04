var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var socket_info = [];
var disc_sess_id ;
var disc_room;
var granted = [];

io.on('connection', function(socket){
  
socket.on('access_request', function(msg){

if(Object.keys(io.nsps['/'].adapter.rooms[msg.room]).le                                                                                                                                                                                                                                                                                                                                                                      ngth == 1)
{
io.to(socket.id).emit('access_reply','granted');
granted.push(socket.id);
//console.log(granted);
}
else{

io.to(socket.id).emit('access_reply','denied');
}    
 
   });
  
 socket.on('join_room', function (h) {
    socket.join(h.room);

//update the array

socket_info.push([socket.id,h.userid,h.room]);
//console.log(socket_info[socket_info.length-1]);
    });  


socket.on('disconnect', function () {
 // console.log("disc socket_id: "+ socket.id);
//take disconnected socket's info and splice it from array

for(i=0; i<socket_info.length; i++){
if( socket_info[i][0] == socket.id){

disc_sess_id = socket_info[i][1];
disc_room = socket_info[i][2];

socket_info.splice(i,1);
//console.log("array_length:"+ socket_info.length);

break;
}
}

//console.log("room of delete"+ disc_room);


var socket_self;
var socket_new;
var x;

var ind = socket.id;
var indd = granted.indexOf(ind);
//console.log("nos :" + indd);

if(indd != -1){

granted.splice(indd,1);


for(i=0; i<socket_info.length; i++){

if(socket_info[i][2] == disc_room){

    if(socket_info[i][1] == disc_sess_id ){
//	console.log("is present");
	x = 1;
        socket_self = socket_info[i][0];
	break;
     } 

     else{
	x = 0;
	socket_new = socket_info[i][0];
     }  
}

}

if(x == 1){
		io.to(socket_self).emit('reassign_access',"access");
		granted.push(socket_self);
	//	console.log(socket_self);

}
else if(x == 0){
               io.to(socket_new).emit('reassign_access',"access");
		granted.push(socket_new);
}

 }   

});
    
});
  

http.listen(3000, function(){
 // console.log('listening on *:3000');
});
