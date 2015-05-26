

<div class="row" style="border: 1px solid grey; padding: 1em;">
<div class="small-12 columns">

	<div class="row"><div class="small-6 columns">
		<h3>Add New Club</h3>
	</div></div>
	
	{{ Form::open(array('url' => 'foo/bar')) }}
	
	<div class="row">
		<div class="small-6 columns"><label for="club">Club</label></div>
		<div class="small-6 columns"><select></select></div>
	</div>
	
	<div class="row">
		<div class="small-6 columns"><label for="name">Service Name</label></div>
		<div class="small-6 columns"><input type="text" name="name" id="name" /></div>
	</div>	
	
	<div class="row">
		<div class="small-6 columns"><label for="category">Service Category</label></div>
		<div class="small-6 columns"><select></select></div>
	</div>
	
	<div class="row">
		<div class="small-6 columns"><label for="subcategory">Service Sub-Category</label></div>
		<div class="small-6 columns"><select></select></div>
	</div>
	
	<div class="row">
		<div class="small-12 columns"><label for="duration">Service Duration</label></div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<div class="row" style="background-color: grey;">
				<div class="small-6 columns">Duration</div>
				<div class="small-6 columns">Price</div>
			</div>
			<div class="row"><div class="small-12 columns">&nbsp;</div></div>
			<div class="row">
				<div class="small-6 columns"><input type="text" /></div>
				<div class="small-6 columns"><input type="text" /></div>
			</div>
		</div>
	</div>	
	
	<div class="row">
		<div class="small-12 columns"><label for="description">Service Description</label></div>
	</div>
	<div class="row">
		<div class="small-12 columns"><textarea name="description"></textarea></div>
	</div>	
	
	<div class="row">
		<div class="small-12 columns"><label for="cancellation_notes">Cancellation Notes</label></div>
	</div>
	<div class="row">
		<div class="small-12 columns"><textarea name="cancellation_notes"></textarea></div>
	</div>
	
	<div class="row">
		<div class="small-12 columns">
			<input type="submit" value="Add Service">
		</div>
	</div>
	
</div>
</div>

