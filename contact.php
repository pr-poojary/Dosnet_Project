<?php
require('top.php');
?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5 mt-3">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">></p>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm"  method="post">
                        <div class="control-group border-5">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group border-5">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email ID"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group border-5">
                            <input type="tel" class="form-control" id="mobile" name="message" placeholder="Your Mobile Number"
                                required="required" data-validation-required-message="Please enter a moblie number" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group border-5">
                            <textarea class="form-control" rows="6" name="message" id="message" placeholder="Message"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                        <button type="button" onclick="send_message()" class="btn btn-primary py-2 px-4">Send MESSAGE</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <script>
        function send_message(){
        var name=jQuery("#name").val();
        var email=jQuery("#email").val();
        var mobile=jQuery("#mobile").val();
        var message=jQuery("#message").val();
        
        if(name==""){
            alert('Please enter name');
        }else if(email==""){
            alert('Please enter email');
        }else if(mobile==""){
            alert('Please enter mobile');
        }else if(message==""){
            alert('Please enter message');
        }else{
            jQuery.ajax({
                url:'send_message.php',
                type:'post',
                data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
                success:function(result){
                    alert(result);
                }	
            });
        }
    }
    </script>

<?php
require('footer.php');
?>