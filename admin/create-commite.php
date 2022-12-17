<?php
session_start();
if(isset($_SESSION['admin_id'])==null){
      header('Location: ../index.php');
}


require_once("../vendor/autoload.php");
use App\Classes\Login;
if(isset($_GET['logout'])){
      Login::adminlogout();
}

// ==--login/ logout section==-
use App\Classes\AddClasses;
use App\Classes\DB;
use App\Classes\Student;
use App\Classes\Comite;

if(isset($_POST['addComity'])){
      Comite::addcomity($_POST);
}
if(isset($_GET['comiteDelete'])){
      $id = $_GET['comiteId'];
      Comite::deleteComityById($id);
}

// sodosso add
if(isset($_POST['addsodosso'])){
      Comite::addSodossoInfo($_POST);
}

?>


<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
      


<div class="container">
      <div class="row">
            <div class="col-md-6">
                        
                  <!-- modal for add class  -->
                  <div class="modal fade" id="addkcommitty" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">কমিটি তৈরী</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                              
                        <div class="modal-body">
                              <form action="" method="POST">
                                    <div class="form-group">
                                          <div class="card">
                                                <div class="card-body">
                                                      
                                                      <div class="form-group my-2">
                                                            <label for="">কমিটির নাম</label>
                                                            <input type="text" required name="comite_name" class="form-control mt-2">
                                                      </div>
                                                      
                                                </div>
                                          </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addComity">সংরক্ষন করুন</button>
                                    </div>
                                    </form>
                              </div>
                        </div>
                  </div>
            </div>


                       
      </div>
 </div>



      <div class="col-md-6">

            <!-- modal for add sodosso  -->
            <div class="modal fade" id="sodossoCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                        <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">সদস্য তৈরী</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <form action="" method="POST">
                                          <div class="card">
                                                <div class="card-body">
                                                      <div class="form-group row">
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">সদস্যের নাম</label>
                                                                        <input type="text" name="sodosso_name" required class="form-control">
                                                                  </div>
                                                            </div>
                                                            <?php
                                                            $cumityquery = mysqli_query(DB::con(), "SELECT * FROM comite");
                                                            ?>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">কমিটির নাম</label>
                                                                        <select name="comite_name" id="" class="form-select" >
                                                                        <?php while($comiteInfo = mysqli_fetch_assoc($cumityquery)){ ?>
                                                                              <option value="<?php echo $comiteInfo['id']?>"><?php echo $comiteInfo['comite_name']?></option>
                                                                              <?php } ?>
                                                                        </select>
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">কমিটির মোবাইল</label>
                                                                        <input type="number" name="sodosso_mobile" class="form-control" required>
                                                                  </div>
                                                            </div>
                                                            <?php
                                                            $query = mysqli_query(DB::con(), "SELECT * FROM session");
                                                            ?>
                                                            <div class="col-md-6">
                                                                  <div class="form-group py-2">
                                                                        <label for="">সেশন</label>
                                                                        <select name="comite_session" id="" class="form-select">
                                                                        <?php while($result = mysqli_fetch_assoc($query)){ ?>
                                                                        <option value="<?php  echo $result['id']?>"><?php  echo $result['session']?></option>
                                                                        <?php } ?>
                                                                        </select>
                                                                  </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                  <div class="form-group py-2">
                                                                        <label for="">কমিটির ঠিকানা</label>
                                                                        <textarea name="sodosso_address" id="" cols="5" rows="2" class="form-control"></textarea>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                </div>
                                          </div>
                                    <div class="text-end">
                                    <button type="submit" class="btn btn-primary" name="addsodosso">সংরক্ষন করুন</button>
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

 
                        


