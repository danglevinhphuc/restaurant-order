var express = require('express');//mat dinh yeu cau module express
var app = express();//mat dinh goi den express
var server = require('http').createServer(app);//mat dinh
var io = require('socket.io').listen(server);//mat dinh goi den thu muc socket.io va lang nghe port cua server la 3000

app.get("/",function(req,res,next){
	res.send("Connecting");
});
server.listen(process.env.PORT ||3000);//mat dinh
console.log("connect");
var notifi = [];
var order = [];
io.sockets.on('connection', function(socket){// goi den connect trong thu muc socket.io thi phan index.html phai co script trong html tuc la tao ket noi
	console.log("Da co nguoi ket noi",socket.id);
	socket.on('disconnect',function(data){
		console.log("Da co roi ket noi",socket.id);
	});
	socket.on('send-thong-bao',function(data){
		//phat 1 su kien tu server den client. 
		//var user_fix = data.username;
		
		//sockets se phat su kien den client vs bien data thong qa new message
		io.sockets.emit('new message',data);
	});
	socket.on('phanhoi-thong-bao',function(data){
		//phat 1 su kien tu server den client. 
		
		//var user_fix = data.username;
		
		//sockets se phat su kien den client vs bien data thong qa new message
		io.sockets.emit('feedback message',data);
	});
	socket.on('send to admin',function(data){
		//phat 1 su kien tu server den client. 
		
		/* GIAI THUAT KIEM TRA DU LIEU TRUNG **/
		if(notifi.length != 0){
			var findInarray =  notifi.indexOf(data.ten_ban);
			
			//console.log(findInarray);
			if(findInarray == -1){
				notifi.push(data.ten_ban);	
			}
		}else{
			notifi.push(data.ten_ban);	
		}
		//sockets se phat su kien den client vs bien data thong qa new message
		io.sockets.emit('feedback to waiter',{notifi: notifi, total:notifi.length });
	});
	socket.on("delete table",function(data){
		// lay gia tri ve va gan bien
		var tenban = data;
		io.sockets.emit('feedback to table light',{tenban});
		notifi.splice(notifi.indexOf(tenban),1);
	});
	// nhan yeu cau lay lai thong tin khi ng dung F5 hoac mat mang 
	// xem lai tren server co du lieu ban can tinh hay da goi k
	socket.on("send require to server get table",function(data){
		if(data){
			io.sockets.emit('feedback to waiter',{notifi: notifi, total:notifi.length });
		}
	});
});