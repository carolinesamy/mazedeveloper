/**
 * Created by caroline on 04/06/16.
 */

var express=require('./public/node_modules/express');
var app=express();
var server=require('http').createServer(app);
var io= require('./public/node_modules/socket.io').listen(server);
//app.use(express.static(__dirname+'/public'));


io.on('connection', function (socket) {

    console.log('new connection');

    socket.on( 'new_count_notification', function() {
        socket.broadcast.emit( 'new_count_notification');
    });

    socket.on( 'new_count_msg_notification', function() {
        socket.broadcast.emit( 'new_count_msg_notification');
    });

});
server.listen(7000, function() {
    console.log('server up and running at 7000 port');
});