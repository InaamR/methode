(function (window, undefined) {
  'use strict';
    var logoMini = document.getElementById('brand-logo');
    var logoBig = document.getElementById('brand-logo-big');
    
    function toggleLogo(){
      var elem = document.getElementById('navbar-header');
      if(elem.classList.contains('expanded')){
        // console.log('ok');
        logoMini.style.display = "none";
        logoBig.style.display = "block";
      }else{
        logoMini.style.display = "block";
        logoBig.style.display = "none";
      }
    }
  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

})(window);
