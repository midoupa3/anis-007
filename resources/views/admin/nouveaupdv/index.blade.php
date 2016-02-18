@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') NouveauPDV::
@parent @stop

@section('styles')
    @parent
    <link href="{{ asset("css/flags.css") }}" rel="stylesheet">
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            Nouveau PDV

            <div class="pull-right">
                <a href="{!!  URL::to('admin/nouveaupdv/create') !!}"
                   class="btn btn-sm  btn-primary iframe"><span
                            class="glyphicon glyphicon-plus-sign"></span> {!!
				trans("admin/modal.new") !!}</a>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
        	<th>code vendeur PDV</th>
        	<th>raison sociale</th>
        	<th>type pdv</th>
        	<th>adresse pdv</th>
        	<th></th>
        	<th>wilaya pdv</th>
        	<th>commune pdv</th>
        	<th>msisdn</th>
        	<th>autre telephone pdv</th>
        	<th>email pdv</th>
        	<th>Statue</th>
			<th>{{ trans("admin/admin.action") }}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@stop

{{-- Scripts --}}
@section('scripts')
@stop
