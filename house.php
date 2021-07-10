<?php
class house{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "houses";      
    private $houseDetails = 'house_details';
    private $tenantData = 'tenant_data';
    private $expenseData = 'expenses';
    private $Statements = 'statement';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	public function getHouseData(){
		$t=time();
		$month=date("M",$t);
		$getBuildingData=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->houseDetails." WHERE payment_period='".$month."'");
		foreach($getBuildingData as $row){
			
		}
		
	}
	public function addHouse($house_series,$full_rent,$service_charge,$water_bill,$payment_period){
		$houseSeries=$this->validate_data($house_series);
		$fullRent=$this->validate_data($full_rent);
		$serviceCharge=$this->validate_data($service_charge);
		$waterBill=$this->validate_data($water_bill);
		$paymentPeriod=$this->validate_data($payment_period);
		$confirmHouse=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->houseDetails." WHERE house_series='".$houseSeries."' && payment_period='".$paymentPeriod."' && year=now() LIMIT 1");
		if(mysqli_num_rows($confirmHouse)==1){
			$house_added="<span class='alert alert-danger'>House with the same period already exists</span>";
		}else{
			//$currentYear=date("Y", strtotime(now()));
		    $insertHouse="INSERT INTO ".$this->houseDetails."(house_series,full_rent,service_charge,water_bill,payment_period,year,datetime) VALUES('".$houseSeries."','".$fullRent."','".$serviceCharge."','".$waterBill."','".$paymentPeriod."',now(),now())";
		    $result=mysqli_query($this->dbConnect, $insertHouse);
		    if(!$result){
			    return ('Error in query: '. mysqli_error());
		    } else {
			    $house_added = "<span class='alert alert-success'>House ".$house_series." has been successfully inserted</span>";	
		    }
	    }
		return $house_added;
	}
	public function addTenant($house_series,$house_no,$tenant_name,$amount_paid,$service_charge_paid,$water_bill_paid,$tenants_payment_period){
		$houseSeries=$this->validate_data($house_series);
		$houseNo=$this->validate_data($house_no);
		$tenantName=$this->validate_data($tenant_name);
		$amountPaid=$this->validate_data($amount_paid);
		$serviceCharge=$this->validate_data($service_charge_paid);
		$waterBill=$this->validate_data($water_bill_paid);
		$paymentPeriod=$this->validate_data($tenants_payment_period);
		$confirmTenant=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->tenantData." WHERE house_no='".$houseNo."' && payment_period='".$paymentPeriod."' && year=now() LIMIT 1");
		if(mysqli_num_rows($confirmTenant)==1){
			$tenant_added="<span class='alert alert-danger'>House Number ".$houseNo." has been occupied</span>";
		}else{
		    $insertTenant="INSERT INTO ".$this->tenantData."(house_series,house_no,name,amount_paid,service_charge,water_bill,payment_period,year,datetime) VALUES('".$houseSeries."','".$houseNo."','".$tenantName."','".$amountPaid."','".$serviceCharge."','".$waterBill."','".$paymentPeriod."',now(),now())";
		    $result=mysqli_query($this->dbConnect, $insertTenant);
		    if(!$result){
			    return ('Error in query: '. mysqli_error());
		    } else {
			    $tenant_added = "<span class='alert alert-success'>".$tenantName." has been successfully added to house number ".$houseNo."</span>";	
		    }
	    }
		return $tenant_added;
	}
	public function updatePayment($house_series,$new_payment,$payment_for,$payment_period){
		$houseSeries=$this->validate_data($house_series);
		$newPayment=$this->validate_data($new_payment);
		$paymentFor=$this->validate_data($payment_for);
		$paymentPeriod=$this->validate_data($payment_period);
		$confirmHouse=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->houseDetails." WHERE house_series='".$houseSeries."' && payment_period='".$paymentPeriod."' && year=now()");
		if(mysqli_num_rows($confirmHouse)>0){
			switch($paymentFor){
                case "Rent":
		            $updatePayment="UPDATE ".$this->houseDetails." SET full_rent='".$newPayment."',datetime=now() WHERE house_series='".$houseSeries."' && payment_period='".$paymentPeriod."' && year=now()";
		            $result=mysqli_query($this->dbConnect, $updatePayment);
		            if(!$result){
			            return ('Error in query: '. mysqli_error());
		            } else {
			            $payment_updates = "<span class='alert alert-success'>Rent amount for ".$houseSeries." has been successfully updated</span>";	
		            }
		        break;
		
		        case "Service Charge":
		            $updatePayment="UPDATE ".$this->houseDetails." SET service_charge='".$newPayment."',datetime=now() WHERE house_series='".$houseSeries."' && payment_period='".$paymentPeriod."' && year=now()";
		            $result=mysqli_query($this->dbConnect, $updatePayment);
		            if(!$result){
			            return ('Error in query: '. mysqli_error());
		            } else {
			            $payment_updates = "<span class='alert alert-success'>Service charge amount for ".$houseSeries." has been successfully updated</span>";	
		            }
		        break;
		      
		        case "Water Bill":
		            $updatePayment="UPDATE ".$this->houseDetails." SET water_bill='".$newPayment."',datetime=now() WHERE house_series='".$houseSeries."' && payment_period='".$paymentPeriod."' && year=now()";
		            $result=mysqli_query($this->dbConnect, $updatePayment);
		            if(!$result){
			            return ('Error in query: '. mysqli_error());
		            } else {
			            $payment_updates = "<span class='alert alert-success'>Water bill amount for ".$houseSeries." has been successfully updated</span>";	
		            }   
		        break;
		    }
		}else{
		    $payment_updates="<span class='alert alert-danger'>House ".$houseSeries." does not exist</span>";
	    }
		return $payment_updates;
	}
	public function makePayment($house_series,$house_no,$tenant_name,$amount_paid,$payment_for,$payment_period){
		$houseSeries=$this->validate_data($house_series);
		$houseNo=$this->validate_data($house_no);
		$tenantName=$this->validate_data($tenant_name);
		$amountPaid=$this->validate_data($amount_paid);
		$paymentFor=$this->validate_data($payment_for);
		$paymentPeriod=$this->validate_data($payment_period);
		$confirmHouse=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->tenantData." WHERE house_series='".$houseSeries."' && house_no='".$houseNo."' && name='".$tenantName."' && payment_period='".$paymentPeriod."' && year=now() LIMIT 1");
		if(mysqli_num_rows($confirmHouse)==1){
			foreach($confirmHouse as $row){
			    switch($paymentFor){
				    case "Rent":
			            $total=$row['amount_paid']+$amountPaid;
				        $makePayment="UPDATE ".$this->tenantData." SET amount_paid='".$total."' WHERE house_series='".$houseSeries."' && house_no='".$houseNo."' && name='".$tenantName."' && payment_period='".$paymentPeriod."' && year=now()";
		                $result=mysqli_query($this->dbConnect, $makePayment);
		                if(!$result){
			                return ('Error in query: '. mysqli_error());
		                } else {
			                $payment_updates = "<span class='alert alert-success'>Rent payment for ".$houseNo." was successful</span>";	
		                }
				    break;
				
				    case "Water Bill":
			            $total=$row['water_bill']+$amountPaid;
				        $makePayment="UPDATE ".$this->tenantData." SET water_bill='".$total."' WHERE house_series='".$houseSeries."' && house_no='".$houseNo."' && name='".$tenantName."' && payment_period='".$paymentPeriod."' && year=now()";
		                $result=mysqli_query($this->dbConnect, $makePayment);
		                if(!$result){
			                return ('Error in query: '. mysqli_error());
		                } else {
			                $payment_updates = "<span class='alert alert-success'>Water Bill payment for ".$houseNo." was successful</span>";	
		                }
				    break;
				
				    case "Service Charge":
			            $total=$row['service_charge']+$amountPaid;
				        $makePayment="UPDATE ".$this->tenantData." SET service_charge='".$total."' WHERE house_series='".$houseSeries."' && house_no='".$houseNo."' && name='".$tenantName."' && payment_period='".$paymentPeriod."' && year=now()";
		                $result=mysqli_query($this->dbConnect, $makePayment);
		                if(!$result){
			                return ('Error in query: '. mysqli_error());
		                } else {
			                $payment_updates = "<span class='alert alert-success'>Service Charge for ".$houseNo." was successful</span>";	
		                }
				    break;
				}	
			}
			
		}else{
			switch($paymentFor){
				case "Rent":
				    $makePayment="INSERT INTO ".$this->tenantData."(house_series,house_no,name,amount_paid,payment_period,year,datetime) VALUES('".$houseSeries."','".$houseNo."','".$tenantName."','".$amountPaid."','".$paymentPeriod."',now(),now())";
				    $result=mysqli_query($this->dbConnect, $makePayment);
		                if(!$result){
			                return ('Error in query: '. mysqli_error());
		                } else {
			                $payment_updates = "<span class='alert alert-success'>Rent for ".$houseNo." was successfully inserted</span>";	
		                }
				break;
				
				case "Water Bill":
				    $makePayment="INSERT INTO ".$this->tenantData."(house_series,house_no,name,water_bill,payment_period,year,datetime) VALUES('".$houseSeries."','".$houseNo."','".$tenantName."','".$amountPaid."','".$paymentPeriod."',now(),now())";
				    $result=mysqli_query($this->dbConnect, $makePayment);
		                if(!$result){
			                return ('Error in query: '. mysqli_error());
		                } else {
			                $payment_updates = "<span class='alert alert-success'>Water bill for ".$houseNo." was successfully inserted</span>";	
		                }
				break;
				
				case "Service Charge":
				    $makePayment="INSERT INTO ".$this->tenantData."(house_series,house_no,name,service_charge,payment_period,year,datetime) VALUES('".$houseSeries."','".$houseNo."','".$tenantName."','".$amountPaid."','".$paymentPeriod."',now(),now())";
				    $result=mysqli_query($this->dbConnect, $makePayment);
		                if(!$result){
			                return ('Error in query: '. mysqli_error());
		                } else {
			                $payment_updates = "<span class='alert alert-success'>Service Charge for ".$houseNo." was successfully inserted</span>";	
		                }
				break;
			}
		    $payment_updates="<span class='alert alert-danger'>The query is wrong</span>";
	    }
		return $payment_updates;
	}
	public function expensePayment($house_series,$payment_description,$payment_amount,$payment_period){
		$houseSeries=$this->validate_data($house_series);
		$paymentDescription=$this->validate_data($payment_description);
		$paymentAmount=$this->validate_data($payment_amount);
		$paymentPeriod=$this->validate_data($payment_period);
		$makePayment="INSERT INTO ".$this->expenseData."(house_series,payment_description,payment_amount,payment_period,datetime,year) VALUES('".$houseSeries."','".$paymentDescription."','".$paymentAmount."','".$paymentPeriod."',now(),now())";
		$result=mysqli_query($this->dbConnect, $makePayment);
		    if(!$result){
			    return ('Error in query: '. mysqli_error());
		    } else {
			     $payment_updates = "<span class='alert alert-success'>Expense payment was successful</span>";	
		    }
		return $payment_updates;
	}
	public function printStatement($house_series,$payment_period){
		$t=time()+7200;
        $time=date("l\, F d Y\, h:i:s A", $t);
		$houseSeries=$this->validate_data($house_series);
		$paymentPeriod=$this->validate_data($payment_period);
		$print="SELECT * FROM ".$this->tenantData." WHERE house_series='".$houseSeries."' && payment_period='".$paymentPeriod."'";
		$result=mysqli_query($this->dbConnect, $print);
		    if(!$result){
			    return ('Error in query: '. mysqli_error());
		    } else {
				if(mysqli_num_rows($result)>0){
					
					$print_update = "<span class='alert alert-success'>Statement has been successfully printed</span>";
					foreach($result as $row){
						$payments=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->houseDetails." WHERE house_series='".$row['house_series']."' && payment_period='".$row['payment_period']."'");
						foreach($payments as $rowPayment){
							if($rowPayment['full_rent']>$row['amount_paid']){
								$rentArrear=$rowPayment['full_rent']-$row['amount_paid'];
								$totalRentArrear+=$rentArrear;
							}
							if($rowPayment['service_charge']>$row['service_charge']){
								$serviceChargeArrear=$rowPayment['service_charge']-$row['service_charge'];
								$totalServiceChargeArrear+=$serviceChargeArrear;
							}
							if($rowPayment['water_bill']>$row['water_bill']){
								$waterArrear=$rowPayment['water_bill']-$row['water_bill'];
								$totalWaterArrear+=$waterArrear;
							}
						}
						
						$tenant .="<tr><td>".ucfirst($row['house_no'])."</td><td>".ucfirst($row['name'])."</td><td>".$row['amount_paid']."</td><td>".$rentArrear."</td><td>".$row['service_charge']."</td><td>".$serviceChargeArrear."</td><td>".$row['water_bill']."</td><td>".$waterArrear."</td></tr>";
					    $building=ucfirst($row['house_series']);
						$rent +=$row['amount_paid'];
					    $water +=$row['water_bill'];
					    $service +=$row['service_charge'];
					    $total="<tr><th>Total</th><td>=</td><td>".$rent."</td><td>".$totalRentArrear."</td><td>".$service."</td><td>".$totalServiceChargeArrear."</td><td>".$water."</td><td>".$totalWaterArrear."</td></tr>";
					}
					require_once('tcpdf/config/lang/eng.php');
                    require_once('tcpdf/tcpdf.php');
                    // create new PDF document
                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    // set document information
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor('Nicola Asuni');
                    $pdf->SetTitle('TCPDF Example 001');
                    $pdf->SetSubject('TCPDF Tutorial');
                    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
                    // set default monospaced font
                    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
					//set margins
                    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                    //set auto page breaks
                    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                    //set image scale factor
                    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                    //set some language-dependent strings
                    $pdf->setLanguageArray($l);
                    // ---------------------------------------------------------
                    // set default font subsetting mode
                    $pdf->setFontSubsetting(true);
                    // Set font
                    // dejavusans is a UTF-8 Unicode font, if you only need to
                    // print standard ASCII chars, you can use core fonts like
                    // helvetica or times to reduce file size.
                    $pdf->SetFont('times', '', 14, '', true);
                    // Add a page
                    // This method has several options, check the source code documentation for more information.
                    $pdf->AddPage();
					$titling=<<<EOD
					<strong> <font style="font-size:11">GMG PROPERTIES LIMITED </font> </strong><br>
                    P.O BOX 30144-00100, G.P.O Nairobi,<br> Tel: +254721717252, <br> Email: gmgproperties20@gmail.com, <br> Building: Kindaruma Court, Street: Kindaruma, Ngong Road.
                    <br>---------------------------------------------------------
EOD;
					$ddt=<<<EOD
					$time
					<p><strong><font style="font-size:14">Return For The Month Of $paymentPeriod for building $building</font></strong></p>
					
EOD;
					$html = <<<EOD
					<table border="1">
					    <tr><th>House</th><th>Tenant Name</th><th>Rent</th><th>Bal</th><th>Service Charge</th><th>Bal</th><th>Water Bill</th><th>Bal</th></tr>
					    $tenant
						$total
					</table>
                    
EOD;
                    // Print text using writeHTMLCell()
					$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $titling, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);
                    $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $ddt, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);
                    $pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='C', $autopadding=true);
					// ---------------------------------------------------------
                    // Close and output PDF document
                    // This method has several options, check the source code documentation for more information.
                    $statement="Building-".$building."-".$paymentPeriod."-".date("D-M-Y@h-i-sA",$t)."-Return.pdf";
					$pdf->Output('statements/'.$statement.'', 'F');
					$checkStatement=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->Statements." WHERE statement='".$statement."' LIMIT 1");
						if(mysqli_num_rows($checkStatement)==1){
							$printed=mysqli_query($this->dbConnect,"UPDATE ".$this->Statements." SET datetime=now() WHERE statement='".$statement."'");
						}else{
							$printed=mysqli_query($this->dbConnect,"INSERT INTO ".$this->Statements."(house_series,payment_period,statement,datetime) VALUES('".$houseSeries."','".$paymentPeriod."','".$statement."',now())");
						}
						$print_update="<td><a>".$statement."</a></td><td>".date("D,d-M-Y H-i A",$t)."</td><td><a href='statements/".$statement."' class='fa fa-download' download></a></td>";
				}else{
					$print_update = "<span class='alert alert-danger'>Statement for building ".$houseSeries." in ".$paymentPeriod." period cannot be found</span>";
				}	
		    }
		return $print_update;
	}
	public function months(){
		$month=array("January","February","March","April","May","June","July","August","September","October","November","December");
		foreach($month as $getMonth){
			echo "<option value='".$getMonth."'>".$getMonth."</option>";
		}
	}
	public function getBuilding(){
		$building=mysqli_query($this->dbConnect,"SELECT DISTINCT house_series FROM ".$this->houseDetails."");
		foreach($building as $row){
			echo "<option class='getHouse' data-houseNo='".$row['house_series']."' value='".$row['house_series']."'>".ucfirst($row['house_series'])."</option>";
		}
	}
	public function getHouseNumbers($house_series){
		$house="";
		$houseSeries=$this->validate_data($house_series);
		$houseNumbers=mysqli_query($this->dbConnect,"SELECT DISTINCT house_no FROM ".$this->tenantData." WHERE house_series='".$houseSeries."'");
		if(mysqli_num_rows($houseNumbers)>0){
		foreach($houseNumbers as $row){
			$house .="<option class='getName' data-houseNo='".$row['house_no']."' value='".$row['house_no']."'>".ucfirst($row['house_no'])."</option>";
		}
	    }else{
			$house .="<option>There is no house number in this building</option>";
		}
		return $house;
	}
	public function getTenantName($house_no){
		$name="";
		$houseNo=$this->validate_data($house_no);
		$tenantName=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->tenantData." WHERE house_no='".$houseNo."'");
		if(mysqli_num_rows($tenantName)>0){
		foreach($tenantName as $row){
			$name .="<option value='".$row['name']."'>".$row['name']."</option>";
		}
		}else{
			$name .="<option>House number not occupied</option>";
		}
		return $name;
	}
	public function previousStatements(){
		$statement=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->Statements." ORDER BY datetime DESC LIMIT 10");
		if(!$statement){
			return "Error in query:".mysqli_error();
		}else{
			foreach($statement as $row){
				echo "<tr class='new_statement'><td><a>".$row['statement']."</a></td><td>".date("D,d-M-Y H-i A",strtotime($row['datetime']))."</td><td><a href='statements/".$row['statement']."' class='fa fa-download' download></a></td></tr>";
				
			}
		}
	}
	public function validate_data($data){
	    $data=trim($data);
	    $data=stripslashes($data);
	    $data=strip_tags($data);
	    $data=htmlspecialchars($data);
		$data=mysqli_real_escape_string($this->dbConnect,$data);
	    return $data;
    }
}
?>