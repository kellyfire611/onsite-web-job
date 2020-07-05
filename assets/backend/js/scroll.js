$(() => {
  $('.wrapper').animate({ scrollTop: 0 }, 400);

  $('#scrollTop').on('click', () => {
    $('.wrapper').animate({ scrollTop: 0 }, 400);
  });
});
