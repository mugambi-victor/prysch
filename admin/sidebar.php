<!-- <link rel="stylesheet" href="sidebar.css"> -->
<style>
    ul.nav {
        background: #051094;
        height: 100%;

    }

    li {
        width: 100%;
    }

    .col-md-2 {
        z-index: 99;
        position: fixed;
        height: 100%;
        transition: 1s;
    }

    a:hover {
        animation: bounce 1s infinite;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);

        }
    }

    .collapsible {
        background: #051094;
        color: white;
        cursor: pointer;
        padding:.6rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;

    }

    .collapsible:after {
        content: '\002B';
        /* Unicode character for "plus" sign (+) */
        font-size: 18px;
        color: white;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
        /* Unicode character for "minus" sign (-) */
    }

    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    .active,
    .collapsible:hover {
        background-color: ;
    }
    .collapsible:hover{
        background-color: #948905;
       
    }
    /* Style the collapsible content. Note: hidden by default */
    .content {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        transition: 1s ease-out;
       
        background:inherit;
    }

    .custom-dropdown li {
        list-style: none;
        padding:.2rem;

    }

    .custom-dropdown a {
        text-decoration: none;
        color:white;
        opacity: .6;
    }
    
    .imgg img{
        margin-left:3rem;
        border-radius: 2rem;
    }
    @media(min-width:997px){
        .toggler{
            visibility: hidden;
        }
    }
    @media(max-width:997px){
        .imgg img{
            margin-left:1rem;

    }
    .schoolname{
        margin-top: .6rem;
    }
    .toggler{
        margin-left:8rem;
    }

    }
</style>


<div class="col-md-2 sidebar " id="collapseExample">

    <ul class="nav navbar-light flex-column " id="">
        <div class="imgg mt-2 d-flex">
    <img src="../images/shyne.png" class="" height="50" width="50" alt="CoolBrand"/> <br>
    </a><p class="schoolname text-wrap ms-1 text-white fw-bold" >SHYNE <br> SMS</p>
    </div>
    <hr class="text-white m-0">
        <li class="  nav-item ">
            <a href="admin_dashboard" class="text-capitalize text-white nav-link"><i class="bi-house-fill"></i>
                dashboard</a>
        </li>
        <hr class="text-white m-0">


        <button type="button" class="collapsible nav-item"> Create</button>
        <div class="content">
            <ul class="custom-dropdown" style="display:block; ">
                <li><a href="classs" class="">Academic Years</a></li>
                <li><a href="classs">Class</a></li>
                <li><a href="classs">Subjects</a></li>
            </ul>
        </div>


        <hr class="text-white m-0">

        <button type="button" class="collapsible nav-item">Students</button>
        <div class="content">
            <ul class="custom-dropdown" style="display:block; ">
                <li><a href="add_student" class="">New Student</a></li>
                <li><a href="view-students">View Student</a></li>

            </ul>
        </div>

        <hr class="text-white m-0">



        <button type="button" class="collapsible nav-item">Grading</button>
        <div class="content">
            <ul class="custom-dropdown" style="display:block; ">
                <li><a href="grades" class="">Grade Students</a></li>
                <li><a href="viewgrades">View Grades</a></li>

            </ul>
        </div>

        <hr class="text-white m-0">

        <button type="button" class="collapsible nav-item">Blog</button>
        <div class="content">
            <ul class="custom-dropdown" style="display:block; ">
                <li><a href="post" class="">New Post</a></li>
                <li><a href="../news.php">View Blog</a></li>

            </ul>
        </div>

        <hr class="text-white m-0">

    </ul>

</div>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>