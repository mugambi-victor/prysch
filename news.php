<?php 
include('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> 
    
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .headerr{
            border-radius: .3rem;
            color: white;
            position: fixed;
        }
        .container{
            padding-top: 10rem;
        }
        .cardd{
            display: flex;
        }
        p,i,h2{
            margin-left: 1rem;
        }
        @media(max-width:997px)
        {
            .cardd{
                display: inline-block;
                padding: 0;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
                height: 350px;
                
            }
            .cardd p{
                visibility:hidden;
            }
            .a{
                visibility:hidden;
            }
            .cardd img{
                height:80%;
                width: 100%;
            }
        }
    </style>
</head>

<body  style="">
<div class="container-fluid headerr bg-info">
    <h3 class="text-center p-5">School Blog</h3>
</div>
<div class="container">
    <div class="row mt-2">
        <div class="col-sm cardd col-md ">
            <img src="./images/school_exams.jpg" height="200" width="280" alt="">
            <div>
            <h2>Title here</h2>
            <i>Readmore..</i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde doloremque, dolores quod id porro cum consequatur minus expedita non autem quaerat. Perspiciatis neque blanditiis doloribus omnis odio quam ipsam explicabo!</p>
            <i class="a">Author</i>
            </div>
        </div>
        
    </div>
    <div class="row mt-2">
        <div class="col-sm cardd col-md ">
            <img src="./images/pupils-parents-school-29216578.jpg" height="200" width="280" alt="">
            <div>
            <h2>Title here</h2>
            <i>Readmore..</i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde doloremque, dolores quod id porro cum consequatur minus expedita non autem quaerat. Perspiciatis neque blanditiis doloribus omnis odio quam ipsam explicabo!</p>
            <i class="a">Author</i>
            </div>
        </div>
        
    </div>
</div>
</body>

</html>