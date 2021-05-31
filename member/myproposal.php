<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/x-icon" href="../images/icon.png" />
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/util.css">
    <link rel="stylesheet" href="../styles/basis.css">
    <link rel="stylesheet" href="../js/swiper/swiper-bundle.min.css">
    <script src="../js/swiper/swiper-bundle.min.js"></script>
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/all.js"></script>
    <script src="../js/nav.js"></script>
    <title>Document</title>
    <style>
        .swiper-container {
            height: 27em;
        }
        .swiper-container .swiper-button-hidden {
            opacity: 0;
        }

    </style>
</head>
<body>
    <header class="headerpage">
    </header>
    <div class="member_nav">
    </div>
    <div class="container member">
        <h3>我的提案</h3>
        
        <h3>設計</h3>
        <div style="position:relative">
            <div class="swiper-container" id="swp_music">
                <div class="swiper-wrapper">
                    <div class="swiper-slide project-object">
                        <div class="vertical-items h-80">
                            <div class="image-container h-80">
                                <img src="../images/product/robot.jpg"> </img>
                            </div>
                            <a href="../main/content.php">   
                                <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情 </h3>
                            </a>
                        </div>
                        <div class="horizon-between top-divider">
                            <div class="horizon-items vertical-center">
                                <b>NT$ 2,900,500</b>
                                <p class="vertical-divider"> 
                                    <b>300 %</b> 
                                </p>
                            </div>
                            <p>還剩40天</p>
                        </div>
                    </div>
                    <div class="swiper-slide project-object">
                        <div class="vertical-items h-80">
                            <div class="image-container h-80">
                                <img src="../images/product/robot.jpg""> </img>
                            </div>
                            <a href="../main/content.php">   
                                <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情 </h3>
                            </a>
                        </div>
                        <div class="horizon-between top-divider">
                            <div class="horizon-items vertical-center">
                                <b>NT$ 2,900,500</b>
                                <p class="vertical-divider"> 
                                    <b>300 %</b> 
                                </p>
                            </div>
                            <p>還剩40天</p>
                        </div>
                    </div>
                    <div class="swiper-slide project-object">
                        <div class="vertical-items h-80">
                            <div class="image-container h-80">
                                <img src="../images/product/robot.jpg""> </img>
                            </div>
                            <a href="../main/content.php">   
                                <h3> [KMT] 韓寶，一款真正人性化的智能語音 | 能說能唱 一台就給全家好心情 </h3>
                            </a>
                        </div>
                        <div class="horizon-between top-divider">
                            <div class="horizon-items vertical-center">
                                <b>NT$ 2,900,500</b>
                                <p class="vertical-divider"> 
                                    <b>300 %</b> 
                                </p>
                            </div>
                            <p>還剩40天</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev">&nbsp;</div>
                <div class="swiper-button-next">&nbsp;</div>
                <div class="swiper-scrollbar"></div>
                
            </div>
            <script>
                const swp_music = new Swiper('#swp_music', {
                    grabCursor : true,
                    centeredSlides: true,
                    slidesPerView: 2,
                    slidesPerGroup: 1,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
                    on: {
                        afterInit:function(){
                            if(this.isBeginning){
                                this.navigation.$prevEl.css('display','none');
                            }
                            else{
                                this.navigation.$prevEl.css('display','block');  
                            }
                        },
                        slideChangeTransitionEnd: function(){
                            if(this.isEnd){
                                this.navigation.$nextEl.css('display','none');
                            }
                            else{
                                this.navigation.$nextEl.css('display','block');  
                            }
                            
                            if(this.isBeginning){
                                this.navigation.$prevEl.css('display','none');
                            }
                            else{
                                this.navigation.$prevEl.css('display','block');  
                            }
                        },
                    }
                });
                
            </script>
        </div>
        <h3>音樂</h3>
        
        <h3>教育</h3>
        
        <h3>科技</h3>
        
        <h3>生活</h3>
        
        
    </div>

    <footer class="footerpage">
    </footer>
</body>
</html>
