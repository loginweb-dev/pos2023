@extends('layouts.app')
@section('title', 'Chatbot')

@section('vue')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Panel del Chatbot v3.0</h1>
</section>

@if(empty($is_demo))
<section class="content">
	@component('components.widget', ['class' => 'box-solid', 'title' => 'Campañas'])
        @slot('tool')
            <div class="box-tools">
                
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-toggle="modal" 
                    data-target="#create_client_modal">
                    <i class="fas fa-plus"></i> Nueva Campaña</button>
            </div>
        @endslot
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="clients_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Descrcipcion</th>
                        <th>@lang( 'messages.action' )</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    @endcomponent
</section>
@else
<section>
    <div class="col-md-12 text-danger">
        <br/>
        @lang('lang_v1.disabled_in_demo')
    </div>
</section>
@endif
@stop
@section('javascript')
<script type="text/javascript">
	$(document).ready( function(){
		clients_table = $('#clients_table').DataTable();
	});
</script>
@endsection