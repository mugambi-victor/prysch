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
    margin-top:10rem; 
    position:fixed;
    transition: 1s;
    height:100%;
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


<div class="col-md-2 sidebar" id="collapseExample" >

    <ul class="nav navbar-light flex-column " id="">
        
        <li class="  nav-item ">
            <a href="accounts_dashboard" class="text-uppercase text-white nav-link"><i class="bi-house-fill"></i>
                Dashboard</a>
        </li>
        <hr class="text-white m-0">
        <li class="  nav-item ">
            <a href="setfee" class="text-uppercase text-white nav-link"> <i class="bi-person-plus"></i>
                set term fees</a>
        </li>
        <hr class="text-white m-0">
        <li class="nav-item">
            <a href="viewInvoices" class="text-uppercase text-white nav-link"><i class="bi-receipt"></i>
                Invoices</a>
        </li>


        <hr class="text-white m-0">
        <li class="nav-item">
            <a href="record_payment" class="text-uppercase text-white nav-link"><i class="bi-receipt"></i>
                Record Payment</a>
        </li>


        <hr class="text-white m-0">

        <li class="nav-item text-uppercase  dropdown">
            <a href="viewpayments" class="text-uppercase text-white nav-link"><i class="bi-wallet-fill"></i></i>
                payments</a>

        </li>
        <hr class="text-white m-0">
        <li class="nav-item text-uppercase  dropdown">
            <a href="post" class="text-uppercase text-white nav-link"><i class="bi-file-earmark-post"></i>
                New Announcement</a>

        </li>
        <hr class="text-white m-0">


    </ul>

</div> 

