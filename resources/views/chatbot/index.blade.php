@extends('layouts.app')
@section('title', __('home.home'))
@section('css')
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
/* **************** */
/* **************** */
/* * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
} */

/* html {
  font-size: 14px;
  line-height: 1.25rem;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
} */

li {
  list-style-type: none;
}

a {
  text-decoration: none;
}

input,
input:focus {
  outline: 0;
  border: 0;
}

/* body {
  background-color: #111b21;
  margin: 0 auto;
  width: 100%;
  height: 100vh;
} */

span svg {
  color: #aebac1;
  width: 24px;
  height: 24px;
}

/* **************** */
/* **************** */
.app-container {
  width: 100%;
  height: 80vh;
  background-color: #111b21;
  margin: 0 auto;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  /* Navbar Style */
  /* Content Style */
}
.app-container .navbar-container {
  padding: 0 10px 0 0;
  display: flex;
  flex-direction: row;
  background-color: #202c33;
}
.app-container .navbar-container .navbar-left {
  height: 60px;
  display: flex;
  flex: 1;
  justify-content: space-between;
  flex-direction: row;
}
.app-container .navbar-container .navbar-left .owner-photo {
  display: flex;
  align-items: center;
  padding: 10px;
}
.app-container .navbar-container .navbar-left .owner-photo img {
  width: 42px;
  height: 42px;
  border: 2px solid transparent;
  border-radius: 50%;
  cursor: pointer;
}
.app-container .navbar-container .navbar-left .owner-photo img:hover {
  border: 2px solid #00a884;
  transition: 300ms all border ease-in;
}
.app-container .navbar-container .navbar-left .navbar-icons {
  display: flex;
  flex-direction: row;
  gap: 0.5rem;
  align-items: center;
  cursor: pointer;
}
.app-container .navbar-container .navbar-left .navbar-icons span {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.app-container .navbar-container .navbar-left .navbar-icons span:hover {
  border-radius: 50%;
  background-color: #374248;
  transition: 300ms background ease-in;
}
.app-container .navbar-container .navbar-right {
  border-left: rgba(207, 207, 207, 0.1568627451) 1px solid;
  display: flex;
  flex: 3;
  height: 60px;
  justify-content: flex-start;
  justify-content: space-between;
}
.app-container .navbar-container .navbar-right .group-card {
  display: flex;
  flex-direction: row;
  padding: 10px;
}
.app-container .navbar-container .navbar-right .group-card .group-photos {
  cursor: pointer;
  display: flex;
  align-items: center;
}
.app-container .navbar-container .navbar-right .group-card .group-photos img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}
.app-container .navbar-container .navbar-right .group-card .group-info {
  gap: 5px;
  margin-left: 1rem;
  display: flex;
  flex-direction: column;
}
.app-container .navbar-container .navbar-right .group-card .group-info .group-name {
  color: #d1d7db;
  font-size: 1.15rem;
  font-weight: 400;
}
.app-container .navbar-container .navbar-right .group-card .group-info .group-member {
  font-size: 1rem;
  font-weight: 400;
  color: #8696a0;
}
.app-container .navbar-container .navbar-right .navbar-icons {
  display: flex;
  flex-direction: row;
  gap: 0.5rem;
  align-items: center;
  cursor: pointer;
}
.app-container .navbar-container .navbar-right .navbar-icons span {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.app-container .navbar-container .navbar-right .navbar-icons span:hover {
  border-radius: 50%;
  background-color: #374248;
  transition: 300ms background ease-in;
}
.app-container .card-contaniner {
  padding: 0 10px 0 0;
  display: flex;
  flex-direction: row;
  flex: 1;
}
.app-container .card-contaniner .contact-card {
  display: flex;
  flex-direction: column;
  background-color: #111b21;
  flex: 1;
}
.app-container .card-contaniner .contact-card .search-area {
  position: relative;
  display: flex;
  flex-direction: row;
  width: 100%;
}
.app-container .card-contaniner .contact-card .search-area input {
  height: 35px;
  width: 100%;
  font-size: 15px;
  border-radius: 8px;
  margin: 8px 0;
  padding: 8px 50px;
  background-color: #202c33;
  color: #aebac1;
  text-align: start;
  font-family: inherit;
  cursor: pointer;
}
.app-container .card-contaniner .contact-card .search-area input::-moz-placeholder {
  color: rgba(174, 186, 193, 0.8);
  font-size: 1rem;
  text-align: start;
}
.app-container .card-contaniner .contact-card .search-area input:-ms-input-placeholder {
  color: rgba(174, 186, 193, 0.8);
  font-size: 1rem;
  text-align: start;
}
.app-container .card-contaniner .contact-card .search-area input::placeholder {
  color: rgba(174, 186, 193, 0.8);
  font-size: 1rem;
  text-align: start;
}
.app-container .card-contaniner .contact-card .search-area .icon-search {
  position: absolute;
  top: 15px;
  left: 15px;
  display: flex;
  cursor: pointer;
}
.app-container .card-contaniner .contact-card .search-area .navbar-icons {
  display: flex;
  flex-direction: row;
  align-items: center;
  padding: 0 5px;
  cursor: pointer;
}
.app-container .card-contaniner .contact-card .search-area .navbar-icons span {
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.app-container .card-contaniner .contact-card .search-area .navbar-icons span:hover {
  border-radius: 50%;
  background-color: #00a884;
  transition: 300ms background ease-in;
}
.app-container .card-contaniner .contact-card .contact-member {
  display: flex;
  flex-direction: row;
  height: 80px;
}
.app-container .card-contaniner .contact-card .contact-member:hover {
  background-color: #202c33;
  transition: 300ms background ease-in;
}
.app-container .card-contaniner .contact-card .contact-member .member-photo {
  padding: 10px;
  display: flex;
  align-items: center;
}
.app-container .card-contaniner .contact-card .contact-member .member-photo img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
}
.app-container .card-contaniner .contact-card .contact-member .member-info {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  padding: 5px;
  gap: 5px;
}
.app-container .card-contaniner .contact-card .contact-member .member-info .member-name {
  font-size: 16px;
  color: white;
  text-align: center;
}
.app-container .card-contaniner .contact-card .contact-member .member-info .member-messages {
  font-size: 1rem;
  width: 150px;
  color: #aebac1;
  flex-wrap: wrap;
  text-align: start;
}
.app-container .card-contaniner .contact-card .contact-member .member-clock {
  margin-left: auto;
  display: flex;
  align-items: center;
  padding: 0 10px;
}
.app-container .card-contaniner .contact-card .contact-member .member-clock .clock {
  font-size: 0.85rem;
  justify-content: center;
  align-items: center;
  color: #aebac1;
}
.app-container .card-contaniner .contact-card .active {
  background-color: #202c33;
  transition: 300ms background ease-in;
}
.app-container .card-contaniner .chat-card {
  position: relative;
  display: flex;
  flex: 3;
  flex-direction: column;
  border-left: rgba(207, 207, 207, 0.1568627451) 1px solid;
}
.app-container .card-contaniner .chat-card .message-input {
  position: absolute;
  bottom: 0;
  background: #202c33;
  display: flex;
  padding: 0 1rem;
  flex-direction: row;
  align-items: center;
  gap: 10px;
  justify-content: space-between;
}
.app-container .card-contaniner .chat-card .message-input .navbar-icons {
  display: flex;
  flex-direction: row;
  flex: 1;
  gap: 0.5rem;
  align-items: center;
  cursor: pointer;
}
.app-container .card-contaniner .chat-card .message-input .navbar-icons span {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.app-container .card-contaniner .chat-card .message-input .navbar-icons span:hover {
  border-radius: 50%;
  background-color: #374248;
  transition: 300ms background ease-in;
}
.app-container .card-contaniner .chat-card .message-input .input-box {
  width: 100%;
  display: flex;
}
.app-container .card-contaniner .chat-card .message-input .input-box input {
  height: 42px;
  font-size: 15px;
  border-radius: 8px;
  margin: 8px 0;
  flex: 1;
  padding: 8px 20px;
  background-color: #2a3942;
  color: #aebac1;
  text-align: start;
  font-family: inherit;
  cursor: pointer;
}
.app-container .card-contaniner .chat-card .message-input .input-box input::-moz-placeholder {
  color: rgba(174, 186, 193, 0.8);
  font-size: 1rem;
  text-align: start;
}
.app-container .card-contaniner .chat-card .message-input .input-box input:-ms-input-placeholder {
  color: rgba(174, 186, 193, 0.8);
  font-size: 1rem;
  text-align: start;
}
.app-container .card-contaniner .chat-card .message-input .input-box input::placeholder {
  color: rgba(174, 186, 193, 0.8);
  font-size: 1rem;
  text-align: start;
}
.app-container .card-contaniner .chat-card .chat-ballon {
  padding: 2rem 3rem;
  display: flex;
  z-index: 999;
  flex-direction: column;
  justify-content: end;
  gap: 20px;
  height: calc(100%);
}
.app-container .card-contaniner .chat-card .chat-ballon .sender {
  display: inline-flex;
  border-radius: 10px 10px 10px 0;
  padding: 1rem;
  max-width: -webkit-fit-content;
  max-width: -moz-fit-content;
  max-width: fit-content;
  background-color: #202c33;
  flex-direction: column;
  justify-content: flex-start;
}
.app-container .card-contaniner .chat-card .chat-ballon .sender .sender-member {
  color: #0e9e47;
}
.app-container .card-contaniner .chat-card .chat-ballon .sender .sender-messages {
  color: #aebac1;
}
.app-container .card-contaniner .chat-card .chat-ballon .sender .sender-messages span {
  font-size: 11px;
  padding-left: 4px;
}/*# sourceMappingURL=app.css.map */
    </style>
@endsection
@section('content')
@php
    $envVars = getenv(asset('/chatbot'));
@endphp
<section class="content-header">
    <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
     <br> Negocio #{{ $business_id }}
    </h1>
      <div>
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#isMe" aria-controls="isMe" role="tab" data-toggle="tab">isMe</a></li>
          <li role="presentation"><a href="#isUser" aria-controls="isUser" role="tab" data-toggle="tab">isUser</a></li>
          <li role="presentation"><a href="#isGroup" aria-controls="isGroup" role="tab" data-toggle="tab">isGroup</a></li>
          <li role="presentation"><a href="#isWAContact" aria-controls="isWAContact" role="tab" data-toggle="tab">isWAContact</a></li>
          <li role="presentation"><a href="#isMyContact" aria-controls="isMyContact" role="tab" data-toggle="tab">isMyContact</a></li>
          <li role="presentation"><a href="#isBlocked" aria-controls="isBlocked" role="tab" data-toggle="tab">isBlocked</a></li>
          <li role="presentation"><a href="#env" aria-controls="env" role="tab" data-toggle="tab">Configuracion</a></li>
        </ul>
      
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active text-center" id="isMe">
        
            <div id="title"></div>
            <div id="body"></div>
            <div id="footer"></div>
          </div>

          <div role="tabpanel" class="tab-pane" id="isUser">
            <main class="app-container">

              <article class="card-contaniner">
                  <div class="contact-card">
                    
                  </div>
                  <div class="chat-card">
                      <div class="chat-ballon">
                          {{-- <div class="sender">
                              <a class="sender-member" href="#">Onur</a>
                              <a class="sender-messages" href="#">Tuncay'ın sevgilisi ölmüş abi. <span>13:32</span></a>
                          </div>
                          <div class="sender">
                              <a class="sender-member" href="#">Onur</a>
                              <a class="sender-messages" href="#">Tuncay'ın sevgilisi ölmüş abi. <span>13:35</span></a>
                          </div>
                          <div class="sender">
                              <a class="sender-member" href="#">Onur</a>
                              <a class="sender-messages" href="#">Tuncay'ın sevgilisi ölmüş abi. <span>13:37</span></a>
                          </div> --}}
                      </div>
                  </div>
              </article>
            </main>
          </div>

          <div role="tabpanel" class="tab-pane" id="isGroup">
            <div id="title_negocio"></div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped"  id="TisGroup">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Number</th>
                      <th>isGroup</th>
                      <th>isWAContact</th>
                      <th>isUser</th>
                      {{-- <th>isUser</th>
                      <th>isWAContact</th>
                      <th>isMyContact</th>
                      <th>numero</th>
                      <th>type</th>
                      <th>id:server</th>
                      <th>id:user</th>
                      <th>id:_serialized</th> --}}
                    </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
          </div>


          <div role="tabpanel" class="tab-pane" id="isWAContact">
            {{-- <div id="title_grupo"></div> --}}
            <div class="table-responsive">
              <table class="table table-dark table-striped" id="isWAContact">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Contacto</th>
                      <th>numero</th>
                      <th>type</th>
                      <th>id:server</th>
                      <th>id:user</th>
                      <th>id:_serialized</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="isMyContact">
            {{-- <div id="title_empresas"></div> --}}
            <div class="table-responsive">
              <table class="table table-dark table-striped" id="isMyContact">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Contacto</th>
                      <th>numero</th>
                      <th>type</th>
                      <th>id:server</th>
                      <th>id:user</th>
                      <th>id:_serialized</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="isBlocked">
            {{-- <div id="title_empresas"></div> --}}
            <div class="table-responsive">
              <table class="table table-dark" id="isBlocked">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Contacto</th>
                      <th>numero</th>
                      <th>type</th>
                      <th>id:server</th>
                      <th>id:user</th>
                      <th>id:_serialized</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane" id="env">
            {{-- <h2>Configuracion</h2> --}}
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="">Mensaje</label>
                  <textarea class="form-control" name="" id="" cols="" rows=""></textarea>
                </div>
              </div>
            </div>
          </div>

        </div>
      
      </div>
</section>


@endsection

@section('javascript')
<script type="text/javascript" src="https://cdn.rawgit.com/KeeeX/qrcodejs/master/qrcode.min.js"></script>
<script>

  Echo.channel('home')
    .listen('NewMessage', (e) => {
        if ("{{ $business_id }}" == e.busine) {

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
              new Notification("Escanea el QR");
              break;
              case "ready":
                // $("#title").html("<h2>Ya estas listo para enviar mensaje</h2><hr />")
                $("#body").html("resisa tu celular")
                $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
                // new Notification("Cahtbot en linea");
              break;
              case "authenticated":
                $("#title").html("<h2>Ya estas listo para recibir mensaje</h2><hr />")
                $("#body").html(e.message)
                $("#footer").html("<hr />")
              break;
              case "loading_screen":
                $("#title").html("<h2>Cargando mensajes..</h2><hr />")
                $("#body").html(e.message)
                $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
                // new Notification(e.message);
              break;
              case "msg_input":
                $("#title").html("<h2>Recibiendo mensajes</h2><hr />")
                $("#body").html("<h4>"+e.message+" <br /><span class='badge badge-primary'>Mensaje de entrada</span></h4>")
                // $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
                // new Notification(e.message);
              break;
              case "msg_output":

              break;
              case "group_join":
                const date = new Date();
                $("#title").html("<h2>Ya estas listo para recibir mensaje</h2><hr />")
                $("#body").html("<h4>"+e.message.chatId+" <br /><span class='badge badge-primary'>Ingreso a grupo</span><br>"+date+"</h4>")
                $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
                // new Notification(e.message.chatId);
              break;
              case "group_leave":
                const date2 = new Date();
                $("#title").html("<h2>Ya estas listo para recibir mensaje</h2><hr />")
                $("#body").html("<h4>"+e.message.chatId+" <br /><span class='badge badge-primary'>Salio del grupo</span><br>"+date2+"</h4>")
                $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
                // new Notification(e.message.chatId);
                $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
              break;
              case "group_update":
                const date3 = new Date();
                $("#title").html("<h2>Grupo actualizado</h2><hr />")
                $("#body").html("<h4>"+e.message.chatId+" <br /><span class='badge badge-primary'>Grupo modificado</span><br>"+date3+"</h4>")
                // $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
                // new Notification(e.message.chatId);
                $("#footer").html("<hr /><a href='http://web.whatsapp.com' target='_blank'>Abrir whatsapp web</a>")
              break;
              case "marketing":
                $("#title").html("<h2>Envio Masivos</h2><hr />")
                $("#body").html("<h4>"+e.message+" <br /><span class='badge badge-primary'>marketing</span></h4>")
                break;
              case "error":
                $("#title").html("<h2>Ocurrio un error</h2><hr />")
                $("#body").html("<h4>"+e.message+" <br /><span class='badge badge-danger'>error</span></h4>")
                break;
              case "contactos":
                try {
                  var miarray = e.message
                  console.log(miarray)
                  $('#TisGroup').DataTable({
                      data: miarray,
                      // orderCellsTop: true,
                      // fixedHeader: true,
                      // "serverSide": true,
                      "processing": true,
                      columns: [
                          { data: this.index() },
                          { data: 'name' },
                          { data: 'number' },
                          { data: 'isGroup' },
                          { data: 'isWAContact' },
                          { data: 'id.user' },
                      ]
                    });

                  
                  var micunt = 2
                  var isUser = 1
                  var isGroup = 1
                  var isWAContact = 1
                  var isMyContact = 1
                  var isBlocked = 1
                  new Notification("Lista de contactos cargada");
                  $("#title").html("<h2>Total: "+micunt+" registros</h2>")
                } catch (error) {
                  new Notification(error);
                }
 
              break;
            default:
              break;
          }
        } else {
            
        }
    })
</script>
@endsection