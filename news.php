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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <style>
        .headerr {
            border-radius: .3rem;
            color: white;
            position: fixed;
        }

        .container {
            padding-top: 10rem;
        }


        @media(max-width:997px) {
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
          
            
            
        }

        .full-content {
            display: none;
        }
              /* buttons */
    .bt{
        padding:.3rem .9rem;
        border: 1px solid;
        border-radius: 10px;
        background-color:#0036AB;
        color:white;
    }
    .bt:hover{
        background-color: #948905;
        color:black;
       
    }
    .mon{
    font-family: monospace;
   }
    </style>
</head>

<body style="">
    <div class="container-fluid headerr bg-info">
        <h3 class="text-center p-5 mon">School Blog</h3>
    </div>
    <div class="container">
       
        <div class="row mt-2">
            <div class="col-sm cardd col-md">
                <div class="card ">
                    <div class="row d-flex">
                        <div class="col-sm m-0">
                            <img src="./images/school_exams.jpg" height="100%" width="100%" class="img-responsive" style="border-radius:5px;" alt="">
                        </div>
                        <div class="col-sm">
                            <p class="snippet-content text-center me-5 mt-4">
                                This is a short snippet of the paragraph. Click the button to read more.
                            </p>

                            <p class="full-content mt-5" style="line-height:2">
                                This is the full paragraph. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nullam auctor, eros quis dignissim consequat, sem turpis tincidunt libero, a scelerisque
                                purus quam sit amet felis. Donec lacinia purus a accumsan varius. Integer nec nulla nec
                                turpis suscipit cursus.
                            </p>
                            <button onclick="toggleContent()" class="bt">Read more</button><a href="" class="nav-link p-0 text-end">Visit post page</a>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            function toggleReadMore(button) {
                var content = document.getElementById('content');
                var hiddenContent = document.getElementById('hidden-content');

                if (content.classList.contains('initial-content')) {
                    content.classList.remove('initial-content');
                    hiddenContent.classList.remove('hidden-content');
                    button.innerHTML = 'Read less';
                } else {
                    content.classList.add('initial-content');
                    hiddenContent.classList.add('hidden-content');
                    button.innerHTML = 'Read more';
                }
            }

            function toggleContent() {
                var snippetContent = document.querySelector('.snippet-content');
                var fullContent = document.querySelector('.full-content');
                var button = document.querySelector('button');

                if (snippetContent.style.display === 'none') {
                    snippetContent.style.display = 'block';
                    fullContent.style.display = 'none';
                    button.innerHTML = 'Read more';
                } else {
                    snippetContent.style.display = 'none';
                    fullContent.style.display = 'block';
                    fullContent.style.margin= '0';
                    button.innerHTML = 'Read less';
                }
            }

        </script>
</body>

</html>