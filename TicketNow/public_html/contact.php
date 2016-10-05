<?php
$title = "Contact";
$content = '<div id="page-title">

      <div class="row">

         <div class="ten columns centered text-center">
            <h1>Get In Touch<span>.</span></h1>

            <p>Have a query or want to suggest a suggestion? Get in touch with us right away! </p>
         </div>

      </div>

   </div> 

   <div class="content-outer">

      <div id="page-content" class="row page">

         <div id="primary" class="eight columns">

            <section>

              <h1>Hello. Lets talk.</h1>

              <div id="contact-form">

                  <form name="contactForm" id="contactForm" method="post" >
      					<fieldset>

                        <div class="half">
      						   <label for="contactName">Name <span class="required">*</span></label>
      						   <input name="contactName" type="text" id="contactName" size="35" value="" />
                        </div>

                        <div class="half pull-right">
      						   <label for="contactEmail">Email <span class="required">*</span></label>
      						   <input name="contactEmail" type="email" id="contactEmail" size="35" value="" />
                        </div>

                        <div>
      						   <label for="contactSubject">Subject</label>
      						   <input name="contactSubject" type="text" id="contactSubject" size="35" value="" />
                        </div>

                        <div>
                           <label  for="contactMessage">Message <span class="required">*</span></label>
                           <textarea name="contactMessage"  id="contactMessage" rows="15" cols="50" ></textarea>
                        </div>

                        <div>
                           <button class="submit">Submit</button>
                           <span id="image-loader">
                              <img src="images/loader.gif" alt="Loading" />
                           </span>
                        </div>

      					</fieldset>
      				</form> 
                  <div id="message-warning"></div>
      				<div id="message-success">
                     <i class="icon-ok"></i>Your message was sent, thank you!<br />
      				</div>

               </div>

            </section> 

         </div>';
include 'template.php';
?>

