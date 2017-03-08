@extends('layouts.frontend')

@section("title","Contact Us")

@section("content")
	<style type="text/css">
		.cup_image {
			background-color: #ffffff;
		    margin-top: 41px;
		}
		.cup_contact_form {
			background-color: #f1f1f1;
		    padding-top: 35px;
		    padding-bottom: 35px;
		}
		.touch-part {
			background-color: #fcfcfc;
		    border: 2px solid #4a6089;
		    padding: 30px 25px;
		}
		.get-tuch {
		    border-bottom: 1px solid #cecece;
		    color: #0a368a;
		    font-size: 24px;
		    font-weight: bold;
		    margin-bottom: 40px;
		    padding-bottom: 20px;
		    text-transform: uppercase;
		}
		div.wpcf7 .screen-reader-response {
		    position: absolute;
		    overflow: hidden;
		    clip: rect(1px,1px,1px,1px);
		    height: 1px;
		    width: 1px;
		    margin: 0;
		    padding: 0;
		    border: 0;
		}
		.wpcf7 form {
		    background: none;
		    margin: 0;
		    padding: 0;
		}
		.wpcf7-form p {
		    margin: 0;
		}
		.wpcf7-form-control-wrap {
		    position: relative;
		}
		.wpcf7-form p input, .wpcf7-form p textarea {
			height: 48px;
		    line-height: 48px;
		    padding: 11px 5px 11px 15px;
		    position: relative;
		    transition: box-shadow .12s linear;
		    background-color: #ffffff;
		    border-radius: 0;
		    color: #646464;
		    font-size: 15px;
		    margin-bottom: 40px;
		    width: 90%;
		    border: 1px solid #646464;
		    box-shadow: none;
		}
		.wpcf7-form .wpcf7-submit {
		    background-color: #093689;
		    border: medium none;
		    border-radius: 0;
		    color: #ffffff;
		    cursor: pointer;
		    display: inline-block;
		    float: left;
		    font-size: 16px;
		    margin-right: 32px;
		    margin-top: 0;
		    padding: 12px 30px;
		    text-transform: uppercase;
		    width: auto;
		    line-height: 1;
		}
		.wpcf7-form .wpcf7-submit:hover {
		    background-color: #000000;
		    transition: all 2s ease 0s;
		}
		div.wpcf7 img.ajax-loader {
		    border: 0;
		    vertical-align: middle;
		    margin-left: 4px;
		}
		.touch-part ul {
		    padding-top: 30px;
		    padding-left: 0;
		}
		ul li {
		    margin-bottom: 10px;
		}
		.touch-part ul li a {
		    font-size: 18px;
		    line-height: 30px;
		    color: #232323;
		}
		.touch-part ul li a:hover {
			text-decoration: none;
		}

	</style>
	
	<div class="contact-us-page">
		<div class="cup_image">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="map-img">
			                <img class="img-responsive" src="/images/world-map.png">			                
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="cup_contact_form">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="touch-part">
						    <div class="get-tuch"><img src="/images/getin-tuch.png"> Get in touch</div>
						    <div class="row">
						        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						            <div role="form" class="wpcf7" id="wpcf7-f12075-o1" lang="en-US" dir="ltr">
						                <div class="screen-reader-response"></div>
						                <form action="" method="post" class="wpcf7-form ng-pristine ng-valid">
						                    <div style="display: none;">
						                        <input type="hidden" name="_wpcf7" value="12075">
						                        <input type="hidden" name="_wpcf7_version" value="4.5.1">
						                        <input type="hidden" name="_wpcf7_locale" value="en_US">
						                        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f12075-o1">
						                        <input type="hidden" name="_wpnonce" value="900b119f8a">
						                    </div>
						                    <p><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Full Name" required></span> </p>
						                    <p><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email" aria-invalid="false" placeholder="Email Adress" required></span> </p>
						                    <p><span class="wpcf7-form-control-wrap tel-682"><input type="tel" name="tel-682" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" placeholder="Phone No"></span></p>
						                    <p><span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message" style="overflow: hidden; word-wrap: break-word; height: 120px;"></textarea></span> </p>
						                    <p>
						                        <input type="submit" value="Submit" class="wpcf7-form-control wpcf7-submit"><img class="ajax-loader" src="/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;"></p>
						                    <div class="wpcf7-response-output wpcf7-display-none"></div>
						                </form>
						            </div>
						        </div>
						        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						            <div class="logo-hom"><img class="img-responsive" src="/images/logo.png"></div>
						            <ul>
						                <li>
						                    <a href="mailto:sales@realestate.homula.com"><img src="/images/email.jpg">&nbsp; sales@realestate.homula.com</a>
						                </li>
						                <li>
						                    <a href="mailto:support@realestate.homula.com"><img src="/images/email.jpg">&nbsp; support@realestate.homula.com</a>
						                </li>
						                <li>
						                    <a href="https://www.facebook.com/Homula-Real-Estate-1007389046006123/" target="_blank"><img src="/images/fb.jpg">&nbsp; Like us on Facebook</a>
						                </li>
						                <li>
						                    <a href="https://www.linkedin.com/in/homularealestate" target="_blank"><img src="/images/ld.jpg">&nbsp; Follow us on Linkedin</a>
						                </li>
						                <li>
						                    <a href="https://twitter.com/homularealty" target="_blank"><img src="/images/tw.jpg">&nbsp; Follow us on Twitter</a>
						                </li>
						            </ul>
						        </div>
						    </div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection