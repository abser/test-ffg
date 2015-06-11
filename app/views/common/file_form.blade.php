<?php 
    $display = '';
    if(isset($form) && array_key_exists($file, $form) && is_object($form[$file])){
         $display = ($form[$file]->description)? $form[$file]->description : $form[$file]->name; 
    }
?>

<div class="form-group">
	{{ Form::label($file, ucwords((isset($label)? $label : $file)), ['class' => 'col-lg-3 control-label']) }}
	<div class="col-lg-4">
		{{ Form::file($file,array('class' => 'clm-button', 'id' => $file, 'data-abide-validator' => 'filesize')); }}
        <small class="error">You can upload JPEG, GIF and PNG Image. Max file size is 2MB</small>
	</div>
    <div class="col-lg-5">
    	@if($display)
        <div id="{{$file}}_file">
        {{ $display }} <a id="delete_{{$file}}"><i class="fi-trash"> delete</i></a>
        </div>
        {{ Form::hidden('delete_'.$file) }}
        @section('js')
        @parent
        <script type="text/javascript">
            $(document).ready( function () {

                $("#delete_{{$file}}").click(function(){
                    $("input[name='delete_{{$file}}']").val('1');
                    $("#{{$file}}_file").hide();
                });
            });
        </script>
        @stop
        @endif
    </div>
</div>