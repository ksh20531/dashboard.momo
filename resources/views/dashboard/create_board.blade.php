@extends('layouts.app')
{{-- @section('title')
dashboard
@endsection --}}
@section('style')

@endsection

@section('content')
	<div class="content-header">
		<div style="padding-top: 10px;">
			<div style="display: inline-block; width: 100px;">Title</div>
			<input id="title" type="text" style="width: calc(100% - 120px);" value="{!! $title !!}">
		</div>
		<div style="margin-top: 10px;">
			<div style="display: inline-block; width: 100px;">Content</div>
			<input id="content" type="text" style="width: calc(100% - 120px); height: 200px;" value="{!! $content !!}">
		</div>
		<div style="margin: 10px; text-align: right;">
			<button class="btn btn-primary btn-sm" onclick="submit()">Submit</button>
		</div>
	</div>
	<div id="dashboard-lists">
		
	</div>
@endsection

@section('script')
<script type="text/javascript">
	var id = {{ $id }};
	var title = "{!! $title !!}";
	var content = "{!! $content !!}";
	$(function(){

	});

	function submit(url = "/dashboard/submit"){
		var submit_title = $("#title").val();
		var submit_content = $("#content").val();

		ajax_data = {
			id: id,
			title: submit_title,
			content: submit_content,
		}

		$.ajax({    
			type : 'put',
			url : url,
			data : ajax_data,
			headers:{
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success : function(result) {
				alert("success");
				window.open("/dashboard/"+result,'self');

			},    
			error : function(request, status, error) {
				console.log(error)    
			}
		})
	}

</script>
@endsection
