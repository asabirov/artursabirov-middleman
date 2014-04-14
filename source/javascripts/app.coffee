$('.books-list .book').imagesLoaded ->
  $('.books-list').masonry
    columnWidth: 100
    gutter: 5
    itemSelector: '.book'
