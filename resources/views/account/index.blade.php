@extends('layouts.app')
@section('title')
마이페이지
@endsection
@section('style')
<style type="text/css">
/*	.content-header{
		/*border: 1px solid #108488;*/
		height: 40px;
	}
	#search_str{
		height: 40px;
		width: 300px;
	    border: 1px solid #dddd;
		border-radius: 5px;
	}
	.board-btn{
		height: 40px;
	    border: 1px solid #777;
		background: #777;
	}
	.board-btn:hover{
	    border: 1px solid #666;
		background: #666;

	}
	.dashboard-lists{
		margin: 10px 0px 0px 0px;
	}
	tr{
		border-bottom: 1px solid #dddd;
		border-radius: 10px;
		height: 50px;
		
	}
	.page-item .page-link{
		color: #999;
		border: none;
	}
	.active .page-link{
		color: #108488;
		background-color: white;
		text-decoration: underline;
		text-underline-position: under;
	}*/
</style>
@endsection

@section('content')
	<div class="content-header">

	</div>
	<div class="dashboard-lists" id="dashboard-lists">
		안녕하세요 {{ Auth::user()->email }}님.
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$(function(){

	});

	function getList(url = "/dashboard/list"){
		console.log("getList");
		var search_str = $("#search_str").val();
		var ajax_data = {
			'search_str': search_str,
		}

		$.ajax({    
			type : 'get',    
			url : url,
			data : ajax_data,    
			success : function(result) {
				$("#dashboard-lists").html(result);

				$(".pagination").unbind('click').on('click','.page-item a', function(e){
					var url = $(this).attr('href');
					console.log(url);
					e.preventDefault();
					getList(url);
				});
			},    
			error : function(request, status, error) {
				console.log(error)    
			}
		})
	}

	function openCreate(){
		var id = 0;
		var url = '/dashboard/' + id;
		window.open(url,'self');
	}
</script>
@endsection
