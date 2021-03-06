<?php include('admin/include/User.php'); ?>
<?php 
$user = new User();
$userId = $_SESSION['userId'] ;


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Syntax</title>
<?php include('include/common-css.php'); ?>
<link src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
  <?php include('include/header.php');
    
/* *********Note List******** */
$data = array('action' => 'notes_by_category');
$data['data'] = array('userId' => $userId);
$url = $base_url."api/api.php";
$noteResult = $user->curlPost($url, $data) ;
//print_r($noteResult) ;
$noteList = $noteResult->data ; 
$contTnote = count($noteList) ;
   ?>
<section class="login first">
<div class="container">
         <div class="row">
      	
      	<div class=" col-md-12">
          	<div class="login-sec">
            <p>&nbsp;</p>
          		<h3>Note List</h3>
          	</div>
            <div class="emptyButton text-right"><button class="btn btn-danger del-all">Multiple Delete</button></div>
             
          	<div class="user-form login-user table-responsive">
              
              <?php if($contTnote > 0){ ?>            

          	  <table class="table table-bordered table-responsive table-striped" id="example">
    <thead>
      <tr>
      <th width="5%"><input type="checkbox" id="ckbCheckAll"></th>
      <th width="5%">SN.</th>
        <th width="20%">Title</th>
        <th width="13%">Category Name</th>
        <th width="15%">Date</th>
        <th width="12%" class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1 ;
      foreach ($noteList as $note) { ?>
        
     
      <tr>
      <td><input type="checkbox" class="checknote" value="<?=$note->id?>"></td>
      <td><?=$no++ ;?></td>
        <td><a href="<?=$base_url.'edit-note.php?id='.$note->id ;?>" style="color:#212529;"><?=$note->title ;?></a></td>
        <td><?=$note->catName ;?></td>
        <td><?=$note->createDate ;?></td>
        <td align="right"><a href="<?=$base_url.'edit-note.php?id='.$note->id ;?>" class="action-btn btn btn-sm btn-info mr-1"><i class="fa fa-eye"></i></a><a href="#" onclick="delete_record('<?=$note->id?>')" class="action-btn btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
        
      </tr>
      <?php  } ?>
     

    </tbody>
  </table>
<?php  }else{ ?>
<div class="noResult"> Note List Empty </div>

<?php } ?>
          	</div>
          </div>
      </div>
      </div>
      </section>
  <?php include('include/common-js.php'); ?> 
  
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="js/jquery.dataTables.min.js"></script>
 <script src="js/dataTables.bootstrap4.min.js"></script>

 <script>
  $(document).on('click','#ckbCheckAll', function(){
    if($(this). prop("checked") == true){
      $('.checknote').prop('checked', true) ;
    }else{
     $('.checknote').prop('checked', false) ;
    }   

  });

  $(document).on('click', '.del-all', function(){    
    var allVals = [] ;
    $('.checknote:checked').each(function(){
     // alert("ffffff") ;
      allVals.push($(this).val());
    });
    if(allVals.length <= 0){
      alert("Please Select Note");
    }else{
      if(confirm("Are you sure you want to delete selected note ?") == true){
       var allVal = allVals.join() ;
        $.ajax({
      type: "POST",
      url: "<?=$base_url?>ajaxFunction.php",
      data:{'action':'delAll', 'noteId':allVal},
      success: function(data){
        //alert(data) ;
        location.reload() ;
      }
    });

      }
    }
    
    
  });

 </script>
 <script>
 $(document).ready(function() {
    $('#example').DataTable();
} );
 </script>

  <script type="text/javascript">
    function delete_record(noteId) 
{
 // alert(noteID) ;
    var conf= confirm("Do you really want delete?");
    if (conf== true){
      $.ajax({     
    type: "POST",
    url: "<?=$base_url ;?>ajaxFunction.php",
    data:{'action':'delete','noteId':noteId},
    success: function(data){
    location.reload() ;

    }
    }); 

    }else{
      return;
    }
}
  </script>
  <style>
  
  </style>

</body>
</html>