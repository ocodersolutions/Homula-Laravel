@extends('layouts.frontend')

@section('content')
<style type="text/css">
    .main{
        position: relative;
    }
    #outer-wrap{
        background: url(../wp-content/themes/realsite/images/find-a-realtor-header-bg.jpg) no-repeat;
        background-size: cover;
        background-position: bottom;
        height: 450px;
    }
    .new-title-search{
        color: #fff;
        left: 50%;
        font-weight: 600;
        font-size: 14px!important;
        position: absolute;
        text-align: center;
        top: 0;
        transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
        z-index: 91;
        width: 100%;
        max-width: 1170px;
    }
    .shadow-box{
        background-color: rgba(255, 255, 255, 0.7);
        height: 100%;
        width: 80%;
        margin: 0 auto;
        position: relative;
    }
    .shadow-box h1{
        color: #0a368a;
        padding-top: 30px;
        font-size: 30px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .shadow-box p{
        font-size: 20px;
        color: #777777;
        line-height: 24px;
    }
    .ask-1 .button-row, .ask-3 .button-row, .ask-4 .button-row{
        float: left;
        width: 50%;
        padding: 30px 55px;
    }
    .shadow-box .form-control{
        border: 1px solid;
        width: 100%;
        font-size: 14px;
        float: right;
        background: white;
        border-radius: 4px;
        height: 50px;
    }
    .shadow-box input[type=radio]{
        display: none;
    }
    .shadow-box .form-control input[type=text]{
        color: rgba(0,0,0,0.7);
        font-size: 16px;
        line-height: 48px;
        padding: 0 5px;
        position: relative;
        transition: box-shadow .12s linear;
    }
    .shadow-box button{
        background-color: #0a368a;
        font-size: 13px;
        font-weight: 500;
        padding: 6px 12px;
        overflow: hidden;
        height: 50px;
        width: 100%;
        position: relative;
        text-transform: uppercase;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
    }
    .shadow-box button:hover{
        color: #fff;
    }
    .ask-2 .button{
        width: 65%;
        margin: 12px auto;
    }
    .ask-3 .button-row{
        padding: 12px 55px;
    }
    .back-button{
        bottom: 0;
        width: 100%;
        color: #e91e63;
        cursor: pointer;
        padding: 10px 0px;
    }
    .back-button span{
        margin-left: 10px;
    }
    .ask-4 .button-row {
        padding: 12px 55px;
    }
    .ask-5 .button {
        padding: 10px;
        width: 65%;
        margin: 0 auto;
    }
    .shadow-box.ask-6 h3 {
        color: black;
        font-size: 18px;
        text-transform: uppercase;
    }
    .shadow-box.ask-6 dl {
        color: black;
        margin-bottom: 0;
    }
    .shadow-box.ask-6 dl dd {
        display: inline-block;
        margin-left: 55px;
        font-weight: bold;
    }
    .ask-6 h3 {
        margin-bottom: 0px;
    }
    .shadow-box.ask-6 .button-row {
        height: 45px;
    }
    .ask-6 label {
        float: left;
        width: 30%;
        line-height: 40px;
        color: #757575;
        font-size: 11px;
        text-transform: uppercase;
    }
    .ask-6 input.form-control, .ask-6 select.form-control{
        float: left;
        font-weight: bold;
        width: 50%;
        height: 35px;
        font-size: 12px;
    }
    .shadow-box.ask-6 button {
        width: 40%;
        height: 40px;
    }
    h2.page-header{
        background: #039be5;
        color: #fff;
        font-size: 32px;
        padding: 10px;
        margin-top: 50px;
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
    }
    @media (min-width: 1899px){
        body .container {
            width: 1140px;
    }

</style>
<div class="main">


<div id="outer-wrap" class="cover" data-background-image="/images/banner.jpg" style="background-image: url(&quot;/images/banner.jpg&quot;);"></div>

<div class="new-title-search">

    <form id="survey" method="post" action="" class="ng-pristine ng-valid">
        <div class="survey">
            <div class="shadow-box ask-1" style="margin-top: 45px;display: block; " data-ask="1">
                <h1>Find the best real estate agent for your needs.</h1>
                <p> Working with the right agent makes all the difference.
                    <br>100% Free. No obligation.</p>
                <div style="display: inline-block;">
                    <div class="button-row">
                        <input type="text" placeholder="Enter City or Postal code" required="" name="location" class="form-control">
                    </div>
                    <div class="button-row">
                        <button type="button" class="btn"><span class="ink animate" style="height: 202px; width: 202px; top: -70px; left: -25.4844px;"></span>FIND MY PERFECT AGENT</button>
                    </div>
                </div>
            </div>
        
            <div class="shadow-box ask-2" style="display: none;" data-ask="2">
                <h1>Are you looking to buy or sell?</h1>
                <div class="button">
                    <button type="button" class="btn btn-buy">BUY</button>
                    <input type="radio" name="buyorsell" value="buy">
                </div>
                <div class="button">
                    <button type="button" class="btn btn-sell">SELL</button>
                    <input type="radio" name="buyorsell" value="sell">
                </div>
                <div class="button">
                    <button type="button" class="btn btn-sell">RENT</button>
                    <input type="radio" name="buyorsell" value="rent">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>

            <div class="shadow-box ask-3" style="display: none;" data-ask="3">
                <h1>What do you plan to spend on your new home?</h1>
                
                <div class="button-row odd">
                    <button type="button" class="btn">Under 200K</button>
                    <input type="radio" name="price" value="0">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">$200K - $400K</button>
                    <input type="radio" name="price" value="200-400">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">$400K - $600K</button>
                    <input type="radio" name="price" value="400-600">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">$600K - $800K</button>
                    <input type="radio" name="price" value="600-800">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">$800K - $1M</button>
                    <input type="radio" name="price" value="800-1000">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Over $1M</button>
                    <input type="radio" name="price" value="1000">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>

            <div class="shadow-box ask-4" style="display: none;" data-ask="4">
                <h1>What kind of home are you looking for?</h1>
                <div class="button-row odd">
                    <button type="button" class="btn">House</button>
                    <input type="radio" name="type" value="house">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Condominium</button>
                    <input type="radio" name="type" value="condominium">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">Townhouse</button>
                    <input type="radio" name="type" value="townhouse">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Commercial</button>
                    <input type="radio" name="type" value="commercial">
                </div>
                <div class="button-row odd">
                    <button type="button" class="btn">Land</button>
                    <input type="radio" name="type" value="land">
                </div>
                <div class="button-row even">
                    <button type="button" class="btn">Business</button>
                    <input type="radio" name="type" value="business">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>

            <div class="shadow-box ask-5" style="display: none;" data-ask="5">
                <h1>It's most important to me that my agent...</h1>

                <div class="button">
                    <button type="button" class="btn">Has lots of experience</button>
                    <input type="radio" name="important" value="experience">
                </div>
                <div class="button">
                    <button type="button" class="btn">Gets me the best price</button>
                    <input type="radio" name="important" value="price">
                </div>
                <div class="button">
                    <button type="button" class="btn">Spends lots of time with me</button>
                    <input type="radio" name="important" value="time">
                </div>
                <div class="button">
                    <button type="button" class="btn">Can close fast</button>
                    <input type="radio" name="important" value="fast">
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>   
            <div class="shadow-box ask-6" data-ask="6" style="display: none;">
                <h1>We value your privacy. How can your agent reach you?</h1>
                <h3 style="margin-top: -12px;">We'll search our database of participating agents to find an agent with:</h3>
                <dl>
                    <dd><i class="fa fa-check" aria-hidden="true"></i> A verified license to work in</dd>
                    <dd><i class="fa fa-check" aria-hidden="true"></i> Positive customer reviews</dd>
                    <dd><i class="fa fa-check" aria-hidden="true"></i> Availability</dd>
                </dl>
                <div class="button-row">
                    <label> Full Name: </label>
                    <input type="text" required="" name="fullname" class="form-control">
                </div>
                <div class="button-row">
                    <label> Phone: </label>
                    <input type="number" required="" name="phone" maxlength="18" class="form-control">
                </div>
                <div class="button-row">
                    <label> Email:  </label>
                    <input type="email" required="" name="email" class="form-control">
                </div>
                <div class="button-row">
                    <label> Best time to contact?  </label>
                    <select name="time" class="form-control">
                      <option value="" disabled="" selected="">Please Select a Time</option>
                      <option value="rightnow">Right Now</option>
                      <option value="morning">Morning</option>
                      <option value="afternoon">Afternoon</option>
                      <option value="evening">Evening</option>
                    </select>
                </div>
                <div class="button-row">
                    <button type="submit" class="btn">FIND THE BEST AGENT NOW</button>
                </div>
                <div class="back-button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i><span>BACK</span>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
            jQuery('.shadow-box .back-button').click(function(){
                 ask_number = jQuery(this).closest('.shadow-box').data('ask');
                 jQuery(this).closest('.shadow-box').fadeOut(function(){
                    jQuery('.ask-'+(ask_number-1)).find('input:checked').removeAttr('checked');
                    jQuery('.ask-'+(ask_number-1)).fadeIn(2000);
                 });
            });
    
            jQuery('.shadow-box button').click(function(){
                ask_number = jQuery(this).closest('.shadow-box').data('ask');
                
                switch(ask_number) {
                    case 1:
                            area = jQuery(this).closest('.shadow-box').find('input[name="location"]').val();
                            if (area != '') {
                                jQuery(this).closest('.ask-1').fadeOut(function(){
                                    jQuery('.ask-2').fadeIn(2000);    
                                });
                            }else{
                                jQuery('input[name="location"]').css({"border": "1px solid red"});
                            }
                        break;
                    case 2:
                        jQuery(this).closest('.button').find('input[name="buyorsell"]').attr('checked','');
                        jQuery(this).closest('.ask-2').fadeOut(function(){
                            jQuery('.ask-3').fadeIn(2000);
                        });
                        
                        break;
                    case 3:
                        jQuery(this).closest('.button-row').find('input[name="price"]').attr('checked','');
                        jQuery(this).closest('.ask-3').fadeOut(function(){
                            jQuery('.ask-4').fadeIn(2000);    
                        });
                        
                        break;
                    case 4:
                        jQuery(this).closest('.button-row').find('input[name="type"]').attr('checked','');
                        jQuery(this).closest('.ask-4').fadeOut(function(){
                            jQuery('.ask-5').fadeIn(2000);    
                        });
                    
                        break;
                    case 5:
                        jQuery(this).closest('.button').find('input[name="important"]').attr('checked','');
                        jQuery(this).closest('.ask-5').fadeOut(function(){
                            jQuery('.ask-6').fadeIn(2000);    
                        });
                    
                        break;
                    default:
                        submit = jQuery(this).attr('type');
                        name = jQuery('input[name="fullname"]').val();
                        phone = jQuery('input[name="phone"]').val();
                        email = jQuery('input[name="email"]').val();
                        time = jQuery('input[name="time"]').val();
                        if(name != "" && phone != "" && email != "" ){
                            if(submit == 'submit'){
                                jQuery ("form#survey" ).submit();
                            }
                        }


                        
                }

               
            });

</script>
</div>






<div style="background: #000; height: 50px; text-align: center; color: #fff;"> Block Seach</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <article id="page-554" class="post-554 page type-page status-publish">
                <h2 class="page-header test-homula1">Find A Realtor</h2>
                <p>If you are buying or selling a home, you may be inclined to save a buck or two by not appointing an agent. It is just a house, how hard could it be. From our point of view, this is a major mistake. Buying or selling a house is a big decision, you need to have a professional to facilitate everything. Toronto Real Estate agents are a dime or doze, so how to get the best bank for your buck. We can help you find agents based on the following criteria.</p>
                <p><img class="img-responsive" src="http://realestate.homula.com/wp-content/themes/realsite/images/find-a-realtor-images.jpg" alt="">
                </p>
                <p><strong>Experience: </strong>Absolutely nothing can substitute for experience. An agent with precise knowledge of the locality and housing market is second to non. You can get the best price and best value for your investment. An experienced agent is also adaptable, if there are unforeseen complications, the agent is well equipped to handle it. Secondly when you are making such an important decision, you do not want to be part of the learning curb for a rookie.<strong>&nbsp;</strong>
                </p>
                <p><strong>Background checks:</strong>&nbsp;Homula does a background check on each one of the <a href="http://realestate.homula.com/agents/" target="_blank">agent listing</a>. We check to see how long they have been in business, find and speak to former clientele. We check their licensing, get in contact with the governing body of the province and check if they have had any complaints or concerns with the person in question. When it comes to your home you want to pick someone who has a strict code of conduct. When we are doing a background check we look at the type and locality of homes the agent has dealt with. If you are selling, the agent has to be well versed in the type of home you have. If you are buying look into agents who are familiar with your desired price range. To check the competence of an agent, ask the person if there are any houses nearby for sale. A good agent should have that information off the top of his/her head. That means you are picking someone who is on top of the market.<strong>&nbsp;</strong>
                </p>
                <p>When you make the decision to sell or <a href="http://realestate.homula.com/resale-homes/">purchase a home</a>, put some money aside for a real estate agent. You might not want to but it saves money and time in the long run. <strong>&nbsp;&nbsp;</strong>
                </p>
            </article>
        </div>
    </div>
</div>

<div style="background: #000; height: 50px; text-align: center; color: #fff;">Block Agents</div>








@endsection

@section('script')
@endsection