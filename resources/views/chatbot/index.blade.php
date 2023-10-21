@extends('layouts.app')
@section('title', __('home.home'))
@section('css')

@endsection
@section('content')

@endsection

@section('javascript')
<script type="text/javascript" src="https://cdn.rawgit.com/KeeeX/qrcodejs/master/qrcode.min.js"></script>
<script>

  Echo.channel('home')
    .listen('NewMessage', (e) => {
      console.log(e.message)
    })
    console.log("mierda")
</script>
@endsection