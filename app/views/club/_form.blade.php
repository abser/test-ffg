
<div class="form-group">
	<label for="name" class="col-lg-2 control-label">Club Name</label>
    <div class="col-lg-10">
    	<input type="text" class="form-control" id="name" placeholder="club name">
    </div>
</div>
<div class="form-group" style="padding-top: 1em;">
	<label for="address" class="col-lg-2 control-label">Address</label>
    <div class="col-lg-10">
    	<div class="row">
    		<div class="col-lg-4">@include("common.country", ['name' => 'address[country_code]', 'style'=>'width: 100%;'])</div>
    		<div class="col-lg-1">&nbsp;</div>
    		<div class="col-lg-4">{{ Form::select('address[region_id]', array('' => ''), null, array('id' => 'region') ); }}</div>
    		<div class="col-lg-2">&nbsp;</div>    		
    	</div>    	
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
    	<input type="text" class="form-control" id="address1" name="address[address1]" placeholder="address line 1">
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
    	<input type="text" class="form-control" id="address2" name="address[address2]" placeholder="address line 2">
    </div>
</div>
<div class="form-group">
	<div class="col-lg-2">&nbsp;</div>
    <div class="col-lg-10">
    	<input type="text" class="form-control" id="postal_code" name="address[postal_code]" placeholder="postal code">
    </div>
</div>
<div class="form-group">
	<label for="description" class="col-lg-2 control-label">Description</label>
    <div class="col-lg-10">
    	<textarea class="form-control" id="description" name="description" placeholder="club description" rows="3"></textarea>
    </div>
</div>

<button type="submit" class="btn btn-default">Save Club</button>
<button type="button" class="btn">Cancel</button>

