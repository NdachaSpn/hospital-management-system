<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="INSERT INTO treatment_records(treatmentid,appointmentid,patientid,doctorid,treatment_description,status)values('$_POST[treatmentid]','$_POST[appointmentid]','$_POST[patientid]','$_POST[doctorid]','$_POST[treatment_description]','$_POST[status]')";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success 
                </h3>
                <p>Doctor Record Updated Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'view-doctor.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }   
    }
    else
    {
        
        $sql ="INSERT INTO treatment_records(treatmentid,appointmentid,treatmentid,patientid,doctorid,treatment_description,status) values('$_POST[treatmentid]','$_POST[appointmentid]','$_POST[treatmentid]','$_POST[patientid]','$_POST[doctorid]','$_POST[treatment_description]','$_POST[status]')";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Success 
                </h3>
                <p>Doctor Record Inserted Successfully</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'view-doctor.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
}
if(isset($_GET['editid']))
{
    $sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);
    
}

?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Treatment Record</h4>
<!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="dashboard.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Treatment Record</a>
</li>
</li>
</ul>
</div>
</div>
</div>
</div>


<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<!-- <h5>Basic Inputs Validation</h5>
<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
</div>
<div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">
    
    <div class="form-group row">
        
        <div class="col-sm-4">
            <input type="hidden" class="form-control" name="appointmentid" id="doctorname" placeholder="Enter name...." required=""  value="<?php if(isset($_GET['editid'])) { echo $rsedit['appointmentid']; } ?>" >
            <span class="messages"></span>
        </div>

        
        <div class="col-sm-4">
            <input type="hidden" class="form-control" name="patientid" id="mobilenumber" placeholder="Enter mobilenumber...." required="" value="<?php if(isset($_GET['editid'])) { echo $rsedit['patientid']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Treatment</label>
        <div class="col-sm-4">
            <select class="form-control" name="treatmentid" id="department" placeholder="Enter lastname...." required="">
                <option value="">-- Select One --</option>
                <?php
                    $sqldepartment= "SELECT * FROM treatment";
                    $qsqldepartment = mysqli_query($conn,$sqldepartment);
                    while($rsdepartment=mysqli_fetch_array($qsqldepartment))
                    {
                       if($rsdepartment[treatmentid] == $rsedit[treatmentid])
                       {
                        echo "<option value='$rsdepartment[treatmentid]' selected>$rsdepartment[treatmenttype]</option>";
                        }
                        else
                        {
                            echo "<option value='$rsdepartment[treatmentid]'>$rsdepartment[treatmenttype]</option>";
                        }

                    }
                ?>
            </select>
            <span class="messages"></span>
        </div>

         <label class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-4">
            <textarea class="form-control" name="treatment_description" id="mobilenumber" placeholder="Enter Description...." required=""></textarea>
            <span class="messages"></span>
        </div>
        <div class="col-sm-4">
            <input class="form-control" type="hidden" name="appointmentid" id="loginid" value="<?php if(isset($_GET['editid'])){ echo $rsedit['appointmentid'];} ?>"/>
            <span class="messages"></span>
        </div>
    </div>


    <div class="form-group row">
       
        <div class="col-sm-4">
            <input class="form-control" type="hidden" name="doctorid" id="education" value="<?php 
            if(isset($_GET['editid'])) { echo $rsedit['doctorid']; } ?>" />
        </div>

    </div>

    <div class="form-group row">
             

        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-4">
            <select name="status" id="status" class="form-control" required="">
                <option value="">-- Select One -- </option>
                <option value="Active" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Active') { echo 'selected'; } } ?>>Active</option>
                <option value="Inactive" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Inactive') { echo 'selected'; } } ?>>Inactive</option>
            </select>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php');?>

<script type="text/javascript">
    $('#main').keyup(function(){
        $('#confirm-pw').html('');
    });

    $('#cnfirmpassword').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });

    $('#password').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });
</script>