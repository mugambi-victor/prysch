<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">
  <!-- <link href="../bootstrap_5.1.3/css/bootstrap.min.css" rel="stylesheet" >
  <script src="../bootstrap_5.1.3/js/bootstrap.min.js"></script> -->
  <style>
    .wel{
        padding-left: 10rem;
    }
    .toggler{
        margin-left: 13rem;
    }
   
    .schoolname{
       justify-content: center;
        font-family:monospace;
    }
    .navbar{
        position:fixed;
        width:100%;
        background:#051094; 
        z-index: 9;
    }
    body{
        font-family: 'Nunito', sans-serif;
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
    .mon{
    font-family: monospace;
   }
</style>
<nav class="navbar navbar-expand-md m navbar-light " >
        <div class="container-fluid">
        <div class="mmm">
          
            <button class="toggler btn mt-2 btn-danger" ><i class="bi-list"></i></button>
            </div>
               
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
           
                <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                   
</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="ms-5"></span> <br> <?php echo $_SESSION['email']; ?></a>
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