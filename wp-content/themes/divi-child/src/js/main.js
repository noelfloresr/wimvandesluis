jQuery(document).ready(function($){
    $('.nav-icon').closest('li').addClass('li-nav-icon');

    //section-our-services
    var serviceItem = $('.section-our-services .service-item');
    serviceItem.hover(function(){
      $(this).siblings().removeClass('service-active');
      $(this).addClass('service-active');
      var blurbActiveContent = $(this).find('p').text();
      $('.section-our-services .service-current-text p').text(blurbActiveContent);
    });

    var blurbActiveContent = $('.section-our-services .service-active p').text();
    $('.section-our-services .service-current-text p').text(blurbActiveContent);

    $('.home .section').append('<div class="section-hr"><hr></div>');


    //add url dinamically

    $('.sm-share').each(function(index, el) {
      var self = $(this);

      var currentUrl = window.location.href;

      self.addClass('social-share');
      self.attr('data-url', currentUrl);

      if (self.hasClass('facebook')){

        self.attr('data-network', 'facebook');

      }else if (self.hasClass('twitter')){

        self.attr('data-network', 'twitter');

      }else if (self.hasClass('linkedin')){

        self.attr('data-network', 'linkedin');

      }
    });


    $(function(){
      $('.social-share').sofyShare();
    });

    $('#mobile-menu > li').click(function(event) {
      console.log('clicked');
      $(this).siblings('.sub-menu').slideToggle('slow');
    });

    $('.wp-pagenavi > .nextpostslink').html('<i class="fa fa-angle-right" aria-hidden="true"></i>');
    $('.wp-pagenavi > .previouspostslink').html('<i class="fa fa-angle-left" aria-hidden="true"></i>');

});

jQuery(window).load(function($){

  jQuery('.bg-section img').each(function(index, el) {
    var self = jQuery(this);
    var imgHeight = self.prop('naturalHeight');
    var bgImageUrl = self.attr('src');

    self.closest('.bg-section').css('background', 'url('+ bgImageUrl +')');
    
  })
  
});
