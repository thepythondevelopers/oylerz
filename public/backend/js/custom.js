 jQuery(document).ready(function () {
                'use strict';

               
            });

// sidebar js
$('.toggle-dropdown').click(function(){ 
    if(!$(this).parent('li').hasClass('active')){
    $('.sidebar-submenu').removeClass('open');
    $('.sidebar-submenu').hide('200');
    $('.toggle-dropdown').parent('li').removeClass('active');
    $(this).next('.sidebar-submenu').addClass('open');
    $(this).next('.sidebar-submenu').show('200');
    $(this).parent('li').addClass('active')
   }
   else{
     $(this).next('.sidebar-submenu').removeClass('open');
    $(this).next('.sidebar-submenu').hide('200');
    $(this).parent('li').removeClass('active')
   }
});

$('.toggle').click(function(){ 
  $('.sidebar-submenu').removeClass('open');
  $('.sidebar-submenu').hide('200');
  $('.toggle-dropdown').removeClass('active');
});




   const body = document.querySelector('body'),
   sidebar = body.querySelector('nav'),
   toggle = body.querySelector(".toggle"),
   searchBtn = body.querySelector(".search-box"),
   modeSwitch = body.querySelector(".toggle-switch"),
   modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
 sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
 sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click" , () =>{
 body.classList.toggle("dark");
 
 if(body.classList.contains("dark")){
     modeText.innerText = "Light mode";
 }else{
     modeText.innerText = "Dark mode";        
 }
});





