
<div class="col-md-3 offset-sm-1">
    <div class="sidebar-module">
        <script type="text/javascript" src="//ra.revolvermaps.com/0/0/6.js?i=01wgkx853sl&amp;m=7&amp;c=e63100&amp;cr1=ffffff&amp;f=arial&amp;l=0&amp;bv=90&amp;lx=-420&amp;ly=420&amp;hi=20&amp;he=7&amp;hc=a8ddff&amp;rs=80" async="async"></script>
    </div>

    <div class="sidebar-module mt-0 pt-0">
        <hr>
        <div id="redBtn" class="button-nottouch-main animated  shadow "  onclick="redBtnPushed();">
            <div class="button-nottouch3">
                <div class="button-nottouch2">
                    <div class="button-nottouch">
                        <div style="font-family:Arial, Helvetica, sans-serif; width:100px; text-align:center; position:absolute; left: 0px; top: 31px; z-index:8; color: #8c0909;">
                            <b>DON'T<br />PUSH</b>
                        </div>
                        <div style="font-family:Arial, Helvetica, sans-serif; width:100px; text-align:center; position:absolute; left: 0px; top: 30px; z-index:7; color: #550404;">
                            <b>DON'T<br />PUSH</b>
                        </div>
                        <div style="font-family:Arial, Helvetica, sans-serif; width:100px; text-align:center; position:absolute; left: 0px; top: 32px; z-index:7; color: #ff8585">
                            <b>DON'T<br />PUSH</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-nottouch4"></div>
            <div class="button-nottouch5"></div>
            <div class="button-nottouch6"></div>
        </div>

        <br class="my-5">
        <br>
        <br>
        <br>
        <br>
        <div id="blueBtn" class="button-touch-main mt-4 animated invisible " onclick="blueBtnPushed();">
            <br>
            <div class="button-touch-main">
                <div class="button-touch3">
                    <div class="button-touch2">
                        <div class="button-touch">
                            <div style="font-family:Arial, Helvetica, sans-serif; width:100px; text-align:center; position:absolute; left: 0px; top: 7px; z-index:8; color: #09568c;">
                                <b>Fix</b>
                            </div>
                            <div style="font-family:Arial, Helvetica, sans-serif; width:100px; text-align:center; position:absolute; left: 0px; top: 6px; z-index:7; color: #043455;">
                                <b>Fix</b>
                            </div>
                            <div style="font-family:Arial, Helvetica, sans-serif; width:100px; text-align:center; position:absolute; left: 0px; top: 8px; z-index:7; color: #85cdff">
                                <b>Fix</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-touch4"></div>
                <div class="button-touch5"></div>
                <div class="button-touch6"></div>
            </div>
        </div>
        
        <div id="fun-with" class="animated" >
            <h4>Archives</h4>
            <ol class="list-unstyled">
                <li><a class='none-decored' href="#">September 2018</a></li>
                <li><a class='none-decored' href="#">August 2018</a></li>
                <li><a class='none-decored' href="#">July 2018</a></li>
                <li><a class='none-decored' href="#">June 2018</a></li>
                <li><a class='none-decored' href="#">May 2018</a></li>
                <li><a class='none-decored' href="#">April 2018</a></li>
                <li><a class='none-decored' href="#">March 2018</a></li>
                <li><a class='none-decored' href="#">February 2018</a></li>
                <li><a class='none-decored' href="#">January 2018</a></li>
                <li><a class='none-decored' href="#">December 2017</a></li>
                <li><a class='none-decored' href="#">November 2017</a></li>
                <li><a class='none-decored' href="#">October 2017</a></li>
            </ol>
        </div>
    </div>

    <script type="text/javascript">
        function redBtnPushed()
        {
            $('#fun-with').removeClass('fadeInUpBig');
            $('#fun-with').addClass('hinge');

            $('#blueBtn').removeClass('invisible fadeOutUpBig');
            $('#blueBtn').addClass('visible fadeIn  delay-4s slower');
        }

        function blueBtnPushed()
        {
            $('#fun-with').removeClass('hinge');
            $('#fun-with').addClass('fadeInUpBig');
            
            $('#blueBtn').removeClass('fadeIn  delay-4s slower');
            $('#blueBtn').addClass('fadeOutUpBig');
        }
    </script>
</div>