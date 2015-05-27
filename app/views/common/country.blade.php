@section("country")

    @if (isset($required))
    {{ Form::select((isset($name)? $name : 'country_code'), $countries, null, array('id' => 'country', 'required')); }}
    <small class="error">Country is required.</small>
    @else
    {{ Form::select((isset($name)? $name : 'country_code'), $countries, null, array('id' => 'country')); }}
    @endif
    
@show