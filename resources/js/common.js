let mySwiper = new Swiper ('.swiper', {
  loop: true,
  speed: 1000,
  autoplay: {
      delay: 9000,
  },
  pagination: {
      el: '.swiper-pagination', //ページネーション要素
      type: 'bullets', //ページネーションの種類
      clickable: true, //クリックに反応させる
  },
});
