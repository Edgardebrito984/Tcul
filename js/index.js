function menuShow(){
    let menuMobile = document.querySelector('.mobile-menu');
    if(menuMobile.classList.contains('open')){
        menuMobile.classList.remove('open');
        
    }else{
        menuMobile.classList.add('open');
           
    }
}
const swiper = new Swiper('.card-content', {
    
    grabCursor:true,
    spaceBetween: 30,
    loop: true,
  
    
    pagination: {
      el: '.swiper-pagination',
      clickable:true,
      dynamicBullets: true
    },
  

    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    breakpoints:{
        0:{
            slidesPerView: 1
        },

        730:{
            slidesPerView: 2
        },

        1024:{
            slidesPerView: 3
        },
    }
    
  });

  