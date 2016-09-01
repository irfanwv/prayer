<?php

error_reporting(-1);
ini_set('display_errors', 'On');
include("../configuration.php");

require_once "tcp/tcpdf.php";

    $var_cls = new JConfig();
    $connlink = mysqli_connect($var_cls->host, $var_cls->user, $var_cls->password,$var_cls->db) or die("Connection Failure to Database");
 
 
  $db_prefix = $var_cls->dbprefix;

$select="select * from ".$db_prefix."users where id=42";
$result=mysqli_query($connlink,$select);
$count=mysqli_num_rows($result);
$row=mysqli_fetch_object($result);

$image='http://'.$_SERVER['HTTP_HOST'].'/rebatetool/components/com_calculator/img/profile_pics/'.$row->image;
$company_name=$row->company_name;
$company_address=$row->address;
$company_phone=$row->phone_number;
$company_email=$row->email;
$user_name=$row->name;

$interior_width="50";
$interior_height="50";
$imgcen="left";
   
$select2='select prop.project_name,prop.project_address,prop.email,prop.phone,prod_info.* from '.$db_prefix.'proposal as prop inner join '.$db_prefix.'project as prod_info on prop.id=prod_info.project_id where prop.id="1"';
$result2=mysqli_query($connlink,$select2);

 $tot_cost=''; $annual_energy_savings=''; $rebate_amt=''; $proj_name=''; $proj_address=''; $proj_email=''; $proj_phone='';
                            while($res=mysqli_fetch_assoc($result2)){
				
                                        $tot_cost=$tot_cost+(($res['product_cost'])*($res['new_quantity_fixtures']));
                                        $annual_energy_savings=$annual_energy_savings+$res['energy_savings'];
                                        $rebate=trim(str_replace("$",'',$res['rebate']));
                                        $rebate_amt=$rebate_amt+($rebate);
					$proj_name=$res['project_name'];
					$proj_address= $res['project_address'];
					$proj_email=$res['email'];
					$proj_phone=$res['phone'];
                            }
				
$pdflayout ='';


 $rebate_logo='http://'.$_SERVER['HTTP_HOST'].'/rebatetool/images/logo.png';
if($count>0){
	
	$select3="select * from  ".$db_prefix."project where project_id='1'";
	$result3=mysqli_query($connlink,$select3);
	while($res2=mysqli_fetch_assoc($result3)){
		
		 $prod_pic='http://'.$_SERVER['HTTP_HOST'].'/administrator/components/com_calculator/images/product/'.$res2['prod_pic'];
		

	 $pdflayout .= '    <div class="company" style="width:50%;float:left;padding-left:15px;padding-right:15px">
			    
			     <div><strong>Company Logo:&nbsp;</strong></div>
			     <div><strong>Company Name:&nbsp;</strong>'.$company_name.'</div>
			     <div><strong>Name:&nbsp;</strong>'.$user_name.',<strong>Address:&nbsp;</strong>'.$company_address.',<strong>Phone:&nbsp;</strong>'.$company_phone.',<strong>Email:&nbsp;</strong>'.$company_email.'</div>
			    </div>
			    
			       <p><strong>Name:&nbsp;</strong>'.$proj_name.'</p>
			       <p>'.$proj_address.','.$proj_email.','. $proj_phone.'</p>
			       <p><strong>Date:&nbsp;</strong></p>
			    
			    <div>
			       <div class="" style="width:33.3333%;float:left;padding-left:15px;padding-right:15px;"><strong>Total Project Cost:&nbsp;</strong>'. $tot_cost.'</div>
			       <div class="" style="width:33.3333%;float:left;padding-left:15px;padding-right:15px;"><strong>Annual Energy Savings:&nbsp;</strong>'. $annual_energy_savings.'</div>
			       <div class="" style="width:33.3333%;float:left;padding-left:15px;padding-right:15px;"><strong>Total Potential Rebate:&nbsp;</strong>'. $rebate_amt.'</div>
			    </div>

                          <div class="" style="margin-top:10px;position: relative;width: 120px;height: 120px;overflow: hidden;border: 5px solid #fff;-webkit-box-shadow: 0px -1px 13px 2px rgba(0,0,0,0.29);-moz-box-shadow: 0px -1px 13px 2px rgba(0,0,0,0.29);box-shadow: 0px -1px 13px 2px rgba(0,0,0,0.29);background: -moz-linear-gradient(left,#F0F0F0,#ffffff 10%,#ffffff 90%,#F0F0F0);background: -ms-linear-gradient(left,#F0F0F0,#ffffff 10%,#ffffff 90%,#F0F0F0);background: -o-linear-gradient(left,#F0F0F0,#ffffff 10%,#ffffff 90%,#F0F0F0);background: linear-gradient(left,#F0F0F0,#ffffff 10%,#ffffff 90%,#F0F0F0);">
                                <!--<img src="'.$prod_pic.'" style="position: absolute;left: 50%;top: 50%;height: 100%;width: auto;-webkit-transform: translate(-50%,-50%); -ms-transform: translate(-50%,-50%);transform: translate(-50%,-50%);" />-->
                          </div>      
                          
                          
                         <p>'.$res2['product_description'].'</p>   
                                <div class="" style="margin-top:5px"><strong>'. $res2['manufacturer_name'].'</strong></div>
                               <div class="" style="margin-top:5px"><strong>'. $res2['model_num'].'</strong></div>
			       <div style="width:50%;float:left;padding-left:0;padding-right:15px"><strong>Cost:&nbsp;</strong>'. $res2['product_cost'].'</div> <div style="width:50%;float:left;padding-left:0;padding-right:15px"><strong>Quantity:&nbsp;</strong>'. $res2['new_quantity_fixtures'].'</div>
                                <div class="" style="margin-top:25px;display:inline-block;width:100%"><strong class="" style="width:33.3333%;float:left;padding-left:0;padding-right:15px">Rebate:</strong>'. $res2['rebate'].'</div>
                               <!--<div class="" style="margin-top:5px;overflow:hidden"> <strong class="col-sm-4 noLeftPad" style="width:33.3333%;float:left;padding-left:15px;padding-right:15px">Total Rebate:</strong><div class="col-sm-8 subInnerBox">'.$res2['tot_rebate_amount'].'</div></div>--> 
                               <div class="" style="margin-top:5px;display:inline-block;width:100%"><strong class="" style="width:33.3333%;float:left;padding-left:0;padding-right:15px">Annual Energy Saving:</strong>'.$res2['annual_operating_hours'].'
                            </div>
</div>
<div class="" style="float:right;text-align:right;width:41.66666667%;margin-top:20px;">
	<p>Created using RebateTools</p>
    <p>www.rebatetools.com</p>
    <img src="'.$rebate_logo.'" alt="rebatetoolsLogo" width="50" height="50"/>
</div>';
	
	}
}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Rebate Tool');
$pdf->SetTitle('Rebate Tool');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->SetFont('times', 'BI', 12);
// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTML($pdflayout, true, false, false, false, '');

// ---------------------------------------------------------
$path='http://'.$_SERVER["HTTP_HOST"].'/Joomla_3.3/webservice/pdf/';
//Close and output PDF document
$pdf->Output('priyal.pdf', 'I');//saves data to your system in mentioned folder
//$pdf->Output('example.pdf', 'D');//prompts user to save data to your system

//============================================================+
// END OF FILE
//============================================================+
