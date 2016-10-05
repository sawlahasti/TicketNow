 jQuery(document).ready(function() {
  //  $( '#nav li:has(ul)' ).doubleTapToGo();
		// var pxShow = 300;
		// var fadeInTime = 400; 
		// var fadeOutTime = 400; 
		// var scrollSpeed = 300; 
	 //    jQuery(window).scroll(function() {

		// 	if (jQuery(window).scrollTop() >= pxShow) {
		// 		jQuery("#go-top").fadeIn(fadeInTime);
		// 	} else {
		// 		jQuery("#go-top").fadeOut(fadeOutTime);
		// 	}

		// });

      jQuery("#go-top a").click(function() {
			jQuery("html, body").animate({scrollTop:0}, scrollSpeed);
			return false;
		});


   $('#intro-slider').flexslider({
      namespace: "flex-",
      controlsContainer: "",
      animation: 'fade',
      controlNav: false,
      directionNav: true,
      smoothHeight: true,
      slideshowSpeed: 7000,
      animationSpeed: 600,
      randomize: false,
   });


   $('form#contactForm button.submit').click(function() {

      $('#image-loader').fadeIn();



      var contactName = $('#contactForm #contactName').val();
      var contactEmail = $('#contactForm #contactEmail').val();
      var contactSubject = $('#contactForm #contactSubject').val();
      var contactMessage = $('#contactForm #contactMessage').val();

      var data = 'contactName=' + contactName + '&contactEmail=' + contactEmail +
               '&contactSubject=' + contactSubject + '&contactMessage=' + contactMessage;

         var re = /^[A-Za-z]+$/;
         if(!re.test(contactName)) {
            setTimeout(function() { $('#image-loader').fadeOut(); alert( "Invalid Name." );  },1000);
            setTimeout(function() { document.contactForm.contactName.focus() ;  },1500);
            return false;
         }


         if( contactName == "")
         {
            setTimeout(function() { $('#image-loader').fadeOut(); alert( "Please provide your name!" );  },1000);
            setTimeout(function() { document.contactForm.contactName.focus() ;  },1500);
            return false;
         }
         
         if( contactEmail == "" || !contactEmail.includes("@") || !contactEmail.includes(".com") || contactEmail[0]=="@" )
         {
            setTimeout(function() { $('#image-loader').fadeOut(); alert( "Please provide valid email!" );  },1000);
            setTimeout(function() { document.contactForm.contactEmail.focus() ;  },1500);
            return false;
         }
   
         if( contactMessage.length == 0 )
         {
            setTimeout(function() { $('#image-loader').fadeOut(); alert( "Please dont leave your message empty!" );  },1000);
            return false;
         }
         alert( "Response Noted." );
         setTimeout(function() { $('#image-loader').fadeOut(); alert( "Response Noted." );  },1500);
         return( true );
      
  });
});
      // $.ajax({

	     //  type: "POST",
	     //  url: "inc/sendEmail.php",
	     //  data: data,
	     //  success: function(msg) {

      //       if (msg == 'OK') {
      //          $('#image-loader').fadeOut();
      //          $('#message-warning').hide();
      //          $('#contactForm').fadeOut();
      //          $('#message-success').fadeIn();   
      //       }
      //       else {
      //          $('#image-loader').fadeOut();
      //          $('#message-warning').html(msg);
	     //        $('#message-warning').fadeIn();
      //       }

	     //  }

      // });

      // return true;

 









