  const sideBar = document.querySelector('.sidebar');
  const toggler = document.querySelector('.toggler');
  const mrow= document.querySelector('.mrow');
  const container= document.querySelector('.container');
    const skulname=document.querySelector('.the-skul');
    toggler.addEventListener('click', function() {
     
      if (sideBar.style.marginLeft== '-250px')
      {
      
          sideBar.style.marginLeft= '0';
          mrow.style.padding='0';
          toggler.style.setProperty('margin-left', '11rem', 'important');
         
      
      }
      else 
      {
      
          sideBar.style.marginLeft= '-250px';
          toggler.style.setProperty('margin-left', '1rem', 'important');
          toggler.style.transition = '1s';
       
      }
     
      
    });
  
   
  
    

 

  