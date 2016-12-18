<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IOT Homework 4</title>
    <!-- jQuery -->
    <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- JQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- HighChart -->
    <script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
    <style>
        #map {
            width: 100%;
            height: 570px;
        }
    </style>
    <script>
        initialize2();

        function initialize2() {
            var param = location.search.split("?");
            console.log(decodeURI(param[1]))
            $.ajax({
                url: 'database_map.php',
                data: decodeURI(param[1]),
                dataType: 'json',
                success: getDataSuccess2
            });
        }

        function getDataSuccess2(data) {
            console.log(data)
            console.log(" light value = " + data[0][2] + " , location name = " + data[0][3])
            $("#con").empty();
            var val = []; // 存放光敏電阻值
            var stime = [];
            var dataNum = data.length;
            for (var i = 0; i < dataNum; i++) {
                val.push(parseInt(data[i][2]));
                stime.push(data[i][1].toString());
            }
            var ads = data[0][4].toString()
            console.log(stime)
            Highcharts.chart('con', {
                title: {
                    text: "光度變化",
                },
                subtitle: {
                    text: ads,
                },
                scrollbar: {
                    enabled: true
                },
                chart: {
                    type: 'spline',
                    zoomType: 'x'
                },
                xAxis: {
                    tickInteral: 1,
                    labels: {
                        enabled: true,
                        formatter: function() {
                            return stime[this.value];
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'light Value'
                    },
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + stime[this.x] + '</b><br><li>' + this.series.name + ": <b>" + this.y + '</b></li>';
                    }
                },
                series: [{
                    name: ads,
                    data: val
                }],
                plotOptions: {
                    spline: {
                        lineWidth: 3,
                        states: {
                            hover: {
                                lineWidth: 5
                            }
                        },
                    },
                    marker: {
                        enables: true
                    }
                }
            });
        }
    </script>

    <?php
      session_start();
      if($_SESSION['username'] != '')
        header("Location: /login.php");
    ?>

</head>

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">IOT Homework 4</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Show Map</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Show Chart</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/iot5.png"  alt="">
                    <div class="intro-text">
                        <span class="name">IOT Homework 4</span>
                        <hr class="star-light">
                        <span class="skills">7105029033 王瑋祥</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ShowMap Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Show Map</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div id="map"></div>
            </div>
        </div>
    </section>
    <!-- ShowChart Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Show Chart</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div id="con"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>About Web</h3>
                        <p>2016/11/21
                            <br>IOT HomeWork 4</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Me</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/wei.wang.1690" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://github.com/Xiang36" class="btn-social btn-outline"><i class="fa fa-fw fa-github"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/wang-weixiang-23664399?authType=NAME_SEARCH&authToken=MS0A&locale=zh_TW&trk=tyah&trkInfo=clickedVertical%3Amynetwork%2CclickedEntityId%3A350941578%2CauthType%3ANAME_SEARCH%2Cidx%3A1-1-1%2CtarId%3A1480265453023%2Ctas%3AWeiXiang" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Purpose</h3>
                        <p>學習利用PHP提供API資料給展示層，並將資料整合至GoogleMap顯示Marker與infowindow，再將數值呈現在圖表中。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; WeiXiang 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>
    <script>
        function initMap() {
            $.ajax({
                url: 'database.php',
                data: "",
                dataType: 'json',
                success: getDataSuccess
            });
        }
    </script>
    <script>
        var geocoder, map;

        function initMap() {
            $.ajax({
                url: 'database_map.php',
                data: "",
                dataType: 'json',
                success: getDataSuccess
            });
        }

        function getDataSuccess(data) {
            console.log(data);
            var dataNum = data.length;
            geocoder = new google.maps.Geocoder();
            var myLatlng = new google.maps.LatLng(24.1223416, 120.6742634);
            var mapOptions = {
                center: myLatlng,
                zoom: 8
            }
            console.log(data)
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var ads = [];
            for (var i = 0; i < dataNum; i++) {
                if ($.inArray(data[i][3].toString(), ads) == -1) {
                    ads.push(data[i][3].toString());
                    codeAddress(data[i]);
                }
            }
        }

        function codeAddress(data) {
            var html;
            geocoder.geocode({
                'address': data[3].toString()
            }, function(results, status) {
                console.log(results)
                if (status == google.maps.GeocoderStatus.OK) {
                    var loc = results[0].geometry.location;;
                    console.log("lat = " + loc.lat() + " , lng = " + loc.lng())
                    map.setCenter(new google.maps.LatLng(loc.lat(), loc.lng()));
                    var marker = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(loc.lat(), loc.lng()),
                        title: "address: " + data[3].toString() + "\nname: " + data[4],
                        animation: google.maps.Animation.DROP
                    });
                    marker.addListener('click', function() {
                        html = "";
                        html += "<h>名稱： " + data[3] + "</h><br><h>標記者： " + data[1] + "</h>";
                        var infowindow = new google.maps.InfoWindow({
                            content: html
                        });
                        infowindow.open(map, marker);
                    });
                } else {
                    var timeout = 300;
                    if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                        setTimeout(function() {
                            codeAddress(data);
                        }, timeout)
                    } else {
                        // alert("Geocode was not successful for the following reason : " + status);
                    }
                }
            });
        }

        function add_marker(lat, lng) {

            var myLatlng = new google.maps.LatLng(lat, lng);
            var mapOptions = {
                zoom: 17,
                center: myLatlng
            }
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var marker = new google.maps.Marker({
                position: myLatlng,
                title: "中興大學",
            });

            // To add the marker to the map, call setMap();
            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWyjZ4K4qJb-4zINJdeY3JV_CZgjjW9Mk&callback=initMap" async defer></script>

</body>

</html>
