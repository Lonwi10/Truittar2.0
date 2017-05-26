@extends('main')

@section('title', '| Homepage')

@section('content')
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Chat</title>
		<style type="text/css">
  			li { color: #FF0000; padding-left:0px; }
		</style>
	</head>
	<body>
		<div  class="container-fluid">
						
				<div class="row">				
					<h1 class="text-center">Chat: <small>Publico(de momento)</small></h1>	
					<hr>
				</div>	
				<div class="row">
					<div class="col-md-3">
						<ul id="usuarios">
	  				
						</ul>
					</div>
					<div class="col-md-9">
						<form id="formChat" role="form">
							<div class="form-group">
								<label for="user">Usuario</label>

								<input type="text" class="form-control" id="user" name="user"  value="{{Auth::user()->username}}" readonly>
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
				setInterval("cargarUsuarios()", 1500);
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
				$.ajax({
					type: "POST",
					url: "/ChatJs/conversation.php",
				}).done(function(info){
					console.log(info);
					$("#conversation").html( info );
					$("#conversation p:last-child").css({"background-color":"lightgreen",
																			"padding-botton":"20px"});
					var altura = $("#conversation").prop("scrollHeight");
					$("#conversation").scrollTop(altura);
				})
			}
			var cargarUsuarios = function(){
				$.ajax({
					type: "POST",
					url: "/ChatJs/leerContactos.php",
				}).done(function(info){
					console.log(info);
					$("#usuarios").html( info );
			
				})
			}
		</script>
	</body>
</html>
@endsection