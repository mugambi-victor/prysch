
       const sideBar = document.querySelector('.sidebar');
const toggler = document.querySelector('.toggler');
const mrow= document.querySelector('.mrow');
const container= document.querySelector('.container');
  
  toggler.addEventListener('click', function() {
   
    if (sideBar.style.marginLeft=== '-250px')
    {
        sideBar.style.marginLeft= '0';
       
    }
    else 
    {
        
        sideBar.style.marginLeft= '-250px';
        
    }
   

  });

 

  