<div class="row col-12">
	<div class="alert alert-danger displayNone" role="alert">
	</div>
</div>
<div class="row">
	<div class="col-12 form-control">
		<select name="coaches" id="coaches">
			<option >Please Select</option>
			<?php 	
				foreach ($cnames as  $value) {
					?>
					<option value="<?= $value->id ?>"><?= $value->name ?></option>
					<?php
				}
			 ?>
		</select>
	</div>
	<div class="col-12 form-control">
		<input type="date" id="cdate" name="cdate" onchange="onchangePopuulateValue()" >
	</div>
	<div class="col-12 form-control">
		<select name="timeslotss" id="timeslotss">
			<option></option>
		</select>
	</div>
	<div class="col-12 form-control">
		<button class="btn btn-primary" onclick="onclickSaveBooking()">book now</button>
	</div>
</div>
<script type="text/javascript">
	function onchangePopuulateValue() {
		var  datas = {
			"coaches": $("#coaches").val() , 
			"cdate":$("#cdate").val() , 
		}
		$('#timeslotss').empty()
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::$app->request->baseUrl. '/site/get-time-slots-by-param' ?>',
            dataType: "json",
            data:datas,
            success:function(data){
            	if (data.status=="ok"){
            		var dataa=data.response
	                $.each(dataa, function( index, value ) {
					 		$('#timeslotss').append('<option>'+value.slot_start_time+' - '+value.slot_end_time+'</option>')
					});
            	}
            	else{
            		$(".alert-danger").html('no time slots avaliable!!!').show().delay(5000).fadeOut();
            		// $('.alert.alert-danger').append('no time slots avaliable!!!')
            	}
            }
        });
	}
	function onclickSaveBooking() {
		var  datas = {
			"coaches": $("#coaches").val() , 
			"cdate":$("#cdate").val() , 
			"timeslotss":$("#timeslotss").val() , 
		}
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::$app->request->baseUrl. '/site/save-booking' ?>',
            dataType: "json",
            data:datas,
            success:function(data){
            	if (data.status=="ok"){
            		alert('success')
            	}
            	else{
            		$(".alert-danger").html('no time slots avaliable!!!').show().delay(5000).fadeOut();
            		// $('.alert.alert-danger').append('no time slots avaliable!!!')
            	}
            }
        });
	}
</script>
<style>
.displayNone{
	display:none;
}
</style>