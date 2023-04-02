@extends('layouts.app')
@section('title', __('home.home'))
@section('content')
<section class="content-header">
    <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}
    </h1>
    {{-- <img src="{{ asset("chatbot/qrwb.png") }}" alt=""> --}}
    <div id="ele"></div>
</section>


@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" integrity="sha512-LUKzDoJKOLqnxGWWIBM4lzRBlxcva2ZTztO8bTcWPmDSpkErWx0bSP4pdsjNH8kiHAUPaT06UXcb+vOEZH+HpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  //const count = 1;
    //setTimeout(transition, 2000);

    async function transition() {
        var micount = micount + 1
        //$('#ele').html('variation 2');
        console.log("micount")
        // if(count == 1) {
        //     $('#ele').html('variation 2');
        //     var count = 2;

        // } else if(count == 2) {
        //     $('#ele').html('variation 3');
        //     var count = 3;

        // } else if(count == 3) {
        //     $('#ele').html('variation 1');
        //     var count = 1;
        // }

        // setTimeout(transition, 2000);

        var mibusine = await axios("http://localhost:8000/api/chatbots/busine/start/1")

            if(mibusine.data){
                $('#ele').html('el chatbot esta listo');

            }else{
                $('#ele').html('escanea el qr');
            }
    }
    setInterval(transition, 10000);
</script>
@endsection