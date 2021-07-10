$(document).ready(function(){
	$('.dashboard').click(function(e){
		e.preventDefault();
		$('#dashboard').show();
		$('div #dashboard').siblings().hide();
		$('.dashboard').addClass('active').siblings().removeClass('active');
	});
	$('.house').click(function(e){
		e.preventDefault();
		$('#house').show();
		$('div #house').siblings().hide();
		$('.house').addClass('active').siblings().removeClass('active');
	});
	$('.tenant').click(function(e){
		e.preventDefault();
		$('#tenant').show();
		$('div #tenant').siblings().hide();
		$('.tenant').addClass('active').siblings().removeClass('active');
	});
	$('.payment').click(function(e){
		e.preventDefault();
		$('#payment').show();
		$('div #payment').siblings().hide();
		$('.payment').addClass('active').siblings().removeClass('active');
	});
	$('.print').click(function(e){
		e.preventDefault();
		$('#print').show();
		$('div #print').siblings().hide();
		$('.print').addClass('active').siblings().removeClass('active');
	});
	$('#addTenant').on('submit',function(e){
		e.preventDefault();
		$('.outputMsg').empty();
		if($('#house_series').val() !="" && $('#house_no').val() !="" && $('#tenant_name').val() !="" && $('#amount_paid').val() !="" && $('#service_charge_paid').val() !="" && $('#water_bill_paid').val() !="" && $('#tenants_payment_period').val() !=""){
			var house_series=$('#house_series').val();
			var house_no=$('#house_no').val();
			var tenant_name=$('#tenant_name').val();
			var amount_paid=$('#amount_paid').val();
			var service_charge_paid=$('#service_charge_paid').val();
			var water_bill_paid=$('#water_bill_paid').val();
			var tenants_payment_period=$('#tenants_payment_period').val();
			$.ajax({
				url:'house-action.php',
				type:'post',
				dataType:'json',
				data:{house_series:house_series,house_no:house_no,tenant_name:tenant_name,amount_paid:amount_paid,service_charge_paid:service_charge_paid,water_bill_paid:water_bill_paid,tenants_payment_period:tenants_payment_period,action:"addTenant"},
				success:function(data){
					$('.outputMsg').show();
					$('.outputMsg').append(data.tenant_added);
					$('#addTenant')[0].reset();
				}
			});
		}else{
			
		}
	});
	$('.outputMsg').hide();
	$('#addHouse').on('submit',function(e){
		e.preventDefault();
		$('.outputMsg').empty();
		if($('#new_house_series').val() !="" && $('#full_rent').val() !="" && $('#service_charge').val() !="" && $('#water_bill').val() !="" && $('#payment_period').val() !=""){
			var house_series=$('#new_house_series').val();
			var full_rent=$('#full_rent').val();
			var service_charge=$('#service_charge').val();
			var water_bill=$('#water_bill').val();
			var payment_period=$('#payment_period').val();
			$.ajax({
				url:'house-action.php',
				type:'post',
				dataType:'json',
				data:{house_series:house_series,full_rent:full_rent,service_charge:service_charge,water_bill:water_bill,payment_period:payment_period,action:"addHouse"},
				success:function(data){
					$('.outputMsg').show();
					$('.outputMsg').append(data.house_added);
					$('#addHouse')[0].reset();
				}
			});
		}else{
			
		}
	});
	$('#editPayment').on('submit',function(e){
		e.preventDefault();
		$('.outputMsg').empty();
		if($('#update_house_series').val() !="" && $('#new_payment').val() !="" && $('#update_payment_for').val() !="" && $('#update_payment_period').val() !=""){
			var house_series=$('#update_house_series').val();
			var new_payment=$('#new_payment').val();
			var update_payment_for=$('#update_payment_for').val();
			var update_payment_period=$('#update_payment_period').val();
			$.ajax({
				url:'house-action.php',
				type:'post',
				dataType:'json',
				data:{house_series:house_series,new_payment:new_payment,update_payment_for:update_payment_for,update_payment_period:update_payment_period,action:"updatePayment"},
				success:function(data){
					$('.outputMsg').show();
					$('.outputMsg').append(data.updates_made);
					$('#editPayment')[0].reset();
				}
			});
		}else{
			
		}
	});
	$('#makePayment').on('submit',function(e){
		e.preventDefault();
		$('.outputMsg').empty();
		if($('#building_no_payment').val() !="" && $('#house_no_payment').val() !="" && $('#tenant_payment').val() !="" && $('#payment_amount').val() !="" && $('#make_payment_for').val() !="" && $('#make_payment_period').val() !=""){
			var house_series=$('#building_no_payment').val();
			var tenant_name=$('#tenant_payment').val();
			var house_no=$('#house_no_payment').val();
			var amount_paid=$('#payment_amount').val();
			var payment_for=$('#make_payment_for').val();
			var payment_period=$('#make_payment_period').val();
			$.ajax({
				url:'house-action.php',
				type:'post',
				dataType:'json',
				data:{house_series:house_series,house_no:house_no,tenant_name:tenant_name,amount_paid:amount_paid,payment_for:payment_for,payment_period:payment_period,action:"makePayment"},
				success:function(data){
					$('.outputMsg').show();
					$('.outputMsg').append(data.payments_made);
					$('#makePayment')[0].reset();
				}
			});
		}else{
			
		}
	});
	$('#makeExpensePayment').on('submit',function(e){
		e.preventDefault();
		$('.outputMsg').empty();
		if($('#house_series_payment').val() !="" && $('#payment_description').val() !="" && $('#expense_payment_amount').val() !="" && $('#expense_payment_period').val()!=""){
			var house_series=$('#house_series_payment').val();
			var payment_description=$('#payment_description').val();
			var payment_amount=$('#expense_payment_amount').val();
			var payment_period=$('#expense_payment_period').val();
			$.ajax({
				url:'house-action.php',
				type:'post',
				dataType:'json',
				data:{house_series:house_series,payment_description:payment_description,payment_amount:payment_amount,payment_period:payment_period,action:"expensePayment"},
				success:function(data){
					$('.outputMsg').show();
					$('.outputMsg').append(data.expense_payments);
					$('#makeExpensePayment')[0].reset();
				}
			});
		}else{
			
		}
	});
	$('#printStatement').on('submit',function(e){
		e.preventDefault();
		if($('#building_print_option').val() !="" || $('#print_payment_period').val() !=""){
			var building=$('#building_print_option').val();
			var payment_period=$('#print_payment_period').val();
			$.ajax({
				url:'house-action.php',
				type:'post',
				dataType:'json',
				data:{building:building,payment_period:payment_period,action:"printStatement"},
				success:function(data){
					$('.outputMsg').show();
					$('.outputMsg').append(data.statement_message);
				}
			});
		}else{
			alert("Fill all");
		}
	});
	$('.getHouse').click(function(){
		var house_series=$(this).attr('data-houseNo');
		$('.outputHouseNo').empty();
		$('.outputNames').empty();
	    $.ajax({
			url:'house-action.php',
		    type:'post',
			dataType:'json',
			beforeSend:function(){
				$('.load_icon').show();
			},
			data:{house_series:house_series,action:"getHouseNo"},
			success:function(data){
				$('.load_icon').hide();
				$('.outputHouseNo').show();
				$('.outputHouseNo').append("<option>--Choose House No--</option>"+data.get_house_no);
				getName();
			}
		});
	});
	function getName(){
	$('.getName').click(function(){
		var house_no=$(this).attr('data-houseNo');
		$('.outputNames').empty();
	    $.ajax({
			url:'house-action.php',
		    type:'post',
			dataType:'json',
			beforeSend:function(){
				$('.load_icon').show();
			},
			data:{house_no:house_no,action:"getTenantName"},
			success:function(data){
				$('.load_icon').hide();
				$('.outputNames').show();
				$('.outputNames').append("<option>--Choose Tenant Name--</option>"+data.get_name);
			}
		});
	});
	}
});