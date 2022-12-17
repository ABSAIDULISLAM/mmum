<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>ডেশবোর্ড</span>
        </a>
      </li><!-- End Dashboard Nav -->

      
      
       <!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>শিক্ষার্থী ইনফো</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="add-class.php">
              <i class="bi bi-circle"></i><span>শ্রেনী / শাখা তৈরী</span>
            </a>
          </li>
          <li>
            <a href="manage-student.php">
              <i class="bi bi-circle"></i><span>শিক্ষার্থী তৈরী</span>
            </a>
          </li>
        </ul>
      </li>
       <!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>কমিটি কর্নার</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="create-commite.php">
              <i class="bi bi-circle"></i><span>কমিটি তৈরী</span>
            </a>
          </li>

           <!-- <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li> 
           -->
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>শিক্ষক / শিক্ষিকা কর্নার</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="manage-teacher.php">
              <i class="bi bi-circle"></i><span>শিক্ষক মেনেজ</span>
            </a>
          </li>
          <!-- <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li> -->
          
          
        </ul>
      </li> 
      

    </ul>

  </aside><!-- End Sidebar-->