$(() => {
  $('html,body').animate({ scrollTop: 0 }, 400);

  $('#scrollTop').on('click', () => {
    $('html,body').animate({ scrollTop: 0 }, 400);
  });
});
