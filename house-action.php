<?php
include("house.php");
$house=new house();
if($_POST['action']=="addHouse"){
	$houseSeries=$_POST['house_series'];
	$fullRent=$_POST['full_rent'];
	$serviceCharge=$_POST['service_charge'];
	$waterBill=$_POST['water_bill'];
	$paymentPeriod=$_POST['payment_period'];
	$added_house=$house->addHouse($houseSeries,$fullRent,$serviceCharge,$waterBill,$paymentPeriod);
	$data = array(
		"house_added" => $added_house			
	);
	echo json_encode($data);
}
if($_POST['action']=="addTenant"){
	$houseSeries=$_POST['house_series'];
	$houseNo=$_POST['house_no'];
	$tenantName=$_POST['tenant_name'];
	$amountPaid=$_POST['amount_paid'];
	$serviceChargePaid=$_POST['service_charge_paid'];
	$waterBillPaid=$_POST['water_bill_paid'];
	$tenantsPaymentPeriod=$_POST['tenants_payment_period'];
	$added_tenant=$house->addTenant($houseSeries,$houseNo,$tenantName,$amountPaid,$serviceChargePaid,$waterBillPaid,$tenantsPaymentPeriod);
	$data = array(
		"tenant_added" => $added_tenant			
	);
	echo json_encode($data);
}
if($_POST['action']=="updatePayment"){
	$houseSeries=$_POST['house_series'];
	$newPayment=$_POST['new_payment'];
	$updatePaymentFor=$_POST['update_payment_for'];
	$updatePaymentPeriod=$_POST['update_payment_period'];
	$updated_payment=$house->updatePayment($houseSeries,$newPayment,$updatePaymentFor,$updatePaymentPeriod);
	$data = array(
		"updates_made" => $updated_payment			
	);
	echo json_encode($data);
}
if($_POST['action']=="makePayment"){
	$houseSeries=$_POST['house_series'];
	$houseNo=$_POST['house_no'];
	$tenantName=$_POST['tenant_name'];
	$amountPaid=$_POST['amount_paid'];
	$paymentFor=$_POST['payment_for'];
	$paymentPeriod=$_POST['payment_period'];
	$payment_made=$house->makePayment($houseSeries,$houseNo,$tenantName,$amountPaid,$paymentFor,$paymentPeriod);
	$data = array(
		"payments_made" => $payment_made		
	);
	echo json_encode($data);
}
if($_POST['action']=="expensePayment"){
	$houseSeries=$_POST['house_series'];
	$paymentDescripton=$_POST['payment_description'];
	$paymentAmount=$_POST['payment_amount'];
	$paymentPeriod=$_POST['payment_period'];
	$payment_made=$house->expensePayment($houseSeries,$paymentDescripton,$paymentAmount,$paymentPeriod);
	$data = array(
		"expense_payments" => $payment_made		
	);
	echo json_encode($data);
}
if($_POST['action']=="printStatement"){
	$houseSeries=$_POST['building'];
	$paymentPeriod=$_POST['payment_period'];
	$print_statement=$house->printStatement($houseSeries,$paymentPeriod);
	$data = array(
		"statement_message" => $print_statement		
	);
	echo json_encode($data);
}
if($_POST['action']=="getHouseNo"){
	$houseSeries=$_POST['house_series'];
	$house_no=$house->getHouseNumbers($houseSeries);
	$data = array(
		"get_house_no" => $house_no		
	);
	echo json_encode($data);
}
if($_POST['action']=="getTenantName"){
	$houseNo=$_POST['house_no'];
	$tenant_name=$house->getTenantName($houseNo);
	$data = array(
		"get_name" => $tenant_name		
	);
	echo json_encode($data);
}
?>