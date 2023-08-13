<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> 
    
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
  <link href="../bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet" >
  <script src="../bootstrap_5.1.3/js/bootstrap.min.js"></script>
  <style>
    
   
    .schoolname{
        width:4rem;
        font-family:monospace;
    }
    .navbar{
        position:fixed;
        width:100%;
        background:#051094; 
    }
    body{
        font-family: 'Nunito', sans-serif;
    }
    @media(min-width:997px){
         .toggler{
        visibility:hidden;
    }
        
        
    }
   @media(max-width:997px){
        
        body{
            font-size:.8em;
        }
        .btn{
            padding:.3em;
        }
        .mrow{
        padding-left:0;
        padding:0;
       transition: 1s;
    }
       
    }
</style>
<nav class="navbar navbar-expand-md m navbar-light " >
        <div class="container-fluid">
        <div class="mmm">
            <img src="../images/rh.jfif" class="pe-2" height="80" alt="CoolBrand"/> <br>
            <button class="toggler btn mt-2 btn-danger" ><i class="bi-list"></i></button>
            </div>
               
            </a><p class="schoolname text-wrap text-white fw-bold" >KIFARU STUDENT INFORMATION MANAGEMENT SYSTEM</p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <p class="lead ps-5 text-white fs-6"><i>welcome <?php echo $_SESSION['email']; ?></i></p>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="admin_dashboard.php" class="nav-link text-white text-decoration-none">Home</a>
</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li> <a class="dropdown-item"  href="viewprofile.php">Profile</a></li>
                            <li> <a class="dropdown-item"  href="../logout.php">Logout</a></li>
        
                        </ul>
                    </li>
                </ul>
                
            </div>
           
        </div>
       
    </nav>
    
        </div>
   
  
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>