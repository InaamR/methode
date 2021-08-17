(function (window, undefined) {
  'use strict';
    var logoMini = document.getElementById('brand-logo');
    var logoBig = document.getElementById('brand-logo-big');
    
    document.addEventListener('DOMContentLoaded', ()=>{
      var elem = document.getElementById('navbar-header');
      elem.addEventListener('load', (ev)=>{
        console.log(elem.width);
      })
    })
    
    
    
    

    // function toggleLogo(){
    //   var newWidth = window.innerWidth;
    //   if(newWidth)
    }
  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

}(window);
