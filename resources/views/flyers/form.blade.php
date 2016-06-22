<div class="row">
	<div class="col-md-6">
		
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			<div class="form-group">
				<label for="street">Street</label>
				<input type="text" name="street" id="inputStreet" class="form-control">	
			</div>
			<div class="form-group">
				<label for="city">City</label>
				<input type="text" name="city" id="inputCity" class="form-control">
			</div>
			<div class="form-group">
				<label for="zip">Zip code</label>
				<input type="text" name="zip" id="inputZip" class="form-control">
			</div>
			<div class="form-group">
				<label for="Country">Country</label>
				<select class="form-control" name="country" id="country">
					@foreach(App\Http\Utilities\Country::all() as $code => $country)
						<option value="{{ $code }}">{{ $country }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="state">State</label>
				<input type="text" name="state" id="inputState" class="form-control">
			</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="price">Sale price</label>
			<input type="text" name="price" id="inputPrice" class="form-control">
		</div>
		<div class="form-group">
			<label for="description">Home description</label>
			<textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
		</div>
	</div>
	<div class="col-md-12">
		<hr>
		<div class="form-group">
			<button class="btn btn-primary">Create flyer</button>
		</div>
	</div>
</div>