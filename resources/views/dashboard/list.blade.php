<div>
	<table>
		<thead>
			<tr style="border-top: 1px solid #333333; border-bottom: 1px solid #333333; text-align: center;">
				<td width="80px">NO</td>
				<td width="800px">제목</td>
				<td width="180px">날짜</td>
			</tr>
		</thead>
		<tbody>
			@foreach($dashboards as $item)
			<tr>
				<td style="text-align: center;">{{ $item->id }}</td>
				<td onclick="edit({{ $item->id }})" style="cursor: pointer; padding-left: 10px">{{ $item->title }}</td>
				<td style="text-align: center;">{{ date("Y-m-d", json_decode($item->created_at)) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div style="padding-top: 10px">
		{{ $dashboards->links('pagination::bootstrap-4') }}
	</div>
</div>


<script type="text/javascript">
	function edit(id){
		var url = '/dashboard/' + id;
		window.open(url,'self');
	}
</script>