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
//login section

 $message = "";
use App\Classes\Profile;

 $id = $_SESSION['admin_id'];
 $adminInfo = Profile::getAdminInfoById($id);
 $admin = mysqli_fetch_assoc($adminInfo);



//  update user password
  if(isset($_POST['changePass'])){
    $message = Profile::updateadminPassword($_POST, $id);
  }
  if(isset($_POST['adminInfoUpdate'])){
    $message = Profile::updateAdminInfo($_POST, $id);
  }



?>


<?php  include("include/main-admin-dashboard.php") ?>

<main id="main" class="main">


    <div class="pagetitle">
      <h1>প্রোফাইল</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">হুম</a></li>
          <li class="breadcrumb-item active">প্রোফাইল</li>
        </ol>
        <h5 class="my-2"><?php echo $message; ?></h5>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-overview">ওভারভিউ</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">ইডিট প্রোফাইল</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-change-password">পাসওয়ার্ড পরিবর্তন </button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade  profile-overview" id="profile-overview">
                  <h5 class="card-title">প্রোফাইল ডিটেইলস</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label "> নাম</div>
                    <div class="col-lg-9 col-md-8"><b><?php echo $admin['name'] ?></b></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">Bangladesh</div>
                  </div>
                </div>


                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <!-- Profile Edit Form -->
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        
                      <label for="" class="col-md-4 col-lg-3 col-form-label">নাম</label>
                      <div class="col-md-8 col-lg-9 my-2">
                        
                        <div class="pt-2  ">
                          <input type="text" class="form-control" value="<?php echo $admin['name'] ?>" name="name">
                        </div>
                      </div>

                      <label for="" class="col-md-4 col-lg-3 col-form-label">প্রোফাইল ছবি</label>
                      <div class="col-md-8 col-lg-9 my-2">
                        <img src="<?php echo $admin['user_image'] ?>" alt="Profile">
                        <div class="pt-2">
                          <input type="file" class="btn btn-primary btn-sm" name="profile_image" title="Upload new profile image"><i class="bi bi-upload"></i>
                        </div>
                      </div>

                    </div>

          

                    <div class="text-center">
                      <button type="submit" name="adminInfoUpdate" class="btn btn-primary">আপডেট করুন</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div> 




                <div class="tab-pane fade show active pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="" method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">বর্তমান পাসওয়ার্ড <br> দিন</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" required type="password" class="form-control">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">নতুন পাসওয়ার্ড দিন</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" required type="password" class="form-control">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">পুনরায় পাসওয়ার্ড দিন</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" required type="password" class="form-control">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="changePass">আপডেট পাসওয়ার্ড</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?php echo $admin['user_image'] ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $admin['name'] ?></h2>

              <div class="social-links mt-2">
              </div>
            </div>
          </div>

        </div>
        
      </div>
    </section>

</main><!-- End #main -->

<?php  include("include/admin-footer.php") ?>