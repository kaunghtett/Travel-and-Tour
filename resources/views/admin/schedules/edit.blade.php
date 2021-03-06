@extends ('admin-layouts.master')

<style type="text/css">
input[type=file]{
	display: inline;
}
#image_preview{
	border: 1px solid #ccc;
	padding: 10px;
}
#image_preview img{
	width: 200px;
	padding: 5px;
}
</style>


@section ('content')

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Edit Schedule</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h4>Schedules</h4>
				<fieldset>

					<form method="Post" action="{{ url('/schedules/update/'.$schedules->id) }}" name="post" enctype="multipart/form-data">

						{{ csrf_field() }}


						<input type="hidden" id="tour_packages_id" name="tour_packages_id" class="form-control" value="{{$id}}">

						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label class="control-label" for="name">Name :</label>
							<input type="text" name="name" class="form-control" placeholder="Name..." value="{{ old('name', $schedules->name) }}">
							<p class="text-danger">{{ $errors->first('name') }}</p>
						</div>

						<div class="form-group">
							<label>Upload Images</label>
							<div class="form-group">
								<input type="file" id="uploadFile"  name="image[]" multiple="multiple">
								<br>
								<br>

								<span><label ><b><i>Recent Images</i></b></label></span>
								<br><br>

								<div id="image_preview">



									@foreach($schedules->multi as $multimg)

									

									
									<img src="{{ asset($multimg->boo()) }}" width="100" height="auto" id="{{$multimg->id}}" class="img">
									<a href="#" class="del" id="{{$multimg->id}}" >Delete</a>

									@endforeach


								</div>
							</div>

						</div>
						<br>

						<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
							<label class="control-label" for="description">Description
							</label> 
							<textarea id="summernote"  name="description" class="form-control"> {{ old('description', $schedules->description) }}</textarea>
							<br>
							<!--  <div id="btn"></div> -->
							<p class="text-danger">{{ $errors->first('description') }}</p>
						</div>


						<div class="form-group">
							<button class="btn btn-success">Save</button>

							<a href="{{url('/schedules/'.$schedules->tour_packages_id)}}" class="btn btn-primary">Back</a>
						</div>



					</form>
				</fieldset>
			</div>
		</div>
	</div>



	@endsection ('content')

	@section ('footer.script')

	<script>

		$(document).ready(function(){

 // Delete
 $('.del').click(function(){
 	var id = this.id;

 	console.log(id);
 	var split_id = id.split("_");

  // Selecting image source
 

  // AJAX request

$.get("/deleteimage/"+id, function(data, status){

	location.reload();
        
    });

});
});
</script>

<script type="text/javascript">



	$("#uploadFile").change(function(){

		$('#image_preview').html("");

		var total_file=document.getElementById("uploadFile").files.length;



		for(var i=0;i<total_file;i++)

		{

			$('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");

		}



	});

</script>

<script>

$('#summernote').summernote({
	toolbar: [
// [groupName, [list of button]]
['style', ['bold', 'italic', 'underline', 'clear']], 
['fontsize', ['fontsize']],
    ['color', ['color']],
],
height: 200,
minHeight: 100,
maxHeight: 400,
fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150']




});

</script>

@stop
