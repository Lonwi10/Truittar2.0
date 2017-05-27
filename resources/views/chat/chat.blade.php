@extends('main')

@section('title', '| Homepage')

@section('content')
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Chat</title>
	</head>
	<body>
		<div  class="container-fluid">
						
				<div class="row">				
					<h1 class="text-center">Chat</h1>	
					<hr>
				</div>	
				<div class="row">
				<form id="" role="form">
					<div class="col-md-3">
						@foreach ($users as $user)
                        <div class="barraDerecha">
                            <div class="author-info">
                              @if (file_exists(public_path('images/'.$user->username .'.jpg')))
                                  <img src="{{asset('images/' . $user->username.'.jpg')}}" height="50" width="50" class="author-name">
                              @else
                                  <img src="{{asset('images/' . 'guest.jpg')}}" height="50" width="50" class="author-name">
                              @endif
                              <div class="author-name">
                                <a class="target" data-user="{{$user->name}}" href="#">{{$user->name}}</a>
                              </div>
                            </div>
                        </div>
             			@endforeach
					</div>
					</form>
					<div class="col-md-9">
						<form id="formChat" role="form">
							<div class="form-group">
								<label for="user">Objetivo:</label>
								<input type="text" class="form-control" id="target" name="target"  value="" readonly>
							</div>
					
							<div class="form-group">
								<label for="user">Yo:</label>
								<input type="text" class="form-control" id="user" name="user"  value="{{Auth::user()->name}}" readonly>
							</div>
							<div class="form-group">							
								<div class="row">
									<div class="col-md-12" >
										<div id="conversation" style="height:200px; border: 1px solid #CCCCCC; padding: 12px;  border-radius: 5px; overflow-x: hidden;">
											
										</div>
									</div>
								</div>
							
							<div class="form-group">				
								<label for="message">Mensaje</label>
								<textarea id="message" name="message" placeholder="Introduce mensaje"  class="form-control" rows="3"></textarea>
							</div>
							<button id="send" class="btn btn-primary" >Enviar</button>						
						</form>
					</div>

				</div>
			</section>	
		</div>

		<script>
		
			$(document).on("ready", function(){				
				registerMessages();
				$.ajaxSetup({"cache":false});
				setInterval("loadOlMessages()", 1500);

				$(".target").click(function(){
					$("#formChat input[name=target]").val($(this).data("user"));
				});
			});

			var registerMessages = function(){
				$("#send").on("click", function(e){
					e.preventDefault();
					var frm = $("#formChat").serialize();
					$.ajax({
						type: "POST",
						url: "/ChatJs/register.php",
						data: frm
					}).done(function(info){
						$("#message").val("");
						var altura = $("#conversation").prop("scrollHeight");
						$("#conversation").scrollTop(altura);
						console.log(info);
					})
				});
			}
			var loadOlMessages = function(){
				var frm = $("#formChat").serialize();
				$.ajax({
					type: "POST",
					url: "/ChatJs/conversation.php",
					data: frm
				}).done(function(info){
					console.log(info);
					$("#conversation").html( info );
					$("#conversation p:last-child").css({"background-color":"lightgreen",
																			"padding-botton":"20px"});
					var altura = $("#conversation").prop("scrollHeight");
					$("#conversation").scrollTop(altura);
				})
			}
		</script>
	</body>
</html>
@endsection