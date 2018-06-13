@extends('layouts.master')


@section('content')

<style>
p {
	white-space: pre;
}
</style>

<p id="power1">0</p>
<p id="power2">0</p>
<p id="power3">0</p>
<p id="power4">0</p>

@stop


@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>

<script>

var socket = io('http://localhost:3000');

socket.on("test-channel:App\\Events\\EventName", function(data){
    console.log(data);
    $('#power1').text(parseInt($('#power1').text()) + parseInt(data.power));
});

socket.on("test-channel:App\\Events\\Event", function(data){
    console.log(data);
    $('#power2').text(parseInt($('#power2').text()) + parseInt(data.power));
});

socket.on("test-channel:UserSignedUp", function(data){
    console.log(data);
    $('#power3').text(parseInt($('#power3').text()) + parseInt(data.power));
});

socket.on("chatroom:1", function(data){
    console.log(data);
    $('#power4').text( $('#power4').text() + "\n" + data.message );
});

</script>

<form id="chatInputForm" action="/savemessage" method="post">
{{ csrf_field() }}
<input type="text" name="message">
<input type="submit">
</form>


<script type="text/javascript">
var frm = $('#chatInputForm');

frm.submit(function (e) {

    e.preventDefault();

    $.ajax({
        type: frm.attr('method'),
        url: frm.attr('action'),
        data: frm.serialize(),
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });
});
</script>


@stop

