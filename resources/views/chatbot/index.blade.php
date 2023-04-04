@extends('layouts.app')
@section('title', __('home.home'))
@section('content')
<section class="content-header">
    <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
     <br> Negocio #{{ $business_id }}
    </h1>
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Whatsapp</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Campañas</a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>
      
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active text-center" id="home">
            <div id="title"></div>
            <div id="body"></div>
            <div id="footer"></div>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile"></div>

          <div role="tabpanel" class="tab-pane" id="settings">...</div>
        </div>
      
      </div>
</section>


@endsection

@section('javascript')
{{-- <script src="{{ asset('chatbot/qrcode.js') }}"></script> --}}
<script type="text/javascript" src="https://cdn.rawgit.com/KeeeX/qrcodejs/master/qrcode.min.js"></script>
<script>
  
  Echo.channel('home')
    .listen('NewMessage', (e) => {
        // console.log(e.type);
        // console.log(e.busine);
        // console.log(e.message);
        // console.log(e.phone);
  
        if ("{{ $business_id }}" == e.busine) {
          // console.log(e.busine);
          switch (e.type) {
            case "qr":
              $("#title").html("<h2>Escanea el QR para fucionar tu tienda con tu whatsapp</h2><hr />")
              var qrcode = new QRCode(document.getElementById("body"), {
                text: e.message,
                width: 256,
                height: 256,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
              });

              break;
              case "ready":
                // $("#title").html("<h2>Ya estas listo para enviar mensaje</h2><hr />")
                $("#body").html("resisa tu celular")
                // $("#footer").html("<hr />")
              break;
              case "authenticated":
                $("#title").html("<h2>Ya estas listo para recibir mensaje</h2><hr />")
                $("#body").html(e.message)
                $("#footer").html("<hr />")
              break;
              case "loading_screen":
                // $("#title").html("<h2>Ya estas listo para recibir mensaje</h2><hr />")
                $("#body").html(e.message)
                // $("#footer").html("<hr />")
              break;
              case "msg_input":
                $("#title").html("<h2>Ya estas listo para recibir mensaje</h2><hr />")
                $("#body").html("<h4>Mensaje de entrada<span class='badge badge-primary'>"+e.message+"</span></h4>")
                // $("#footer").html("<hr />")
              break;
              case "msg_output":
                // $("#title").html("<h2>Mensaje de salida</h2><hr />")
                $("#footer").html("<hr /><h4>Mensaje de salida <span class='badge badge-success'>"+e.message+"</span></h24")
                // $("#footer").html("<hr />")
              break;
            default:
              break;
          }
        } else {
            
        }
    })
</script>
@endsection