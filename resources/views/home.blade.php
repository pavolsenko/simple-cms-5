@extends('layouts/default')

@section('content')


    <div class="tp-banner-container" id="home">
        <div class="tp-banner-video">
            <ul>
                <!-- SLIDE  -->
                <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="img/star-cover.jpg"  data-saveperformance="off"  data-title="Quick Results">
                    <!-- MAIN IMAGE -->
                    <img src="img/typing-cover.jpg"  alt="video_typing_cover"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption tp-fade fadeout fullscreenvideo"
                         data-x="0"
                         data-y="0"
                         data-speed="1000"
                         data-start="1100"
                         data-easing="Power4.easeOut"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.1"
                         data-endspeed="1500"
                         data-endeasing="Power4.easeIn"
                         data-autoplay="true"
                         data-autoplayonlyfirsttime="false"
                         data-nextslideatend="true"
                         data-volume="mute"
                         data-forceCover="1"
                         data-aspectratio="16:9"
                         data-forcerewind="on"
                         style="z-index: 2;">
                        <video class="img-responsive" preload="none"
                               poster='img/typing-cover.jpg'>
                            <source src='http://bootstraplovers.com/videos/computer_typing.mp4' type='video/mp4' />
                            <source src='http://bootstraplovers.com/videos/computer_typing.webm' type='video/webm' />
                        </video>
                    </div>

                    <!-- Home Heading -->
                    <div class="tp-caption sft Ken-burns-heading"
                         data-x="center"
                         data-y="260"
                         data-speed="1200"
                         data-start="1100"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                        @lang('navigation.pavol_senko')
                    </div>
                    <!-- Home Subheading -->
                    <div class="tp-caption ken-burns-cap sft fadeout"
                         data-x="center"
                         data-y="390"
                         data-speed="1200"
                         data-start="1350"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                        @lang('navigation.developer')
                    </div>
                    <!-- Home Button -->
                    <div class="tp-caption home-button sft fadeout"
                         data-x="center"
                         data-y="450"
                         data-speed="1200"
                         data-start="1550"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="300"
                         style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                        <div class="rev-buttons scrollto">
                            <a href="#work" class="btn btn-theme-color btn-lg">
                                @lang('navigation.about_me')
                            </a>
                        </div>
                    </div>
                </li>

            </ul>

        </div>



    </div>	<!--video slider-->


    <section id="about" class="padding-80">

        <!--about page content-->
        <div class="about-section">
            <div class="container">
                <div class="section-heading text-center">
                    <h4 class="small section-title"><span>What I love to do?</span></h4>
                    <h2 class="large section-title">About me</h2>
                </div><!--section heading-->

            </div><!--container-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <img src="http://lorempixum.com/300/300" class="img-thumbnail">
                    </div>
                    <div class="col-sm-8">
                        Hi there,<br><br>

                        Welcome to my personal page. My name is Pavol Senko, I'm a passionate web developer currently located in Vienna, Austria. I'm 29 years old, originnaly from Zilina, Slovakia.
                        <br><br>
                        My first touch with computers happened in 1996 with 486 DX2 which was a beast. I started programming in Pascal for MS-DOS, later C.
                        During my university studies I basicaly touched every major programming language including C, C++, C#, Java, PHP, Javascript, HTML, PL/SQL, Python and more,
                        but I've ended up in web development which fits me the best. I have experience with many frameworks
                        <br><br>

                        I also liked getting into lower levels of computer science and touching some hardware stuff which leaded to my recent hobby IoT - Internet of things.
                        I have some Arduinos and couple of LEDs to play with as well as Rasperry Pi which currently serves as my retro gaming console and home development server.
                        <br><br>

                        When not programming I like playing computer games, going out. Travelling (expecially nordic countries :)
                        <br><br>
                        You can find more details about me including my work experience in About me section.
                        <br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>

       <!--page about content end here-->
          <div class="services-section-2 parallax" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Subscribe to my Newsletter</h1>
                        <form class="newsletter-form">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <div class="input-group">
                                        <label class="sr-only" for="subscribe-email">Email address</label>
                                        <input type="email" class="form-control" id="subscribe-email" placeholder="Enter your email">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-theme-color btn-lg">OK</button>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--services section 1 end-->
    </section>
    <!--section services end here-->

    <section id="contact" class="padding-80">


        <div class="contact-sec-1">
            <div class="container">
                <div class="section-heading text-center">
                    <h4 class="small section-title"><span>I'd love to hear from you</span></h4>
                    <h2 class="large section-title">Contact Me</h2>
                </div><!--section heading-->
            </div><!--.container-->
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h4>Get in touch</h4>
                        <form name="sentMessage" id="contactForm" method="post" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row control-group">
                                        <div class="form-group col-xs-12 controls">
                                            <label>Name<span>*</span></label>
                                            <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="row control-group">
                                        <div class="form-group col-xs-12 controls">
                                            <label>Email Address<span>*</span></label>
                                            <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                            <p class="help-block"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 controls">
                                    <label>Message<span>*</span></label>
                                    <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-theme-color btn-lg">Send Message</button>
                                </div>
                            </div>
                        </form>
                        <!--contact form-->
                    </div>
                    <div class="col-md-4">
                        <h4>Contact info</h4>
                        <div class="contact-info wow animated fadeInRight" data-wow-delay=".6s">
                            <p><i class="fa fa-home"></i> +43 660 661 9976</p>
                            <p><i class="fa fa-home"></i> +421 907 268 923</p>
                            <p><i class="fa fa-envelope"></i> <a href="#">pavol.senko@gmail.com</a></p>
                            <hr>
                            <h4>Elsewhere</h4>
                            <ul class="list-inline social-colored">
                                <li><a href="#"><i class="fa fa-facebook icon-fb" data-toggle="tooltip" title="" data-original-title="Facebook" data-placement="top"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter icon-twit" data-toggle="tooltip" title="" data-original-title="Twitter" data-placement="top"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus icon-plus" data-toggle="tooltip" title="" data-original-title="Google pluse" data-placement="top"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin icon-in" data-toggle="tooltip" title="" data-original-title="Linkedin" data-placement="top"></i></a></li>

                            </ul> <!--colored social-->
                        </div>
                    </div>
                </div>
            </div>
        </div><!--Contact-sec-1 end-->

    </section><!--contact section end-->
    <div class="contact-sec-2">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-4">
                    <div class="contact-col wow animated flipInY" data-wow-delay=".3s">
                        <i class="fa fa-phone"></i>
                        <p>+91 0141 123456789</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-col wow animated flipInY" data-wow-delay=".3s">
                        <i class="fa fa-envelope"></i>
                        <p>mail@Domain.com</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-col wow animated flipInY" data-wow-delay=".3s">
                        <i class="fa fa-home"></i>
                        <p>124,munnawali jaipur<br>302012, india</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--Contact-sec-1 end-->
@stop