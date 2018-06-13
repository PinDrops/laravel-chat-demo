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
<?php
$roomId = 1;
?>
<script>

var roomId = <?=$roomId;?>;

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

socket.on("room:" + roomId, function(data){
    console.log(data);
    $('#power4').text( $('#power4').text() + "\n" + data.saved.message );
});

</script>


<form id="chatInputForm" action="/savemessage" method="post">
{{ csrf_field() }}
<input type="hidden" name="room_id" value="<?=$roomId;?>">
<input type="text" name="message">
<input type="submit">
</form>


<script type="text/javascript">

var chatForm     = $('#chatInputForm');
var messageInput = $( chatForm ).find("input[name=message]");

chatForm.submit(function (e) {

    e.preventDefault();

    $.ajax({
        type: chatForm.attr('method'),
        url: chatForm.attr('action'),
        data: chatForm.serialize(),
        beforeSend: function() {
            messageInput.prop("disabled", true);
      	},
        success: function (data) {
            messageInput.val("");
        },
        error: function (data) {
            // show there was a problem
        },
        complete: function (data) {
            messageInput.prop("disabled", false);
        }
    }).done(function(data){
    });

});
</script>


@stop

