@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Posts
				</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('addPost') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="50" id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>
								</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    <table style="width:100%">
						<thead>
							<th>Serial No.</th>
							<th>Detail</th>
							<th></th>
							<th></th>
						</thead>
						@foreach ( $data as $key => $value )
							<tr style="border:1px solid #ccc">
								
									<td>
									{{$key+1}}
									</td>
									<td>
									<input  class="postDetail" type="text" class="form-control" name="description" value="{{ $value->description }}" >
									</td>
									<td>
										<div class="form-group">
											<div class="col-md-6 col-md-offset-4">
												<button class="updateBtn" data-value="{{$value->id}}" type="submit" class="btn btn-primary">
													Update
												</button>
											</div>
										</div>
									</td>
								
								<td>
										@if($userType == 1)
										<div class="form-group">
											<div class="col-md-6 col-md-offset-4">
												<button class="deleteBtn" data-value="{{$value->id}}" type="submit" class="btn btn-primary">
													Delete
												</button>
											</div>
										</div>
										@endif
								</td>
							</tr>
						 
						@endforeach
						
					</table>
                </div>
            </div>
		</div>
    </div>
</div>

<script>
	$( document ).ready(function(){
		$(".deleteBtn").click(function(){
			var id = $(this).attr("data-value");
			
			$.ajax({
				  url: "deletePost",
				  method: "POST",
				  data:{id:id,"_token": "{{ csrf_token() }}"},
				  success : function(response) {
				  if(response.status == 1)
						location.reload();
				}
				});
		});
		
		$(".updateBtn").click(function(){
			
			var id = $(this).attr("data-value");
			var desc = $(this).parents("tr").find(".postDetail").val();
			console.log(desc);
			$.ajax({
				  url: "updatePost",
				  method: "POST",
				  data:{description:desc,id:id,"_token": "{{ csrf_token() }}"},
				  success: function(response) {
					  if(response.status == 1)
						location.reload();
					  
					  }
				});
		});
	})
</script>
@endsection
