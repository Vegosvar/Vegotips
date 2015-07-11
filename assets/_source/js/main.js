$( document ).ready(function() {
  $(function() {
     FastClick.attach(document.body);
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  $('.trigger').click(function() {
     $('.modal-wrapper').toggleClass('open');
     $('.page-wrapper').toggleClass('blur');
     return false;
  });
});