<div class="container">
      <div class="row">
            


      <div class="col-md-12 p-3 " style="background-color:#ebdcd5">
            <h4 class="text-center">সদস্যের তথ্যসমূহ</h4>
                        <div class="text-end">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#sodossoCreate" >সদস্য তৈরী করুন</button>
                        </div>
            <table class="table table-bordered table-hover" id="example">
            <thead class="text-start bg">
                  <tr>
                        <th>ক্রমিক</th>
                        <th>সদস্যের<br>নাম</th>
                        <th>কমিটির<br>নাম</th>
                        <th>মোবাইল</th>
                        <th>সময়কাল</th>
                        <th>স্টেটাস</th>
                        <th>একশন</th>
                  </tr>
            </thead>
            <?php
                 $query = mysqli_query(DB::con(), "SELECT sodosso.id, `sodosso_name`, comite.comite_name, `sodosso_mobile`, session.session, `sodosso_address`, `status`, `sodosso_images`, sodosso.created_at, `updated_at` FROM sodosso 
                 INNER JOIN comite ON sodosso.comite_id = comite.id
                 INNER JOIN session ON sodosso.session_id = session.id")
                 ?>
            <tbody class="text-start">
                  <?php
                  $i =1;
                  while($result = mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $result['sodosso_name'] ?></td>
                        <td><?php echo $result['comite_name'] ?></td>
                        <td><?php echo $result['sodosso_mobile'] ?></td>
                        <td><?php echo $result['session'] ?></td>
                        <td><?php echo $result['status']==1 ? "নিয়মিত" : "আগের" ?></td>
                        <td>
                              <a href="sodssoEdit.php?sodossoId=<?php echo $result['id'] ?>" class="btn btn-primary btn-sm" title="ইডিট"><i class="bi bi-pen"></i></a>
                              <a href="?shakhaDelete=true&&sodossoId=<?php echo $result['id'] ?>" onclick="return confirm('আপনি এই ডাটা ডিলেট করতে চাচ্ছেন')" class="btn btn-success btn-sm" title="ভিউ" ><i class="bi bi-eye"></i></a>
                        </td>
                  </tr>
                  <?php } ?>
            </tbody>
      </table>
            </div>

      
      
      <div class="col-md-12 p-3 mt-3" style="background-color:#f3e9e3">
            <h4 class="text-center">কমিটির তথ্যসমূহ</h4>
                        <div class="d-flex " style="justify-content:space-between;">
                              <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addkcommitty" >কমিটি তৈরী করুন</button>
                        
                              <!-- <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >সেশন তৈরী করুন </button> -->
                        </div>
            <table class="table table-bordered table-hover"  id="example2">
                              <thead class="text-center bg">
                                    <tr>
                                          <th>ক্রমিক নং.</th>
                                          <th>কমিটির নাম</th>
                                          <th>একশন</th>
                                    </tr>
                              </thead>
                              <?php
                              $query = mysqli_query(DB::con(), "SELECT * FROM comite")
                              ?>
                              <tbody class="text-center">
                                    <?php
                                    $i = 1;
                                    while($result = mysqli_fetch_assoc($query)){ ?>
                                    <tr>
                                          <td><?php echo $i++ ?></td>
                                          <td><?php echo $result['comite_name'] ?></td>
                                          <td>
                                                <a href="comiteEdit.php?comiteId=<?php echo $result['id'] ?>" class="btn btn-primary btn-sm" titl="ইডিট"><i class="bi bi-pen"></i></a>
                                                <a href="?comiteDelete=true&&comiteId=<?php echo $result['id'] ?>" onclick="return confirm('আপনি এই কমিটির ডাটা ডিলেট করতে চাচ্ছেন')" class="btn btn-danger btn-sm" title="ডিলিট"><i class="bi bi-trash"></i></a>
                                          </td>
                                    </tr>
                                    <?php } ?>
                              </tbody>
                        </table>                                                          
            </div>


      </div>
</div>




<style>
      .bg{
            background-color:#dedede;
      }
</style>




<script>
      $(document).ready(function () {
      $('#example').DataTable();
      $('#example2').DataTable();

      });
</script>



</main>

<!-- ======= footer ======= -->
<?php  include("include/admin-footer.php") ?>