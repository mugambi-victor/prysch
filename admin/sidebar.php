<!-- <link rel="stylesheet" href="sidebar.css"> -->
<style>
   
   ul.nav {
    background: #051094;
    height: 100%;
    
}
li{
   width:100%;
}

.col-md-2 {
    margin-top:8.5rem;
    position: fixed;
    height: 100%;
    transition: 1s;
}
a:hover {
  animation: bounce 1s infinite;
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
    
  }
}
</style>


        <div class="col-md-2 sidebar " id="collapseExample">

            <ul class="nav navbar-light flex-column " id="" >

            <li class="  nav-item ">
                    <a href="admin_dashboard" class="text-capitalize text-white nav-link"><i class="bi-house-fill"></i>
                        dashboard</a>
                </li>
                <hr class="text-white m-0">
                <li class="nav-item text-capitalize  dropdown">
                    <a href="" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown"> create</a>
                    <div class="dropdown-menu">
                    <a href="classs.php" class="dropdown-item">Academic Year & Classes </a>
                        <a href="classs" class="dropdown-item">Subjects</a>
                        
                    </div>

                </li>
                <hr class="text-white m-0">
                <li class="  nav-item ">
                    <a href="add_student" class="text-capitalize text-white nav-link"> <i class="bi-person-plus"></i>
                        Admission</a>
                </li>
                <hr class="text-white m-0">
                <li class="nav-item">
                    <a href="view-students" class="text-capitalize text-white nav-link"><i class="bi-eye"></i>
                        view student</a>
                </li>


               
                <hr class="text-white m-0">
                <li class="nav-item">
                    <a href="grades" class="text-white text-capitalize nav-link"> <i class="bi-bar-chart-line"></i>
                        grading</a>
                </li>
                <hr class="text-white m-0">
                <li class="nav-item">
                    <a href="viewgrades" class="text-white text-capitalize nav-link"> <i
                            class="bi-bar-chart-fill"></i> view grades</a>
                </li>
                <hr class="text-white m-0">
                <li class="nav-item">
                    <a href="post" class="text-white text-capitalize nav-link"><i
                            class="bi-file-earmark-post"></i>Create post</a>
                </li>
                <hr class="text-white m-0">
                <li class="nav-item">
                    <a href="../news.php" class="text-white text-capitalize nav-link">blog</a>
                </li>
                <hr class="text-white m-0">
            </ul>

        </div>
      