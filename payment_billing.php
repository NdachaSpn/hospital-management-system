

<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST["submitfullamount"]))
{
  $sql ="INSERT INTO billing_records(billingid,bill_amount,bill_date) values('$_GET[billingid]','$_GET[bill_amount]','$_POST[bill_date]')";
  if($qsql = mysqli_query($conn,$sql))
  {
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success 
            </h3>
            <p>Payment record inserted successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'patientreport.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
   //echo "<script>alert('payment record inserted successfully...');</script>";
 }
 else
 {
   echo mysqli_error($conn);
 }

 $sql ="INSERT INTO billing_records(billingid,bill_type_id,bill_type,bill_amount,bill_date) values('$_POST[billingid]','$_POST[bill_type_id]','$_POST[bill_type]','$_POST[bill_amount]','$_POST[bill_date]')";
 $qsql = mysqli_query($conn,$sql);
 echo mysqli_error($conn);

 echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[appointmentid]'</script>";
}
if(isset($_SESSION['patientid']))
{
  $sql="SELECT * FROM payment WHERE paymentid='$_GET[editid]' ";
  $qsql = mysqli_query($con,$sql);
  $rsedit = mysqli_fetch_array($qsql);
  
}

?>
<?php
if(isset($_GET['id']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="view-pending-appointment.php?delid=<?php echo $_GET['id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-pending-appointment.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Billing Amount</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Billing Amount</a>
</li>
<li class="breadcrumb-item"><a href="#">Billing Amount</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">

<div class="card">
<div class="card-header">
    <div class="col-sm-10">
    </div>
<!-- <h5>DOM/Jquery</h5>
<span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
</div>
<div class="card-block">
  <?php
      
    ?>
      <div class="table-responsive dt-responsive">
       

      <form method="post" action="">
        <div class="table-responsive dt-responsive">
          <table id="dom-jqry" class="table table-striped table-bordered nowrap">
            <thead>
            <tr>
              <th colspan="2">Patient Billing Amount</th>
            </tr>
          </thead>
            <tbody>
			<tr>
                <td>Patient Name</td>
                <td>  
            <select class="form-control" name="billingid" id="department" placeholder="Enter billingid...." required="">
                <option value="">-- Select One --</option>
                <?php
                    $sqldepartment= "SELECT * FROM billing LEFT JOIN patient ON billing.patientid=patient.patientid ";
                    $qsqldepartment = mysqli_query($conn,$sqldepartment);
                    while($rsdepartment=mysqli_fetch_array($qsqldepartment))
                    {
                      
                        echo "<option value='$rsdepartment[billingid]' selected>$rsdepartment[patientname]</option>";
                        

                    }
                ?>
            </select>
            <span class="messages"></span>
        </td>
              </tr>
			  <tr>
          <td>Billing Type</td>
          <td><select class="form-control" name="bill_type" id="bill_type" placeholder="Enter lastname...." required="">
                <option  disabled>-- Select One --</option>
                <option value="Consultancy Charge"> Consultancy Charge</option>
				<option value="Prescription charge"> Prescription charge</option>
				<option value="Treatment Cost"> Treatment Cost</option>
				
				<option value="Room Rent"> Room Rent</option>
				<option value="Service Charge"> Service Charge</option>
                       
            </select></td>
        </tr>
              <tr>
                <td>Balance amount</td>
                <td><input class="form-control" name="bill_amount" type="number" id="bill_amount">
				 <input class="form-control" type="hidden" name="bill_type_id" id="bill_type_id" value="<?php echo  $_SESSION["id"]; ?>" style="background-color:pink;" /></td>
              </tr>
			  
              <tr>
                <td>Bill date</td>
                <td><input class="form-control" name="bill_date" type="text" id="bill_date" value="<?php echo date("Y-m-d"); ?>" readonly></td>
              </tr>
			  
              
              <tr>
                <td colspan="2" align="center"><input class="form-control" type="submit" name="submitfullamount" id="submitfullamount" value="Submit" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>

    
</div>
</div>







</div>

</div>
</div>

<div id="#">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
      <!-- <button class="button button--success" data-for="js_success-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
     <!--  <button class="button button--error" data-for="js_error-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>