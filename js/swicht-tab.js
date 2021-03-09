// JavaScript Document

$(document).ready(function() {
   tab();
   tab2();
   tab3();
   tab4();
   tab5();
   tab6();
   tab7();
   tab8();
   tab9();
   tab10();
});
function tab() {
    $('.span_tab_content').hide();
    $('.span_tab_content:first').show();
    $('.span-tab span a:first').addClass('active-span-tab');
    $('.span-tab span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content').hide();
       $(id_content).fadeIn();
       $('.span-tab span a').removeClass('active-span-tab');
       $(this).addClass('active-span-tab');
       return false;
    });
 
}


function tab2() {
    $('.span_tab_content2').hide();
    $('.span_tab_content2:first').show();
    $('.span-tab2 span a:first').addClass('active-span-tab2');
    $('.span-tab2 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content2').hide();
       $(id_content).fadeIn();
       $('.span-tab2 span a').removeClass('active-span-tab2');
       $(this).addClass('active-span-tab2');
       return false;
    });
 
}


function tab3() {
    $('.span_tab_content3').hide();
    $('.span_tab_content3:first').show();
    $('.span-tab3 span a:first').addClass('active-span-tab3');
    $('.span-tab3 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content3').hide();
       $(id_content).fadeIn();
       $('.span-tab3 span a').removeClass('active-span-tab3');
       $(this).addClass('active-span-tab3');
       return false;
    });
 
}

function tab4() {
    $('.span_tab_content4').hide();
    $('.span_tab_content4:first').show();
    $('.span-tab4 span a:first').addClass('active-span-tab4');
    $('.span-tab4 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content4').hide();
       $(id_content).fadeIn();
       $('.span-tab4 span a').removeClass('active-span-tab4');
       $(this).addClass('active-span-tab4');
       return false;
    });
 
}

function tab5() {
    $('.span_tab_content5').hide();
    $('.span_tab_content5:first').show();
    $('.span-tab5 span a:first').addClass('active-span-tab5');
    $('.span-tab5 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content5').hide();
       $(id_content).fadeIn();
       $('.span-tab5 span a').removeClass('active-span-tab5');
       $(this).addClass('active-span-tab5');
       return false;
    });
 
}

function tab6() {
    $('.span_tab_content6').hide();
    $('.span_tab_content6:first').show();
    $('.span-tab6 span a:first').addClass('active-span-tab6');
    $('.span-tab6 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content6').hide();
       $(id_content).fadeIn();
       $('.span-tab6 span a').removeClass('active-span-tab6');
       $(this).addClass('active-span-tab6');
       return false;
    });
 
}

function tab7() {
    $('.span_tab_content7').hide();
    $('.span_tab_content7:first').show();
    $('.span-tab7 span a:first').addClass('active-span-tab7');
    $('.span-tab7 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content7').hide();
       $(id_content).fadeIn();
       $('.span-tab7 span a').removeClass('active-span-tab7');
       $(this).addClass('active-span-tab7');
       return false;
    });
 
}

function tab8() {
    $('.span_tab_content8').hide();
    $('.span_tab_content8:first').show();
    $('.span-tab8 span a:first').addClass('active-span-tab8');
    $('.span-tab8 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content8').hide();
       $(id_content).fadeIn();
       $('.span-tab8 span a').removeClass('active-span-tab8');
       $(this).addClass('active-span-tab8');
       return false;
    });
 
}

function tab9() {
    $('.span_tab_content9').hide();
    $('.span_tab_content9:first').show();
    $('.span-tab9 span a:first').addClass('active-span-tab9');
    $('.span-tab9 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content9').hide();
       $(id_content).fadeIn();
       $('.span-tab9 span a').removeClass('active-span-tab9');
       $(this).addClass('active-span-tab9');
       return false;
    });
 
}

function tab10() {
    $('.span_tab_content10').hide();
    $('.span_tab_content10:first').show();
    $('.span-tab10 span a:first').addClass('active-span-tab10');
    $('.span-tab10 span a').click(function(){
       var  id_content = $(this).attr("href"); 
       $('.span_tab_content10').hide();
       $(id_content).fadeIn();
       $('.span-tab10 span a').removeClass('active-span-tab10');
       $(this).addClass('active-span-tab10');
       return false;
    });
 
}