@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
        <!-- Tabs -->
        
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul>
<!-- ./ tabs -->

@if (isset($vehicle))
{!! Form::model($vehicle, array('url' => URL::to('admin/vehicle') . '/' . $vehicle->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('admin/vehicle'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        {!! Form::hidden('user_id', null) !!}
        @include('admin.user.create_edit_form')
        
        <div class="form-group  {{ $errors->has('title') ? 'has-error' : '' }}">
            {!! Form::label('title', 'Vehicle Title', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('title', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
            {!! Form::label('type', 'Tracking Type', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('type', [
                    'app' => 'App',
                    'iridium_mail_gateway' => 'Iridium Phone',
                    'epak' => 'Epak',
                    'ais' => 'AIS']
                 ) !!}
                <span class="help-block">{{ $errors->first('type', ':message') }}</span>
            </div>
        </div>
        
        <div class="form-group  {{ $errors->has('sat_number') ? 'has-error' : '' }}">
            {!! Form::label('name', 'Identifier', array('class' => 'control-label')) !!}
            <div class="controls">
               	{!! Form::text('sat_number', null, array('class' => 'form-control')) !!}
                <span class="help-block">
                    Iridium-Go: Mobilenumber (e.g. "881623439957")<br>
                    App: Identifier (e.g. "landrover_1")<br>
                    EPAK: EPAK API Key<br>
		    AIS: MSI
                </span>
                <span class="help-block">{{ $errors->first('sat_number', ':message') }}</span>
            </div>
        </div>
        
        
        <div class="form-group  {{ $errors->has('location_alarm') ? 'has-error' : '' }}">
            {!! Form::label('location_alarm', 'Location Alaram', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::checkbox('location_alarm', 1) !!}
                E-Mail alarm, if the vessel is inside mentionable areas
                
                <span class="help-block">{{ $errors->first('operation_areas', ':message') }}</span>
            </div>
        </div>
        <div class="form-group location_alarm_field {{ $errors->has('location_alarm_mails') ? 'has-error' : '' }}">
            {!! Form::label('location_alarm_mails', 'Alarm Recipents', array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('location_alarm_mails', null, array('class' => 'form-control')) !!}
                
                <span class="help-block">
                    Mails of receipents<br/>
                    (e.g. "mail@one.com, mail@two.com, bill@microsoft.com)
                </span>
                <span class="help-block">{{ $errors->first('location_alarm_mails', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('key') ? 'has-error' : '' }}">
            <input type="text" name="marker-pseudo" id="marker-pseudo">
            
            {!! Form::label('name', 'Marker Color', array('class' => 'control-label')) !!}
            </div>
            <div class="controls"><div style="display:none">
                {!! Form::text('marker_color', null, array('class' => 'form-control')) !!}
                </div>
                <span class="help-block">{{ $errors->first('marker_color', ':message') }}</span>
            </div>
        </div>
    </div>
        
        
        <div class="form-group  {{ $errors->has('sat_number') ? 'has-error' : '' }}">
            {!! Form::label('max_speed', 'Max Speed in Knots(SOG)', array('class' => 'control-label')) !!}
            <div class="controls">
               	{!! Form::text('max_speed', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('max_speed', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('sat_number') ? 'has-error' : '' }}">
            {!! Form::label('logo_url', 'Logo URL', array('class' => 'control-label')) !!}
            <div class="controls">
               	{!! Form::text('logo_url', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('logo_url', ':message') }}</span>
            </div>
        </div>
        
    <div class="form-group">
        <div class="col-md-12">
            <button type="reset" class="btn btn-sm btn-warning close_popup">
                <span class="glyphicon glyphicon-ban-circle"></span> {{
				trans("admin/modal.cancel") }}
            </button>
            <button type="reset" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-remove-circle"></span> {{
				trans("admin/modal.reset") }}
            </button>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if	(isset($vehicle))
                    {{ trans("admin/modal.edit") }}
                @else
                    {{trans("admin/modal.create") }}
                @endif
            </button>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            if($('input[name=location_alarm]').is(':checked')){
                $('.location_alarm_field').show();
            }else{
                
                $('.location_alarm_field').hide();
            }
            
            
            $('input[name=location_alarm]').click(function(){
                if($(this).is(':checked')){
                    $('.location_alarm_field').show();
                }else{

                    $('.location_alarm_field').hide();
                }
            });
            
            var initValue;
            if($('input[name="marker_color"]').val() === '')
                initValue = '#f00'
            else
                initValue = '#'+$('input[name="marker_color"]').val();

            console.log(initValue);
            $("#marker-pseudo").spectrum({
                color: initValue,
                change: function(color) {
                    console.log(color.toHexString().replace('#',''));
                    $('input[name="marker_color"]').val(color.toHexString().replace('#',''))
                }
            });
            $('input[name="sat_number"]').hide();
            $('select#type').change(function(){
		var field_name;
                if($(this).val() === 'iridium_mail_gateway'||$(this).val() === 'epak'||$(this).val() === 'ais'){
		    switch($(this).val()){
			case 'iridium_mail_gateway':
				field_name = 'Phone Number';
			break;
                        case 'epak':
                                field_name = 'EPAK API KEY';
                        break;
                        case 'ais':
                                field_name = 'MSI';
                        break;


		    }
console.log(field_name);
		    $('label[for="name"]').text(field_name);
                    $('input[name="sat_number"]').show();
                }else{
                    $('input[name="sat_number"],label[for="name"]').hide();

                }
            });
        });
    </script>


    {!! Form::close() !!}
    @stop @section('scripts')
        
</div>
@stop
