<?php 
   include('house.php');
   $house=new house();
?>
<!DOCTYPE html>
<html>
<title>Rental Inventory</title>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="fontawesome-free-5.12.1-web/css/all.min.css">
<link rel="stylesheet" href="bootstrap-3.4.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="bootstrap-3.4.1/dist/js/bootstrap.min.js"></script>
<script src="js/house.js"></script>
</head>
<body>
<div class="container">
    <div class="sidenavs">
	<h2> Rental Inventory System</h2>
	<a href="#" class="dashboard"><span class="fa fa-tachometer-alt"></span> Dashboard</a>
	<a href="#" class="house"><span class="fa fa-building"></span> Houses</a>
	<a href="#" class="tenant"><span class="fa fa-user"></span> Tenants</a>
	<a href="#" class="payment"><span class="fa fa-coins"></span> Payments</a>
	<a href="#" class="print"><span class="fa fa-print"></span> Print Statement</a>
	</div>
	<div class="main">
    <div class="form-buttons">
	    <div id="dashboard">
		    <h3>Dashboard</h3>
			<div class="col-md-12">
			    <a class="col-md-3"><h3>Houses</h3><p style="text-align:center;color:lime;font-size:3em;"></p></a>
			    <a class="col-md-3"><h3>Occupied</h3></a>
			    <a class="col-md-3"><h3>Vacant</h3></a>
			</div>
			<div class="col-md-12">
			    <a class="col-md-2"><h3>Tenants</h3></a>
			    <a class="col-md-2"><h3>Arrears</h3></a>
			    <a class="col-md-2"><h3>Overpay</h3></a>
			    <a class="col-md-2"><h3>Cleared</h3></a>
			</div>
			<div class="col-md-12">
			    <a class="col-md-3"><h3>Expenses</h3></a>
			    <a class="col-md-3"><h3>Total Collection</h3></a>
			</div>
		</div>
	    <div id="house">
		    <h3>Houses</h3>
			<form id="addHouse" method="post">
		    <h1>Add Building</h1>
		    <div class="">
			    <input class="form-group" type="text" id="new_house_series" name="new_house_series" placeholder="Building(A,B,C..)">
				<input class="form-group" type="number" id="full_rent" name="full_rent" placeholder="Full Rent">
				<input class="form-group" type="number" id="service_charge" name="service_charge" placeholder="Service Charge">
				<input class="form-group" type="number" id="water_bill" name="water_bill" placeholder="Water Bill">
				<select id="payment_period" name="payment_period">
				    <option>--Choose Payment Period--</option>
				    <?php $getMonth=$house->months(); ?>
				</select>
				<input class="form-group" type="submit" value="Add Building">
			</div>
			<div class="outputMsg"></div>
		    </form>
		</div>	
		<div id="tenant">
		    <h3>Tenants</h3>
			<form id="addTenant" method="post">
		    <h1>Add Tenant</h1>
		    <div class="">
			    <input class="form-group" type="text" id="house_series" name="house_series" placeholder="Building(A,B,C..)">
			    <input class="form-group" type="text" id="house_no" name="house_no" placeholder="House Number(A1,B1,C2..)">
				<input class="form-group" type="text" id="tenant_name" name="tenant_name" placeholder="Full Names(Tenant)">
				<input class="form-group" type="number" id="amount_paid" name="amount_paid" placeholder="Amount Paid(Rent)">
				<input class="form-group" type="number" id="water_bill_paid" name="water_bill_paid" placeholder="Water Bill Paid">
				<input class="form-group" type="number" id="service_charge_paid" name="service_charge_paid" placeholder="Service Charge Paid">
				<select id="tenants_payment_period" name="tenants_payment_period">
				    <option>--Choose Payment Period--</option>
				    <?php $getMonth=$house->months(); ?>
				</select>
				<input class="form-group" type="submit" value="Add Tenant">
			</div>
			<div class="outputMsg"></div>
		    </form>
		</div>
		<div id="payment">
		    <h3>Payments</h3>
			<form id="editPayment" method="post">
		    <h1>Update Payment</h1>
		    <div class="">
			    <select id="update_payment_for" name="update_payment_for">
		            <option value="Rent">Rent</option>
		            <option value="Water Bill">Water Bill</option>
		            <option value="Service Charge">Service Charge</option>
	            </select>
				<select id="update_house_series" name="update_house_series">
				    <option>-Choose Building--</option>
		            <?php $house->getBuilding(); ?>
	            </select>
				<input class="form-group" type="number" id="new_payment" name="new_payment" placeholder="New payment Amount">
				<select id="update_payment_period" name="update_payment_period">
				    <option>--Choose Payment Period--</option>
				    <?php $getMonth=$house->months(); ?>
				</select>
				<input class="form-group" type="submit" value="Update Payment">
			</div>
			<div class="outputMsg"></div>
		    </form>
			<form id="makePayment" method="post">
		    <h1>Make Payment</h1>
		    <div class="">
			    <select id="make_payment_for" name="make_payment_for">
		            <option>--Payment For--</option>
		            <option value="Rent">Rent</option>
		            <option value="Water Bill">Water</option>
		            <option value="Service Charge">Service Charge</option>
	            </select>
				<select id="building_no_payment" name="building_no_payment">
				    <option>-Choose Building--</option>
		            <?php $house->getBuilding(); ?>
	            </select>
				<span style="display:none;" class="load_icon fas fa-spinner fa-spin"></span>
				<select style="display:none;" id="house_no_payment" name="house_no_payment" class="outputHouseNo"></select>
				<span style="display:none;" class="load_icon fas fa-spinner fa-spin"></span>
				<select style="display:none;" id="tenant_payment" name="tenant_payment" class="outputNames"></select>
				<input class="form-group" type="number" id="payment_amount" name="payment_amount" placeholder="Amount Paid">
				<select id="make_payment_period" name="make_payment_period">
				    <option>--Choose Payment Period--</option>
				    <?php $getMonth=$house->months(); ?>
				</select>
				<input class="form-group" type="submit" value="Make Payment">
			</div>
			<div class="outputMsg"></div>
		    </form>
			<form id="makeExpensePayment" method="post">
		    <h1>Expense Payment</h1>
		    <div class="">
			    <select id="house_series_payment" name="house_series_payment">
				    <option>-Choose Building--</option>
		            <?php $house->getBuilding(); ?>
	            </select>
				<textarea id="payment_description" name="payment_description" placeholder="Payment Description..."></textarea>
				<input class="form-group" type="number" id="expense_payment_amount" name="expense_payment_amount" placeholder="Amount Paid">
				<select id="expense_payment_period" name="expense_payment_period">
				    <option>--Choose Payment Period--</option>
				    <?php $getMonth=$house->months(); ?>
				</select>
				<input class="form-group" type="submit" value="Make Payment">
			</div>
			<div class="outputMsg"></div>
		    </form>
		</div>
		<div id="print">
		    <h3>Print</h3>
			<form id="printStatement" method="post">
		    <h1>Print Statement</h1>
		    <div class="">
			    <select id="building_print_option" name="building_print_option">
				    <option>-Choose Building--</option>
		            <?php $house->getBuilding(); ?>
	            </select>
				<select id="print_payment_period" name="print_payment_period">
				    <option>--Choose Payment Period--</option>
				    <?php $getMonth=$house->months(); ?>
				</select>
				<input class="form-group" type="submit" value="Print Statement">
			</div>
			<div class="outputMsg"></div>
		    </form>
			<div class="previous_statements">
			    <table>
				    <h4>Previous Statements</h4>
					<th>Statements</th> <th>Date Created</th> <th>Action</th>
					<tr class="new_statement"></tr>
					<?php
		                $house->previousStatements();
	                ?>
			    </table>
			</div>
		</div>
	</div>
    <?php 
	    /*include('house.php');
		$house=new house();
		$house_data = $house->getHouseData();*/
	?>
	</div>
</div>
</body>
</html>