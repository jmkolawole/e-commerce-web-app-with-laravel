<footer class="pb-35">
    <div class="container">
        <!-- Footer Middle Start -->
        <div class="footer-middle ptb-90">
            <div class="row">
                <!-- Single Footer Start -->
                <div class="col-lg-5 col-md-6 mb-all-30">
                    <div class="single-footer">
                        <div class="footer-logo mb-20">
                            <a href="#"><img class="img" src="{{asset('images/frontend/logo1.png')}}" alt="logo-img"></a>
                        </div>
                        <div class="footer-content">
                            <ul class="footer-list first-content">
                                <li><i class="pe-7s-map-marker"></i> 279 Ibrahim Taiwo Road Ilorin, Kwara State.
                                </li>
                                <li><i class="pe-7s-call"></i> <span><a href="tel:08027871372" style="display:inline">08027871372</a></span>
                                    || <span><a href="tel:08155197711" style="display:inline">08155197711</a></span></li>
                                <li><i class="pe-7s-clock"></i>Working time: 9.00 - 18.00</li>
                                <li class="mt-20">
                                    <ul class="social-icon">
                                        <li>
                                            <a href="https://www.facebook.com/alvinsmakeup">
                                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/alvinsmakeup">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/AlvinsMakeup">
                                                <i class="fa fa-twitter" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->

                <div class="col-lg-2 col-md-6 mb-sm-30">
                    <div class="single-footer">
                        <div class="single-footer">
                            <h4 class="footer-title">our company</h4>
                            <div class="footer-content">
                                <ul class="footer-list">
                                    <li><a href="{{route('about')}}">about us</a></li>
                                    <li><a href="{{route('contact')}}">contact us</a></li>
                                    <li><a href="{{route('products')}}">Products</a></li>
                                    <li><a href="{{route('privacy')}}">Terms And Conditions</a></li>
                                    <li><a href="{{route('makeup.special')}}">Alvinsmakeup Special</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-5 col-md-6">
                    <div class="single-footer">
                        <div class="single-footer">
                            <h4 class="footer-title">Subscriber To Our Newsletters </h4>
                            <div class="footer-content subscribe-form">
                                <div class="subscribe-box">
                                    <form action="" method="POST">
                                        {{csrf_field()}}
                                        <input type="email" id="subscriber_email"
                                               placeholder="Your email address" onfocus="enableSubscriber();" onfocusout="checkSubscriber();">
                                        <button type="button" class="pe-7s-mail-open" id="btnSubmit"  onclick="checkSubscriber(); addSubscriber();"></button>
                                        <br>

                                        <span id="statusSubscribe" style="display: none;color: red;margin-top: 2em!important;"></span>

                                        <span id="subscribed" style="display: none;color: green;margin-top: 2em!important;"></span>

                                    </form>
                                </div>
                                <p class="mt-10">Get E-mail Updates About Our Latest Products and Special Offers.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Footer Middle End -->
        <!-- Footer Bottom Start -->
        <div class="footer-bottom pt-35">
            <div class="col-md-12">
                <div class="row align-items-center justify-content-md-between">
                    <div class="footer-copyright ">
                        <p>Copyright <a href="#">Alvinsmakeup</a> All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </div>
</footer>


<script>
    function checkSubscriber(){
        //alert('yeah');
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'check-subscriber-email',
            data:{subscriber_email:subscriber_email},
            success:function(resp){
                if(resp == "exists"){

                    $('#statusSubscribe').show().html('Error: Subscriber already exist!!');
                    $("#btnSubmit").hide();

                }
            },error:function(){

                alert('Error');

            }
        });
    }


    function enableSubscriber(){
        //alert('yeah');
        $("#btnSubmit").show();
        $('#statusSubscribe').hide();
        $('#subscribed').hide();
    }


    function addSubscriber(){
        //alert('yeah');
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'add-subscriber-email',
            data:{subscriber_email:subscriber_email},
            success:function(resp){
                if(resp == "exists"){
                    $('#statusSubscribe').show().html('Error: Subscriber already exist!!');
                    $("#btnSubmit").hide();
                }else if(resp == "saved"){
                    $('#subscribed').show().html('Success: Thank you for subscribing. Please Check Your Mail Box To Verify');
                }
            },error:function(){

                alert('Error');

            }
        });
    }

</script>

