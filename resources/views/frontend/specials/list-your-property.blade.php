@extends('layouts.frontend')

@section('content')
	<style type="text/css">
		.list-your-property-page {
			background: #f1f1f1;
			padding: 50px 0 60px 0;
		}
		h1.page-header {
			border-bottom: 1px solid rgba(0,0,0,0.12);
			line-height: 60px;
		    margin: 0 0 30px 0;
		    background: #039be5;
		    padding: 0 0 0 20px;
		    color: #fff;
		    font-size: 32px;
		    text-transform: uppercase;
		    font-weight: bold;
		}
		.submission-form.box {
		    border: 1px solid #b6b6b6;
		    background: #f8f8f8;
		    padding: 0 0 50px 0;
		    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
		    margin: 0 0 30px 0;
		}
		#section-property {
		    margin-bottom: 20px;
		}
		.section-property-box {
		    border: 1px solid #cfcfcf;
		    display: inline-block;
		    width: 100%;
		}
		.section-property-box #even {
		    background-color: #ffffff;
		    display: inline-block;
		    width: 100%;
		    padding-top: 15px;
		    padding-bottom: 15px;
		    margin-bottom: -5px;
		}
		.section-property-box #odd {
		    background-color: #f4f4f4;
		    display: inline-block;
		    width: 100%;
		    padding-top: 15px;
		    padding-bottom: 15px;
		    margin-bottom: -5px;
		}
		.box-pro .col-lg-3.col-md-3.col-sm-3.col-xs-12, .box-pro .col-lg-9.col-md-9.col-sm-9.col-xs-12 {
		    display: table;
		    height: 60px;
		}
		.section-property-box .list-inn-title {
		    font-size: 16px;
		    color: #232323;
		    text-transform: uppercase;
		    line-height: 36px;
		}
		.box-pro .col-lg-3.col-md-3.col-sm-3.col-xs-12 .list-inn-title, 
		.box-pro .col-lg-9.col-md-9.col-sm-9.col-xs-12 .list-box-area {
		    display: table-cell;
		    vertical-align: middle;
		}
		.section-property-box .list-box-area {
		    width: 100%;
		    display: flex;
		}
		input[type=text], input[type=email], textarea, .form-control, .comment-respond input[type=text], 
		.comment-respond input[type=email], .dsidx-search-widget input, 
		#dsidx.dsidx-details .dsidx-contact-form table input[type=text] {
		    background-color: transparent;
		    border-radius: 0;
		    border: 0;
		    box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
		    color: rgba(0,0,0,0.7);
		    font-size: 16px;
		    height: 48px;
		    line-height: 48px;
		    padding: 0 5px;
		    position: relative;
		    transition: box-shadow .12s linear;
		}
		.submission-form input[type=text], .submission-form input[type=email], .submission-form textarea {
		    width: 100%;
	        background-color: transparent;
		}
		.section-property-box input.short-input-full {
		    border-radius: 10px;
		    border: 1px solid #7a91be;
		    padding: 10px;
		    width: 100%;
		}
		.section-property-box .list-box-area textarea {
		    width: 100%;
		    border-radius: 15px;
		    border: 1px solid #7a91be;
		    resize: none;
		}
		.section-property-box input.short-input {
		    width: 68% !important;
		    margin-right: 2%;
		    border-radius: 10px;
		    border: 1px solid #7a91be;
		    padding: 10px;
		}
		.box-pro .list-box-area .btn {
		    background-color: #039be5;
		    border-bottom: 3px solid #027fbb;
		    border-radius: 8px;
		    color: #ffffff;
		    font-size: 15px;
		    font-weight: bold;
		    line-height: 22px;
		    padding: 10px 25px;
		    text-transform: uppercase;
	        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
	        overflow: hidden;
		    position: relative;
		    text-align: center;
		    vertical-align: middle;
		    touch-action: manipulation;
		    cursor: pointer;
			margin: 0 auto;
		    margin-top: 15px;
		    font-weight: bold;
		}
		.section-property-box input.short-input-short {
		    border-radius: 10px;
		    border: 1px solid #7a91be;
		    padding: 10px;
		}
		.box-pro .list-box-area .btn-blank {
		    background: none;
		    border: none;
		    font-size: 15px;
		    color: #686868;
		    line-height: 22px;
		    text-transform: uppercase;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		}
		input[type=checkbox] {
		    border: 0;
		    cursor: pointer;
		    height: 20px;
		    margin: 0 10px 0 0;
		    position: relative;
		    overflow: hidden;
		    vertical-align: -5px;
		    width: 20px;
		}
		input[type=checkbox]:before {
		    background-color: #fff;
		    border: 2px solid #e0e0e0;
		    content: '';
		    display: block;
		    height: 20px;
		    left: 0;
		    opacity: 1;
		    position: absolute;
		    transition: opacity .15s linear;
		    top: 0;
		    width: 20px;
		}
		input[type=checkbox]:after {
		    border: 2px solid #ec407a;
		    content: '';
		    display: block;
		    height: 23px;
		    left: -5px;
		    opacity: 0;
		    position: absolute;
		    top: -9px;
		    transform: rotate(-45deg);
		    -webkit-transform: rotate(-45deg);
		    transition: opacity .15s linear;
		    width: 27px;
		    background: #fff;
		}
		input[type=checkbox]:checked:before {
		    border-color: #fff;
		}
		input[type=checkbox]:checked:after {
		    opacity: 1;
		}
		.list-box-check .btn {
		    background-color: #b7b7b7;
		    border-radius: 8px;
		    color: #ffffff;
		    font-size: 13px;
		    font-weight: bold;
		    line-height: 22px;
		    padding: 10px 15px;
		    text-transform: uppercase;
		    margin-top: 5px;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		}
		.list-inn-title-btn .btn {
		    background-color: #039be5;
		    border-bottom: 3px solid #027fbb;
		    border-radius: 8px;
		    color: #ffffff;
		    font-size: 15px;
		    font-weight: bold;
		    line-height: 22px;
		    padding: 10px 25px;
		    text-transform: uppercase;
		    margin-top: 10px;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		}

	</style>

	<div class="list-your-property-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="page-header">List Your Property</h1>
					<div class="box submission-form">
						<form method="post" action="" enctype="multipart/form-data" name="list_your_property" class="ng-pristine ng-valid">
							<div id="section-property">
								<div class="section-property-box">
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Name</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="firstname" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Email</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="email" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Phone</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="phone" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Address</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="address" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">City</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="city" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Province</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="province" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Postal Code</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="postal_code" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">DESCRIPTION</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <textarea name="description" rows="3" style="overflow: hidden; word-wrap: break-word; height: 98px;"></textarea>
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">IMAGE</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="file" id="featured_img" name="featured_img" class="short-input" style="display:none;">
								                <button type="button" id="uploadTrigger" class="btn text-right">Add and upload files</button>
								            </div>
								        </div>
								    </div>
								    <script>
									    $("#uploadTrigger").click(function() {
									        $("#featured_img").click();
									    });
								    </script>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Ask Price</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="price" class="short-input-short">
								                <button type="button" class="btn-blank">Enter amount without currency.</button>
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">BEDS</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="bedrooms" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">BATHS</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="bathrooms" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">GARAGES</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="garages" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Area</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="area" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <div class="box-pro extra-check" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">LOCATIONs</div>
								        </div>
								        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								            <div class="list-box-area">
								                <input type="text" name="locations" class="short-input-full">
								            </div>
								        </div>
								    </div>
								    <script>
									    function toggle_checkbox(chk_class) {
									        if ($('.' + chk_class + ':checked').length == $('.' + chk_class).length) {
									            $('.' + chk_class).each(function(index, element) {
									                $(this).prop('checked', false);
									            });
									        } else {
									            $('.' + chk_class).each(function(index, element) {
									                $(this).prop('checked', true);
									            });
									        }
									    }
								    </script>
								    <div class="box-pro extra-check" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Contracts</div>
								        </div>
								        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								            <div class="list-box-check">
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="contracts_chk" name="contracts[]" value="Buy"> Buy
								                    <br>
								                    <input type="checkbox" class="contracts_chk" name="contracts[]" value="Lease"> Lease
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="contracts_chk" name="contracts[]" value="Home Buy"> Home Buy
								                    <br>
								                    <input type="checkbox" class="contracts_chk" name="contracts[]" value="Sale"> Sale
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="contracts_chk" name="contracts[]" value="Condo New"> Condo New
								                    <br>
								                    <input type="checkbox" class="contracts_chk" name="contracts[]" value="Sell"> Sell
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <button type="button" onclick="toggle_checkbox('contracts_chk');" class="btn">Select/Deselect All</button>
								                </div>
								            </div>
								        </div>
								    </div>
								    <div class="box-pro extra-check" id="even">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">Types</div>
								        </div>
								        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								            <div class="list-box-check">
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="types_chk" name="types[]" value="Condo"> Condo
								                    <br>
								                    <input type="checkbox" class="types_chk" name="types[]" value="Town House"> Town House
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="types_chk" name="types[]" value="Land"> Land
								                    <br>
								                    <input type="checkbox" class="types_chk" name="types[]" value="House"> House
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="types_chk" name="types[]" value="Commercial"> Commercial
								                    <br>
								                    <input type="checkbox" class="types_chk" name="types[]" value="New Contruction"> New Contruction
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <button type="button" onclick="toggle_checkbox('types_chk');" class="btn">Select/Deselect All</button>
								                </div>
								            </div>
								        </div>
								    </div>
								    <div class="box-pro extra-check" id="odd">
								        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								            <div class="list-inn-title">AMENITIES</div>
								        </div>
								        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
								            <div class="list-box-check">
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="amenities_chk" name="amenities[]" value="Air conditioning"> Air conditioning
								                    <br>
								                    <input type="checkbox" class="amenities_chk" name="amenities[]" value="Dishwasher"> Dishwasher
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="amenities_chk" name="amenities[]" value="Cable TV"> Cable TV
								                    <br>
								                    <input type="checkbox" class="amenities_chk" name="amenities[]" value="Heating"> Heating
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <input type="checkbox" class="amenities_chk" name="amenities[]" value="CAC Included"> CAC Included
								                    <br>
								                    <input type="checkbox" class="amenities_chk" name="amenities[]" value="Internet"> Internet
								                </div>
								                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								                    <button type="button" onclick="toggle_checkbox('amenities_chk');" class="btn">Select/Deselect All</button>
								                </div>
								            </div>
								        </div>
								    </div>
								    <div class="box-pro" id="even">
								        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
								            <div class="list-inn-title-btn">
								                <button type="submit" name="submit_property" value="submit_property" class="btn">Save Property</button>
								            </div>
								        </div>
								    </div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection