<?php
require_once 'VisitorTracker.php';
$tracker = new VisitorTracker();

// Check if returning visitor
if ($tracker->isReturningVisitor()) {
    $welcomeMessage = "Welcome back! We're glad to see you again.";
} else {
    $welcomeMessage = "Welcome to Travelafric.com! Enjoy your first visit.";
}
?>

<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], 'curl') !== false) {
    header("HTTP/1.1 403 Forbidden");
    exit("Access Denied");
}
?>



<?php include 'currency-detector.php'; ?> 
<?php include 'ad-config.php'; ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html> 
<head>
    <!-- Page Title -->
    <title>Travelafric.com: Books Hotels, Tours, Transfers, Tours Guides & Rent A Car</title>
    <?php include 'template/head.html'; ?>  
  <script src="tracker.js"></script> 
<style type="text/css">
.autocomplete-suggestions{background:#fff;padding:1px;overflow:hidden;border:1px #ccc solid;   }
.autocomplete-suggestion{padding:5px 10px; }
.autocomplete-suggestion:hover{background:#f1f1f1;cursor:pointer;  }
.fullwidthbanner-container {
height: 510px !important;
}

.revolution-slider {
    height: 510px !important;
}

.revolution-slider img {
    height: 100% !important;
    object-fit: cover; /* To ensure the image fits the slider properly */
}
/* Existing CSS */
#slideshow {
    position: relative;
}

.fullwidthbanner-container {
    position: relative;
    overflow: hidden;
}

.revolution-slider {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.revolution-slider ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.revolution-slider li {
    position: relative;
}

.revolution-slider li img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

/* Text responsiveness */
.revolution-slider p {
    font-size: 4vw; /* Adjusts size based on viewport width */
    margin: 0;
    color: #ffffff;
    text-shadow: 2px 2px 5px green;
    font-weight: bold;
    font-family: "Times New Roman", serif;
}

.revolution-slider i {
    font-size: 2vw; /* Adjusts size based on viewport width */
    color: #ffffff;
    text-shadow: 2px 2px 5px green;
    display: block;
    margin-top: 10px;
    font-family: "Sans-serif";
}

/* New classes for mobile-specific styles */
.book-title {
    margin-bottom: -15px; /* Retained from your inline styles */
    font-size: 4vw; /* Base font size */
}

.book-description {
    padding-top: -5px; /* Retained from your inline styles */
    font-size: 1.5vw; /* Base font size */
}

/* Media queries for fine-tuning text on smaller screens */
@media (max-width: 768px) {
    .revolution-slider p {
        font-size: 6vw; /* Further increase for mobile devices */
    }

    .revolution-slider i {
        font-size: 4vw;
    }

    /* Styles for mobile devices */
    .revolution-slider div {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        padding: 10px;
      /*  border-radius: 10px; /* Optional: Adds a slight rounded corner effect */
    }

    .book-title {
        font-size: 5vw; /* Adjust for mobile devices */
    }

    .book-description {
        font-size: 2.5vw; /* Adjust for mobile devices */
    }
}

@media (max-width: 480px) {
    .revolution-slider p {
        font-size: 8vw; /* Larger text for smaller mobile screens */
    }

    .revolution-slider i {
        font-size: 5vw;
    }

    .book-title {
        font-size: 6vw; /* Further adjust for smaller mobile screens */
    }

    .book-description {
        font-size: 3vw; /* Further adjust for smaller mobile screens */
    }
}

.slide-content {
        font-size: 50px;
        position: absolute;
        top: 50%; /* Default for small screens */
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 80%; /* Adjust for better layout */
    }

    .book-title {
        font-size: 4vw;
    }

    .book-description {
        font-size: 1.5vw;
    }

    @media (min-width: 1024px) {
        /* Move text higher for larger screens */
        .slide-content {
            top: 40%; /* Move up by 10% */
        }
    }

    @media (max-width: 768px) {
        .slide-content {
            font-size: 30px;
            width: 90%; /* Adjust width for smaller screens */
        }

        .book-title {
            font-size: 6vw;
        }

        .book-description {
            font-size: 3vw;
        }
    }

    @media (max-width: 480px) {
        .slide-content {
            font-size: 20px;
            width: 95%; /* Adjust width for very small screens */
        }

        .book-title {
            font-size: 8vw;
        }

        .book-description {
            font-size: 4vw;
        }
    }
    
 #searchBorder{
           border: 2px solid #007bff; /* Initial blue border */
           box-shadow: 0 0 10px #007bff; /* Adds the glow effect */
           transition: box-shadow 0.3s ease; /* Smooth transition for the glow */
        }

</style>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16860655815">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16860655815');
</script>

<!-- Event snippet for Purchase conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-16860655815/Tm_cCJPZ6ZoaEMfh5Oc-',
      'value': 1.0,
      'currency': 'USD',
      'transaction_id': ''
  });
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SDT8PN0FYB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SDT8PN0FYB');
</script>

</head>
<body>
   
<div id="page-wrapper">
        <?php include 'template/nav.php'; ?>
        
        <!--work on slider and slider image-->
        <!--<div id="slideshow">-->
        <!--    <div class="fullwidthbanner-container" style="position:relativ;">-->
        <!--        <div class="revolution-slider rev_slider" style=" overflow: hidden;">-->
        <!--         <ul style="">     -->
        <!--            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">-->
        <!--                <img src="res/images/slide-08.jpg" alt=" " style="width: 100%; height: auto;">-->
        <!--                <div class="slide-content" style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family: 'Times New Roman', serif; font-weight: bold; padding: 0% 0 0 0%; transform: translate(-50%, -50%); position: absolute; top: 45%; left: 50%;">-->
        <!--                    <p class="book-title" style="margin-bottom:-25px;">Welcome to your One-Stop Africa Travel Shop</p>-->
        <!--                    <i class="book-description" style="font-family: sans-serif; padding-top:20px">Seamless booking, Guaranteed service</i>-->
        <!--                </div>-->
        <!--            </li>-->
        <!--            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">-->
                        <!-- MAIN IMAGE -->
        <!--                <img src="res/images/hotel-slider-3.jpg" style="width: 100%; height: auto;" alt="">-->
        <!--                <div class="slide-content" style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family: 'Times New Roman', serif; font-weight: bold; padding: 0% 0 0 0%; transform: translate(-50%, -50%); position: absolute; top: 45%; left: 50%;">-->
        <!--                    <p class="book-title" style="margin-bottom:-25px;">Book Your Apartments, Vacation Homes & Hotels in Africa</p>-->
        <!--                    <i class="book-description" style="font-family: sans-serif; padding-top:20px">Seamless booking, Quaranteed service</i>-->
        <!--                </div>-->
        <!--            </li>-->
        <!--            <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500">-->
        <!--                <img src="res/images/slide-14.jpeg" alt="" style="width: 100%; height: auto;">-->
        <!--                <div class="slide-content" style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family: 'Times New Roman', serif; font-weight: bold; padding: 0% 0 0 0%; transform: translate(-50%, -50%); position: absolute; top: 45%; left: 50%;">-->
        <!--                    <p class="book-title">Book excursions, tour packages and explore beautiful attractions in Africa</p>-->
        <!--                    <i class="book-description" style="font-family: sans-serif; padding-top:20px">Seamless booking, Guaranteed service</i>-->
        <!--                </div>-->
        <!--            </li>-->
                
        <!--            <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">-->
        <!--                <img src="res/images/transfer-slider11a.jpg" alt=" " style="width: 100%; height: auto;">-->
        <!--                <div class="slide-content" style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family: 'Times New Roman', serif; font-weight: bold; padding: 0% 0 0 0%; transform: translate(-50%, -50%); position: absolute; top: 45%; left: 50%;">-->
        <!--                    <p class="book-title" style="margin-bottom:-25px;">Seamless Rent-A-Car & Transfers Bookings in Africa</p>-->
        <!--                    <i class="book-description" style="font-family: sans-serif; padding-top:20px">Book Your Car in a Few Clicks</i>-->
        <!--                </div>-->
        <!--            </li>-->
        <!--        </ul>-->
                
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <style>
            /* Google Fonts - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
/** {*/
/*  margin: 0;*/
/*  padding: 0;*/
/*  box-sizing: border-box;*/
/*  font-family: "Poppins", sans-serif;*/
/*}*/
.main {
  height: 60vh;
  width: 100%;
}
.wrapper,
.slide {
  position: relative;
  width: 100%;
  height: 100%;
}
.slide {
  overflow: hidden;
}
.slide::before {
  content: "";
  position: absolute;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 10;
}
.slide .image {
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.slide .image-data {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  width: 100%;
  z-index: 100;
}
.image-data span.text {
  font-size: 30px;
  font-weight: 400;
  color: #fff;
}
.image-data h2 {
  font-size: 72px;
  font-weight: 600;
  color: #fff;
}
/*a.button {*/
/*  display: inline-block;*/
/*  padding: 10px 20px;*/
/*  border-radius: 25px;*/
/*  color: #333;*/
/*  background: #fff;*/
/*  text-decoration: none;*/
/*  margin-top: 25px;*/
/*  transition: all 0.3s ease;*/
/*}*/
/*a.button:hover {*/
/*  color: #fff;*/
/*  background-color: #c87e4f;*/
/*}*/
/* swiper button css */
.nav-btn {
  height: 50px;
  width: 50px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
}
.nav-btn:hover {
  background: rgba(255, 255, 255, 0.4);
}
.swiper-button-next {
  right: 50px;
}
.swiper-button-prev {
  left: 50px;
}
.nav-btn::before,
.nav-btn::after {
  font-size: 25px;
  color: #fff;
}
.swiper-pagination-bullet {
  opacity: 1;
  height: 12px;
  width: 12px;
  background-color: #fff;
  visibility: hidden;
}
.swiper-pagination-bullet-active {
  border: 2px solid #fff;
  background-color: #c87e4f;
}
@media screen and (max-width: 768px) {
  .image-data h2 {
    font-size: 35px; /* Adjust font size for mobile view */
  }
  .image-data span.text {
  font-size: 15px;
}
  .nav-btn {
    visibility: hidden;
  }
  .swiper-pagination-bullet {
    visibility: visible;
  }
}

.main.swiper.mySwiper2 {
  position: relative; /* Establish stacking context for the banner */
}

.search-box.container2 {
  position: absolute;
  top: 410px; /* Adjust this value to control vertical position */
  left: 50%; /* Center horizontally initially */
  transform: translateX(-50%); /* Adjust for exact horizontal centering */
  z-index: 20; /* Ensure it's on top of the banner (adjust if needed) */
  background-color: white; /* Optional: Add a background to make it stand out */
  padding: 20px; /* Optional: Add some padding around the content */
  border-radius: 10px; /* Optional: Add rounded corners */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Add a subtle shadow */
  width: 90%; /* Adjust width as needed */
  max-width: 1200px; /* Optional: Set a maximum width */
}

/* You might need to adjust styles for the inner elements of the search box */
.search-tabs2 {
  /* Add styles for your search tabs */
}

.search-tabs2 li a {
  /* Add styles for your search tab links */
}

.search-tab-content2 {
  /* Add styles for the content area below the tabs */
}

        </style>
         <section class="main swiper mySwiper">
      <div class="wrapper swiper-wrapper">
        <div class="slide swiper-slide">
          <img src="res/images/hotel-slider-3.jpg" alt="" class="image" />
          <div class="image-data">
            <span class="text">Your One-Stop Africa Travel Marketplace</span>
            <h2>
             Explore, Book & Experience Africa<br />
            </h2>
            <!--<a href="about-us" class="button">About Us</a>-->
          </div>
        </div>
      </div>
      <div class="swiper-button-next nav-btn"></div>
      <div class="swiper-button-prev nav-btn"></div>
      <div class="swiper-pagination"></div>
    </section>
  <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
        <!--<div id="slideshow" style="height:510px;">-->
        <!--    <div class="fullwidthbanner-container" style="position:relative; height:510px;">-->
        <!--        <div class="revolution-slider " style="overflow: hidden; height: 100%; margin-top: 0px; margin-bottom: 0px;">-->
        <!--            <ul style="height:100%">-->
        <!--                <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500" style="height:100%">-->
        <!--                    <img src="res/images/slide-08.jpg" alt="" style="width: 100%; height: 100%;">-->
                            
        <!--                   <div style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family:times new roman; font-size:50px; width:100%; height:50%; align-content:center; padding:20% 0 0 10%; transform:translateY(-50%)">-->
        <!--                        <p style="margin-bottom:-15px;">Welcome to your One-Stop Africa Travel Shop</p>-->
        <!--                        <i style="font-family:sans-serif; padding-top:-5px; font-size:20px;">Seamless booking, Quaranteed service</i>-->
        <!--                    </div>-->
        <!--                </li>-->
        
        <!--                <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500" style="height:100%">-->
        <!--                    <img src="res/images/slide-14.jpeg" alt="" style="width: 100%; height: 100%;">-->
        <!--                    <div style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family:times new roman; font-size:50px; width:100%; height:50%; align-content:center; padding:20% 0 0 10%; transform:translateY(-50%)">-->
        <!--                        <p style="margin-bottom:-15px;">Book excursions, tour packages and explore beautiful attraction in Africa</p>-->
        <!--                        <i style="font-family:sans-serif; padding-top:-5px; font-size:20px;">Seamless booking, Quaranteed service</i>-->
        <!--                    </div>-->
                            <!--<div style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family:'Times New Roman', serif; font-size:8vw; width:100%; height:50%; display:flex; flex-direction:column; justify-content:center; align-items:flex-start; padding:20% 0 0 10%; transform:translateY(-50%);">-->
                            <!--    <p style="margin-bottom:-15px; font-size:2.5vw;">Book excursions, tour packages and explore beautiful attraction in Africa</p>-->
                            <!--    <i style="font-family:sans-serif; font-size:1.5vw;">Seamless booking, Guaranteed service</i>-->
                            <!--</div>-->
        <!--                </li>-->
        
        <!--                <li data-transition="slidedown" data-slotamount="7" data-masterspeed="1500" style="height:100%">-->
        <!--                    <img src="res/images/slide-15.jpeg" alt="" style="width: 100%; height: 100%;">-->
        <!--                    <div style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family:times new roman; font-size:50px; width:100%; height:50%; align-content:center; padding:20% 0 0 10%; transform:translateY(-50%)">-->
        <!--                        <p style="margin-bottom:-15px;">Book Apartments, Vacation Homes & Hotels in Africa</p>-->
        <!--                        <i style="font-family:sans-serif; padding-top:-5px; font-size:20px;">Seamless booking, Quaranteed service</i>-->
        <!--                    </div>-->
                            <!--<div style="color:#ffffff; text-shadow: 5px 5px 5px green; transition: 1s ease-in-out 1s; font-family:'Times New Roman', serif; font-size:8vw; width:100%; height:50%; display:flex; flex-direction:column; justify-content:center; align-items:flex-start; padding:20% 0 0 10%; transform:translateY(-50%);">-->
                            <!--    <p style="margin-bottom:-15px; font-size:2.5vw;">Book Apartments, Vacation Homes & Hotels in Africa</p>-->
                            <!--    <i style="font-family:sans-serif; font-size:1.5vw;">Seamless booking, Guaranteed service</i>-->
                            <!--</div>-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        
       
    
        <section id="content">
            <div class="search-box-wrapper">
                <div class="search-box container">
                    <ul class="search-tabs clearfix" style="padding-bottom:20px">
                        <li class="active"><a href="#hotels-tab" data-toggle="tab">Search & Book Accommodation</a></li>
                        <li><a href="#cars-tab" data-toggle="tab">Search & Rent/Book A Car</a></li>
                        <li><a href="#cruises-tab" data-toggle="tab">Search & Book A Tour</a></li>
                        <!--<li><a href="#packages-tab" data-toggle="tab">Packages</a></li>
                        <li><a href="#events-tab" data-toggle="tab">Events</a></li> -->
                    </ul>
                    <div class="visible-mobile" style="padding-bottom:30px">
                        <ul id="mobile-search-tabs" class="search-tabs clearfix" style="padding-bottom:30px">
                            <li class="active"><a href="#hotels-tab" style="padding-bottom:30px">SEARCH & BOOK A HOTEL</a></li>
                            <li><a href="#cars-tab" style="padding-bottom:30px">RENT A CAR / BOOK A TRANSFER</a></li>
                            <li><a href="#cruises-tab" style="padding-bottom:30px">BOOK A TOUR</a></li>
                            <!-- <li><a href="#packages-tab">PACKAGES</a></li> -->
                        </ul>
                    </div>
                    
                    <div class="search-tab-content">
                        <!-- hotel -->
                        <div class="tab-pane fade active in" id="hotels-tab">
                            <form action="hotel-list-view.php" method="GET">
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <!--<h4 class="title"></h4>-->
                                        <label>Your Destination</label>
                                        <div style="position: relative;">
                                              
                                              <!-- begining of Destination Input logic -->
<div class="autocomplete-wrap" style="position:relative;">
  <span style="position:absolute;left:11px;top:50%;transform:translateY(-50%);font-size:16px;pointer-events:none;z-index:2;"></span>
  <input
    type="text"
    name="destination"
    id="hotelAutoCompleteAll"
    class="input-text full-width"
    placeholder="Enter Hotel, City or Country"
    autocomplete="off"
    style="height:45px; border:2px solid #007bff; transition:box-shadow 0.3s; padding-left:34px; width:100%;">
    
  <div id="destinationDropdown"></div>
</div>

<style>
#destinationDropdown {
  display: none;
  position: absolute;
  top: calc(100% + 3px); left: 0; right: 0;
  background: #fff;
  border: 1px solid #d0d8e4;
  border-radius: 4px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  z-index: 999;
  max-height: 280px;
  overflow-y: auto;
  overflow-x: hidden;
}
#destinationDropdown::-webkit-scrollbar { width: 5px; }
#destinationDropdown::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }

.dest-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 14px; cursor: pointer;
  border-bottom: 1px solid #f2f4f8;
  transition: background 0.12s;
}
.dest-item:last-child { border-bottom: none; }
.dest-item:hover, .dest-item.highlighted { background: #eef4fb; }

.dest-icon {
  width: 32px; height: 32px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px; flex-shrink: 0;
}
.dest-icon.hotel   { background: #fff3cd; }
.dest-icon.city    { background: #fde8e8; }
.dest-icon.country { background: #e8f4fd; }

.dest-info { display: flex; flex-direction: column; flex: 1; min-width: 0; }

.dest-top {
  font-size: 10px; font-weight: 700; color: #999;
  text-transform: uppercase; letter-spacing: 0.08em;
  margin-bottom: 2px;
}

.dest-name {
  font-size: 13px; font-weight: 600; color: #1a2a3a;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.dest-name mark {
  background: none; color: #1a6bb5;
  font-weight: 800; padding: 0;
}

.dest-badge {
  font-size: 10px; font-weight: 700; letter-spacing: 0.05em;
  text-transform: uppercase; color: #bbb; flex-shrink: 0;
}
#hotelAutoCompleteAll:focus {
  border-color: #fdb714;
  box-shadow: 0 0 0 3px rgba(253,183,20,0.18);
  outline: none;
}
</style>

<script>
const destinations = <?php
  $results = DB::getInstance()->query("
    SELECT DISTINCT company_name, city, country, id FROM clients
    WHERE groups = 4 AND verified = 1
    AND company_name IS NOT NULL AND company_name != ''
    ORDER BY company_name ASC LIMIT 200
  ");

  $arr         = [];
  $seenCity    = [];
  $seenCountry = [];

  foreach ($results->results() as $h) {

    // Countries — add first, once per unique country
    $countryKey = strtolower(trim($h->country));
    if (!empty($countryKey) && !isset($seenCountry[$countryKey])) {
      $seenCountry[$countryKey] = true;
      $arr[] = [
        'type'    => 'country',
        'name'    => trim($h->country),
        'city'    => '',
        'country' => trim($h->country),
        'hotel_id' => null
      ];
    }

    // Cities — add second, once per unique city
    $cityKey = strtolower(trim($h->city));
    if (!empty($cityKey) && !isset($seenCity[$cityKey])) {
      $seenCity[$cityKey] = true;
      $arr[] = [
        'type'    => 'city',
        'name'    => trim($h->city),
        'city'    => trim($h->city),
        'country' => trim($h->country),
        'hotel_id' => null
      ];
    }

    // Hotels — add last with hotel ID
    if (!empty($h->company_name)) {
      $arr[] = [
        'type'    => 'hotel',
        'name'    => trim($h->company_name),
        'city'    => trim($h->city),
        'country' => trim($h->country),
        'hotel_id' => $h->id
      ];
    }
  }

  echo json_encode(array_values($arr));
?>;

const icons  = { hotel: '🏨', city: '📍', country: '🌍' };
const badges = { hotel: 'Hotel', city: 'City', country: 'Country' };

const input    = document.getElementById('hotelAutoCompleteAll');
const dropdown = document.getElementById('destinationDropdown');
const searchForm = document.querySelector('#hotels-tab form');
let highlighted = -1, filtered = [];
let selectedHotelId = null; // Store selected hotel ID

// Get current search parameters from the form
function getCurrentSearchParams() {
    // Get values from the form inputs
    const inDateHidden = document.querySelector('#in-date-hidden')?.value;
    const outDateHidden = document.querySelector('#out-date-hidden')?.value;
    const rooms = document.querySelector('#rooms')?.value || 1;
    const adults = document.querySelector('#adults')?.value || 1;
    const children = document.querySelector('#children')?.value || 0;
    
    // If date inputs are empty, use defaults
    let inDate = inDateHidden;
    let outDate = outDateHidden;
    
    if (!inDate || !outDate) {
        const today = new Date();
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        inDate = formatDateForUrl(today);
        outDate = formatDateForUrl(tomorrow);
    }
    
    return {
        from: inDate,
        to: outDate,
        adult: adults,
        infant: children,
        room: rooms
    };
}

function formatDateForUrl(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

function escHtml(s) {
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function highlightMatch(text, query) {
  const idx = text.toLowerCase().indexOf(query.toLowerCase());
  if (idx === -1) return escHtml(text);
  return escHtml(text.slice(0, idx))
    + '<mark>' + escHtml(text.slice(idx, idx + query.length)) + '</mark>'
    + escHtml(text.slice(idx + query.length));
}

function close() {
  dropdown.style.display = 'none';
  highlighted = -1;
}

function render(q) {
  if (q.length < 2) { close(); return; }

  filtered = destinations.filter(d =>
    d.name.toLowerCase().includes(q.toLowerCase()) ||
    d.city.toLowerCase().includes(q.toLowerCase()) ||
    d.country.toLowerCase().includes(q.toLowerCase())
  ).slice(0, 10);

  if (!filtered.length) { close(); return; }

  dropdown.innerHTML = filtered.map((d, i) => {
    let topLine = '';
    if (d.type === 'hotel') {
      topLine = `${d.country} › ${d.city}`;
    } else if (d.type === 'city') {
      topLine = d.country;
    } else {
      topLine = 'Country';
    }

    return `
      <div class="dest-item" data-i="${i}" data-type="${d.type}" data-hotel-id="${d.hotel_id || ''}">
        <div class="dest-icon ${d.type}">${icons[d.type]}</div>
        <div class="dest-info">
          <span class="dest-top">${escHtml(topLine)}</span>
          <span class="dest-name">${highlightMatch(d.name, q)}</span>
        </div>
        <span class="dest-badge">${badges[d.type]}</span>
      </div>`;
  }).join('');

  highlighted = -1;
  dropdown.style.display = 'block';

  dropdown.querySelectorAll('.dest-item').forEach(el => {
    el.addEventListener('mousedown', e => { 
      e.preventDefault(); 
      const hotelId = el.dataset.hotelId;
      const type = el.dataset.type;
      const i = parseInt(el.dataset.i);
      const selectedItem = filtered[i];
      
      // Fill the input with the selected name
      input.value = selectedItem.name;
      
      // If it's a hotel, store the hotel ID for later use
      if (type === 'hotel' && hotelId) {
        selectedHotelId = hotelId;
        // Add a data attribute to the form to indicate hotel is selected
        searchForm.setAttribute('data-selected-hotel', hotelId);
      } else {
        // Clear hotel selection for city/country
        selectedHotelId = null;
        searchForm.removeAttribute('data-selected-hotel');
      }
      
      close();
    });
  });
}

// Intercept form submission
searchForm.addEventListener('submit', function(e) {
    const hotelId = searchForm.getAttribute('data-selected-hotel');
    
    // If a hotel is selected, redirect to hotel detail page
    if (hotelId) {
        e.preventDefault(); // Stop normal form submission
        const params = getCurrentSearchParams();
        const redirectUrl = `hotel-detailed?hotel=${hotelId}&from=${params.from}&to=${params.to}&adult=${params.adult}&infant=${params.infant}&room=${params.room}`;
        window.location.href = redirectUrl;
    }
    // If no hotel selected, let the form submit normally to hotel-list-view
});

input.addEventListener('input', () => {
    render(input.value.trim());
    // Clear hotel selection when user types new text
    if (selectedHotelId) {
        selectedHotelId = null;
        searchForm.removeAttribute('data-selected-hotel');
    }
});

input.addEventListener('blur',  () => setTimeout(close, 150));

input.addEventListener('keydown', e => {
  const items = dropdown.querySelectorAll('.dest-item');
  if (!items.length) return;
  
  if (e.key === 'ArrowDown') {
    e.preventDefault(); 
    highlighted = Math.min(highlighted + 1, items.length - 1);
  } else if (e.key === 'ArrowUp') {
    e.preventDefault(); 
    highlighted = Math.max(highlighted - 1, 0);
  } else if (e.key === 'Enter' && highlighted >= 0) {
    e.preventDefault();
    const selectedItem = items[highlighted];
    const hotelId = selectedItem.dataset.hotelId;
    const type = selectedItem.dataset.type;
    const i = highlighted;
    const selectedDest = filtered[i];
    
    // Fill the input
    input.value = selectedDest.name;
    
    // Store hotel ID if hotel is selected
    if (type === 'hotel' && hotelId) {
        selectedHotelId = hotelId;
        searchForm.setAttribute('data-selected-hotel', hotelId);
    } else {
        selectedHotelId = null;
        searchForm.removeAttribute('data-selected-hotel');
    }
    
    close();
    return;
  } else if (e.key === 'Escape') {
    close(); 
    return;
  }
  
  items.forEach((el, i) => el.classList.toggle('highlighted', i === highlighted));
  if (items[highlighted]) items[highlighted].scrollIntoView({ block: 'nearest' });
});

// Add visual indicator for hotel items
function addRedirectIndicator() {
  const style = document.createElement('style');
  style.textContent = `
    .dest-item[data-type="hotel"] .dest-badge::after 
    .dest-item[data-type="hotel"]:hover .dest-badge::after {
      color: #e6a60a;
    }
  `;
  document.head.appendChild(style);
}

addRedirectIndicator();
</script>

                                              <!-- ending of Destination Input logic -->

                                              <div class="pin1" style="background-color: #007bff;"></div>
                                            </div>
                                            
                                            <style>
                                            .pin1 {
                                              position: absolute;
                                              top: 30%;
                                              left: 6px; /* Adjusted left position */
                                              /* margin-left: -115px; Removed fixed margin */
                                            
                                              border-radius: 50% 50% 50% 0;
                                              border: 2px solid #fff; /* Adjusted border width to match input border */
                                              width: 15px; /* Adjusted size */
                                              height: 15px; /* Adjusted size */
                                              transform: rotate(-45deg);
                                            }
                                            
                                            .pin1::after {
                                              position: absolute;
                                              content: '';
                                              width: 7px; /* Adjusted size */
                                              height: 7px; /* Adjusted size */
                                              border-radius: 50%;
                                              top: 50%;
                                              left: 50%;
                                              margin-left: -3.5px; /* Adjusted margin */
                                              margin-top: -3.5px; /* Adjusted margin */
                                              background-color: #fff;
                                            }
                                            </style>

                                        <div id="autocomplete-container" style=""></div>
                                        
                                        <!-- <div class="selector">
                                            <select name="country" required="required" class="full-width">
                                                <option value="">Any</option>
                                                <?php $countries = list_countries(); foreach($countries->results() as $key => $value): ?>
                                                    <option value="<?php echo $value->country ?>"><?php echo $value->country ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div> -->
                                        
                                    </div>
                                    
                                    <!--<div class="form-group col-sm-6 col-md-4">-->
                                        <!--<h4 class="title"></h4>-->
                                    <!--    <div class="row">-->
                                    <!--        <div class="col-xs-6">-->
                                    <!--            <label>Check In</label>-->
                                    <!--            <div class="datepicker-wrap" style="height: 43px;">-->
                                    <!--                <input type="text" name="in-date" id="in-date" class="input-text full-width" placeholder="mm/dd/yy" style="height:45px; border: 2px solid #007bff; transition: box-shadow 0.3s" required />-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--        <div class="col-xs-6">-->
                                    <!--            <label>Check Out</label>-->
                                    <!--            <div class="datepicker-wrap" style="height: 43px;">-->
                                    <!--                <input type="text" name="out-date" id="out-date" class="input-text full-width" placeholder="mm/dd/yy" style="height:45px; border: 2px solid #007bff; transition: box-shadow 0.3s" required />-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                    <div class="form-group col-sm-6 col-md-4">
                                        <!--<h4 class="title"></h4>-->
                                        <div class="row">
                                            
                                             <div class="col-xs-12">
                                                <label>Check In/Check-Out</label>
                                                <div style="position: relative;">
                                                    <input type="text" name="date" id="date-in-out" class="input-text full-width" placeholder="Check-In-Date - Check-Out-Date" style=" height: 45px; border: 2px solid #007bff; transition: box-shadow 0.3s; color: #01b7f2; padding-left: 35px;" required="required" />
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor" style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                                        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zm-7-5c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3z"/>
                                                    </svg>
                                                    <input type="hidden" name="in-date" id="in-date-hidden">
                                                    <input type="hidden" name="out-date" id="out-date-hidden">
                                                </div>
                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    .flatpickr-calendar {
      /* You might want to adjust the background color of the calendar itself */
      /* background-color: #fff; */
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.endRange {
      background: #fdb714 !important;
      color: #fff !important; /* Ensure text color is readable */
      border-color: #fdb714 !important;
    }

    .flatpickr-day.today {
      border-color: #fdb714;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months.flatpickr-dropdown-container,
    .flatpickr-current-month .flatpickr-yearDropdown-years.flatpickr-dropdown-container {
      background: #fdb714 !important;
      color: #fff !important;
    }

    .flatpickr-current-month .flatpickr-monthDropdown-months:hover,
    .flatpickr-current-month .flatpickr-yearDropdown-years:hover {
      background: #e6a60a !important; /* A slightly darker shade for hover */
    }

    .flatpickr-prev-month svg,
    .flatpickr-next-month svg {
      fill: #fdb714;
    }

    .flatpickr-weekday {
      color: #333; /* Adjust weekday color as needed */
    }

    .flatpickr-day {
      color: #333; /* Adjust day color as needed */
    }

    .flatpickr-disabled {
      color: rgba(0, 0, 0, 0.3) !important;
    }
  </style>
                                                <script>
                                                document.addEventListener('DOMContentLoaded', function() {
  let inDateSelected = null;
  let outDateSelected = null;
  const inputElement = document.getElementById('date-in-out');
  const inDateHidden = document.getElementById('in-date-hidden'); // Get reference to hidden in-date input
  const outDateHidden = document.getElementById('out-date-hidden'); // Get reference to hidden out-date input

  const fp = flatpickr("#date-in-out", {
    mode: "range",
    dateFormat: "D, M j",
    onOpen: function(selectedDates, dateStr, instance) {
      if (!inDateSelected || !outDateSelected) {
        inputElement.value = "In-date - Out-date";
      } else {
        inputElement.value = formatDate(inDateSelected) + " - " + formatDate(outDateSelected);
      }
    },
    onChange: function(selectedDates, dateStr, instance) {
      if (selectedDates.length === 1) {
        inDateSelected = selectedDates[0];
        inputElement.value = "In-date: " + formatDate(inDateSelected) + " - Out-date";
        inDateHidden.value = ''; // Clear hidden fields if only one date selected
        outDateHidden.value = '';
      } else if (selectedDates.length === 2) {
        inDateSelected = selectedDates[0];
        outDateSelected = selectedDates[1];
        inputElement.value = formatDate(inDateSelected) + " - " + formatDate(outDateSelected);
        inDateHidden.value = formatForSubmission(inDateSelected); // Format for submission
        outDateHidden.value = formatForSubmission(outDateSelected); // Format for submission
        fp.close();
      } else {
        inDateSelected = null;
        outDateSelected = null;
        inputElement.value = "In-date - Out-date";
        inDateHidden.value = '';
        outDateHidden.value = '';
      }
    },
    onClose: function(selectedDates, dateStr, instance) {
      if (selectedDates.length === 1) {
        inputElement.value = "In-date: " + formatDate(selectedDates[0]) + " - Out-date";
      } else if (selectedDates.length === 2) {
        inputElement.value = formatDate(selectedDates[0]) + " - " + formatDate(selectedDates[1]);
      } else {
        inputElement.value = "In-date - Out-date";
      }
    }
  });

  function formatDate(date) {
    const dayOfWeek = new Intl.DateTimeFormat('en-US', { weekday: 'short' }).format(date);
    const month = new Intl.DateTimeFormat('en-US', { month: 'short' }).format(date);
    const dayOfMonth = date.getDate();
    return `${dayOfWeek}, ${month} ${dayOfMonth}`;
  }

  function formatForSubmission(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`; // Format for hidden input value (YYYY-MM-DD)
  }
});
</script>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--<div class="form-group col-sm-6 col-md-3">-->
                                        <!--<h4 class="title"></h4>-->
                                    <!--    <div class="row">-->
                                    <!--        <div class="col-xs-4">-->
                                    <!--            <label>Rooms</label>-->
                                    <!--            <div class="selector" style="height: 44px;">-->
                                    <!--                <select class="full-width" name="room-qty" style=" height: 45px; border: 2px solid #007bff; transition: box-shadow 0.3s">-->
                                    <!--                    <option value="1">1</option>-->
                                    <!--                    <option value="2">2</option>-->
                                    <!--                    <option value="3">3</option>-->
                                    <!--                    <option value="4">4</option>-->
                                    <!--                    <option value="5">5</option>-->
                                    <!--                    <option value="6">6</option>-->
                                    <!--                    <option value="7">7</option>-->
                                    <!--                    <option value="8">8</option>-->
                                    <!--                    <option value="9">9</option>-->
                                    <!--                </select><span class="custom-select full-width" style="height: 45px; border: 2px solid #007bff; transition: box-shadow 0.3s">1</span>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--        <div class="col-xs-4">-->
                                    <!--            <label>Adults</label>-->
                                    <!--            <div class="selector" style="height:44px; ">-->
                                    <!--                <select class="full-width" name="adult" style="height:40px; border: 2px solid #007bff; transition: box-shadow 0.3s">-->
                                    <!--                    <option value="1">1</option>-->
                                    <!--                    <option value="2">2</option>-->
                                    <!--                    <option value="3">3</option>-->
                                    <!--                    <option value="4">4</option>-->
                                    <!--                    <option value="4">5</option>-->
                                    <!--                    <option value="4">6</option>-->
                                    <!--                    <option value="4">7</option>-->
                                    <!--                    <option value="4">8</option>-->
                                    <!--                </select><span class="custom-select full-width" style="height:45px; border: 2px solid #007bff; transition: box-shadow 0.3s">1</span>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--        <div class="col-xs-4">-->
                                    <!--            <label>Kids</label>-->
                                    <!--            <div class="selector" style="height:44px;">-->
                                    <!--                <select class="full-width" name="infant" style="height:40px">-->
                                    <!--                    <option value="0">0</option>-->
                                    <!--                    <option value="1">1</option>-->
                                    <!--                    <option value="2">2</option>-->
                                    <!--                    <option value="3">3</option>-->
                                    <!--                    <option value="4">4</option>-->
                                    <!--                </select><span class="custom-select full-width" style="height:45px; border: 2px solid #007bff;  transition: box-shadow 0.3s">0</span>-->
                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    
                                    <div class="form-group col-sm-6 col-md-3">
                                        <!--<h4 class="title"></h4>-->
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label>Guests & Room</label>
                                                <div class="guest-selector col-xs-12">
                                                    <div class="selector-trigger" style="color: #01b7f2">Room - Adult - Children</div>
                                                      <div class="guest-controls">
                                                        <div class="guest-category">
                                                          <label for="rooms" style="padding-right:18px">Rooms</label>
                                                          <div class="counter">
                                                            <span class="decrement" data-type="rooms" style="padding: 5px 10px; border: 1px solid #ccc; background-color: #eee; cursor: pointer; border-radius: 3px; user-select: none;">&minus;</span>
                                                            <input type="number" id="rooms" name="room-qty" value="1" min="1">
                                                            <!--<button type="button" class="increment" data-type="rooms">+</button>-->
                                                            <span class="increment" data-type="rooms" style="padding: 5px 10px; border: 1px solid #ccc; background-color: #eee; cursor: pointer; border-radius: 3px; user-select: none;">&plus;</span>
                                                          </div>
                                                        </div>
                                                        <div class="guest-category">
                                                          <label for="adults" style="padding-right:18px">Adults</label>
                                                          <div class="counter">
                                                            <span class="decrement" data-type="adults" style="padding: 5px 10px; border: 1px solid #ccc; background-color: #eee; cursor: pointer; border-radius: 3px; user-select: none;">&minus;</span>
                                                            <input type="number" id="adults" name="adult" value="1" min="1">
                                                            <span class="increment" data-type="adults" style="padding: 5px 10px; border: 1px solid #ccc; background-color: #eee; cursor: pointer; border-radius: 3px; user-select: none;">&plus;</span>
                                                          </div>
                                                        </div>
                                                        <div class="guest-category">
                                                          <label for="children" style="padding-right:5px">Children</label>
                                                          <div class="counter">
                                                            <span class="decrement" data-type="children" style="padding: 5px 10px; border: 1px solid #ccc; background-color: #eee; cursor: pointer; border-radius: 3px; user-select: none;">&minus;</span>
                                                            <input type="number" id="children" name="infant" value="0" min="0">
                                                            <span class="increment" data-type="children" style="padding: 5px 10px; border: 1px solid #ccc; background-color: #eee; cursor: pointer; border-radius: 3px; user-select: none;">&plus;</span>
                                                          </div>
                                                        </div>
                                                        <div class="actions">
                                                          <button type="button" class="apply-guests">Apply</button>
                                                          <button type="button" class="cancel-guests">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>

<style>
.guest-selector {
  border: 2px solid #007bff;
  transition: box-shadow 0.3s;
  font-family: sans-serif;
  position: relative; /* To position the dropdown */
  width: 100%; /* Adjust width as needed */
  height: 45px;
}

.selector-trigger {
  cursor: pointer;
  padding: 10px 15px;
}

.guest-controls {
  display: none; /* Initially hidden */
  position: absolute;
  top: 100%; /* Position below the trigger */
  left: 0;
  right: 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border-top: none;
  z-index: 10; /* Ensure it's above other elements */
  padding: 15px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.guest-category {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.counter {
  display: flex;
  align-items: center;
}

.counter button {
  padding: 6px 12px;
  border: 1px solid #ddd;
  background-color: #f8f8f8;
  cursor: pointer;
 
}

.counter input[type="number"] {
  width: 100%;
  text-align: center;
  margin: 0 8px;
  border: 1px solid #ddd;
  padding: 6px;
 
  -moz-appearance: textfield; /* Firefox */
}

.counter input[type="number"]::-webkit-outer-spin-button,
.counter input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 15px;
}

.actions button {
  padding: 0px 15px;
  margin-left: 10px;
  border: none;
  cursor: pointer;
  font-weight: bold;
}

.actions .apply-guests {
  background-color: #fdb714;
  color: white;
}

.actions .cancel-guests {
  background-color: #f0f0f0;
  color: #333;
}

/*cookie notification pop up*/
/* Notification Container Styles */
.notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    max-width: 350px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Individual Notification Styles */
.notification {
    position: relative;
    padding: 15px 20px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: white;
    overflow: hidden;
    transform: translateX(100%);
    opacity: 0;
    animation: slideIn 0.5s forwards, fadeIn 0.5s forwards;
    transition: all 0.3s ease;
}

/* Welcome Notification */
.notification-welcome {
    background: linear-gradient(135deg, #4a6bff, #6a11cb);
    border-left: 5px solid #3a5bed;
}

/* Incomplete Actions Notification */
.notification-incomplete {
    background: linear-gradient(135deg, #ff7b4a, #ff2d75);
    border-left: 5px solid #ff6b3a;
}

/* Notification Content */
.notification h3 {
    margin-top: 0;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

.notification ul {
    margin: 0;
    padding-left: 20px;
}

.notification li {
    margin-bottom: 8px;
}

.notification a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-block;
}

.notification a:hover {
    text-decoration: underline;
    transform: translateX(5px);
}

/* Close Button */
.notification-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.3);
    border: none;
    color: white;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    cursor: pointer;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.notification-close:hover {
    background: rgba(255, 255, 255, 0.5);
    transform: rotate(90deg);
}

/* Animations */
@keyframes slideIn {
    to {
        transform: translateX(0);
    }
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .notification-container {
        max-width: 280px;
        right: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const guestSelector = document.querySelector('.guest-selector');
  const selectorTrigger = document.querySelector('.selector-trigger');
  const guestControls = document.querySelector('.guest-controls');
  const incrementButtons = document.querySelectorAll('.increment');
  const decrementButtons = document.querySelectorAll('.decrement');
  const applyButton = document.querySelector('.apply-guests');
  const cancelButton = document.querySelector('.cancel-guests');
  const roomsInput = document.getElementById('rooms');
  const adultsInput = document.getElementById('adults');
  const childrenInput = document.getElementById('children');

  function updateTriggerLabel() {
    const rooms = parseInt(roomsInput.value);
    const adults = parseInt(adultsInput.value);
    const children = parseInt(childrenInput.value);
    selectorTrigger.textContent = `${rooms} Room${rooms > 1 ? 's' : ''} - ${adults} Adult${adults > 1 ? 's' : ''} - ${children} Child${children !== 1 ? 'ren' : ''}`;
  }

  selectorTrigger.addEventListener('click', function() {
    guestControls.style.display = guestControls.style.display === 'none' ? 'block' : 'none';
  });

  incrementButtons.forEach(button => {
    button.addEventListener('click', function() {
      const type = this.dataset.type;
      const inputField = document.getElementById(type);
      inputField.value = parseInt(inputField.value) + 1;
    });
  });

  decrementButtons.forEach(button => {
    button.addEventListener('click', function() {
      const type = this.dataset.type;
      const inputField = document.getElementById(type);
      const currentValue = parseInt(inputField.value);
      if (currentValue > (type === 'children' ? 0 : 1)) {
        inputField.value = currentValue - 1;
      }
    });
  });

  applyButton.addEventListener('click', function() {
    updateTriggerLabel();
    guestControls.style.display = 'none';
    // You can add further logic here to handle the selected values
  });

  cancelButton.addEventListener('click', function() {
    guestControls.style.display = 'none';
    // Optionally, you could revert the values to their previous state
  });

  // Close the dropdown if the user clicks outside of it
  document.addEventListener('click', function(event) {
    if (!guestSelector.contains(event.target) && guestControls.style.display === 'block') {
      guestControls.style.display = 'none';
    }
  });

  // Initial label update
  updateTriggerLabel();
});
</script>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-sm-6 col-md-2 fixheight" style="padding-top: 22px;">
                                        <!--<label class="hidden-xs">&nbsp;</label>-->
                                        <!--Program Search Now-->
                                        <button type="submit" class="full-width icon-check animated bounce" data-animation-type="bounce" data-animation-duration="1" style="animation-duration: 1s; visibility: visible;height:45px">SEARCH NOW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /hotel -->
                        
                        
                        <!-- transfer -->
                        <div class="tab-pane fade" id="cars-tab">
                            <form action="car-list-view" method="get" id="frmCar">
                                <div class="row">
                                    <style>
                                        span.custom-select{
                                            height:41px;
                                        }
                                        .selector span.custom-select{
                                            line-height: 45px;
                                        }
                                    </style>
                                    <div class="col-md-4">
                                        
                                        <div class="form-group">
                                            <label>Country</label>
                                            <div class="row">
                                                
                                                <div class="col-xs-6">
                                                    <div class="selector" style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                        <select name="country" onchange="listTransCities(this.value)" required="required" class="full-width" >
                                                            <option value="">Select Country</option>
                                                            <?php $countriesEx = DB::getInstance()->query("SELECT DISTINCT country FROM transfers ORDER BY country ASC"); 
                                                                foreach($countriesEx->results() as $key => $ex): ?>
                                                                <option value="<?php echo $ex->country ?>"><?php echo $ex->country ?></option>
                                                            <?php endforeach ?>
                                                       </select>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-xs-6">
                                                    <div class="selector" style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                        <select name="city" class="full-width" id="transfer_city"  required="required" >
                                                            <option>Select City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                   <div class="col-md-4">
                                        <!--<h4 class="title">&nbsp;</h4>-->
                                        <div class="form-group">
                                            <label>Category</label>
                                            <div class="row">
                                                
                                                <div class="col-xs-6">
                                                    <div class="selector" style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                        <select class="full-width" name="cat" id="book-type" required="required" onchange={getBookType(this.value)}>
                                                            <option>Select Request Type</option>
                                                            <option value="Point-to-Point-Transfer">Point-To-Point Transfers</option>
                                                            <option value="Rent-A-Car">Rent-A-Car</option>
                                                        </select>
                                                    </div>
                                                </div>
                                   
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" required="required"   style=" height: 45px; border: 2px solid #007bff; transition: box-shadow 0.3s" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <!--<h4 class="title">&nbsp;</h4>-->
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Passengers</label>
                                                <div class="selector" style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                    <select class="full-width" name="adult" >
                                                        <option value="1">01</option>
                                                        <option value="2">02</option>
                                                        <option value="3">03</option>
                                                        <option value="4">04</option>
                                                        <option value="5">05</option>
                                                        <option value="6">06</option>
                                                        <option value="7">07</option>
                                                        <option value="8">08</option>
                                                        <option value="9">09</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <label>&nbsp;</label>
                                                <button class="full-width icon-check"  style=" height: 45px;" >SERACH NOW</button>
                                            </div>
                                        </div>
                                        <!--<div class="form-group row">-->
                                        <!--    <div class="col-xs-6">-->
                                        <!--        <label>Car Type</label>-->
                                        <!--        <div class="selector">-->
                                        <!--            <select class="full-width" name="car">-->
                                        <!--                <option value="">select a car type</option>-->
                                                        <!--function car selector-->
                                        <!--                <option value="economy">Economy</option>-->
                                        <!--                <option value="compact">Compact</option>-->
                                        <!--                <option value="Bus">Bus</option>-->
                                        <!--                <option value="Mini Bus">Mini Bus</option>-->
                                        <!--                <option value="Economy Sedan">Economy Sedan</option>-->
                                        <!--                <option value="Suv">Suv</option>-->
                                        <!--            </select>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                            <!--<div class="col-xs-6">-->
                                            <!--    <label>&nbsp;</label>-->
                                            <!--    <button class="full-width icon-check">SERACH NOW</button>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /transfer -->

                        <!-- sightseing -->
                        <div class="tab-pane fade" id="cruises-tab">
                            <form action="cruise-list-view" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--<h4 class="title"></h4>-->
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <div class="selector" style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                <select class="full-width" name="country" required="required" >
                                                    <option value="">Select</option>
                                                    <?php $seeing = $conn->query("SELECT DISTINCT country FROM excursion ORDER BY country ASC");
                                                        if($seeing->count()){foreach ($seeing->results() as $key => $sight) {
                                                    ?>
                                                    <option value="<?php echo $sight->country ?>"><?php echo $sight->country ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <!--<h4 class="title"></h4>-->
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <label>Departure Date</label>
                                                <div class="datepicker-wrap">
                                                    <input type="text" name="date_on" class="input-text full-width" placeholder="mm/dd/yy" style=" height: 45px; border: 2px solid #007bff; transition: box-shadow 0.3s" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6 hidden">
                                                <label>Children</label>
                                                <div class="selector " style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                    <input type="text" name="kids" class="input-text full-width" value="1" placeholder="Children Allowed" style=" height: 45px; border: 2px solid #007bff; transition: box-shadow 0.3s" required="required" />
                                                    <!--<select class="full-width" name="kids">-->
                                                    <!--    <option value="1"> Allowed</option>-->
                                                        <!--<option value="0">Not Allowed</option>-->
                                                    <!--</select>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                 <div class="col-md-4">
                                        <!--<h4 class="title"></h4>-->
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label>Type</label>
                                                
                                                <div class="selector" style="border: 2px solid #007bff;  transition: box-shadow 0.3s">
                                                    <select class="full-width" required="required" name="group">
                                                        <option value="" disabled selected>Select your type</option>
                                                        <option value="All">All</option>
                                                        
                                                         <?php $typeEx = DB::getInstance()->query("SELECT DISTINCT `cat` FROM excursion"); 
                                                            foreach($typeEx->results() as $key => $t): ?>
                                                            <option value="<?php echo $t->cat ?>"><?php echo $t->cat ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <!--<div class="selector">-->
                                                <!--    <select class="full-width" required="required" name="type">-->
                                                <!--        <option value="">select a type</option>-->
                                                        <!--function car selector-->
                                                <!--        <option value="economy">All</option>-->
                                                <!--        <option value="compact">Ticket Only</option>-->
                                                                                
                                                <!--                                  /*  // Assuming $selectedOption holds the value selected by the user-->
                                                <!--                                    $selectedOption = $_POST['selected_option']; // or however you're getting the selected option-->
                                                                                    
                                                <!--                                   // if ($selectedOption == 'default') {-->
                                                <!--                                        // Fetch all types in that country-->
                                                <!--                                        $country = $_POST['country']; // Assuming you have the country value available-->
                                                <!--                                        $typeEx = DB::getInstance()->query("SELECT DISTINCT type FROM excursion WHERE country = ?", array($country));-->
                                                <!--                                    } else {-->
                                                <!--                                        // Fetch types based on the selected option-->
                                                <!--                                        $typeEx = DB::getInstance()->query("SELECT DISTINCT type FROM excursion");-->
                                                <!--                                    }-->
                                                                                    
                                                <!--                                    foreach($typeEx->results() as $key => $t):-->
                                                <!--                                        // Your code to display types-->
                                                <!--                                        ?>-->
                                                <!--                                        <option value="<?php echo $t->type ?>"><?php echo $t->type ?></option>-->
                                                                                        
                                                                                    
                                                                                

                                                <!--    </select>-->
                                                <!--</div>-->
                                            </div>
                                            <div class="col-xs-6">
                                                <label>&nbsp;</label>
                                                <button class="icon-check full-width" type="submit" style=" height: 45px;">SEARCH NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /sightseeing -->
                        <!-- packages -->
                        <div class="tab-pane fade" id="packages-tab">
                            <form action="packages" method="post">
                                <div class="row"><br>
                                    <h4> Welcome to a world of exciting tours across Africa</h4>
                                    <h5>Book from Private and Group Tour Packages, Vacations, Honeymoon, Family and Individual Vacations. Packages are either all inclusive or semi-ackage</h5>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <a href="packages"><button class="icon-check full-width">EXPORE OUR PACKAGES NOW</button></a>
                                            </div>
                                            <!-- <div class="col-xs-6"> -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /packages -->

                        
                        
                    </div>
                </div>
            </div>
            
            <!-- <div class="section container">-->
            <!--    <div class="description text-center">-->
            <!--        <h3>Why Book with Us</h3>-->
            <!--    </div>-->
            <!--    <div class="row image-box style4">-->
            <!--        <div class="article-container">-->
            <!--            <article class="col-sm-12 box animated">-->
            <!--                <ul>-->
            <!--                    <li class="scroll-text" >24/7 Support</li>-->
            <!--                    <li class="scroll-text">Guaranteed Cheaper Rates</li>-->
            <!--                    <li class="scroll-text">Pay Now or Reserve And Pay later</li>-->
            <!--                </ul>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
           
           
           <!--cookie pop up effect-->
           <div class="notification-container">
                <!-- Welcome Notification -->
                <div class="notification notification-welcome">
                    <button class="notification-close" onclick="this.parentElement.style.display='none'">×</button>
                    <div class="notification-content">
                        <?php echo $welcomeMessage; ?>
                    </div>
                </div>
                
                <!-- Incomplete Actions Notification -->
                <?php if (!empty($_SESSION['incomplete_actions'])): ?>
                <div class="notification notification-incomplete">
                    <button class="notification-close" onclick="this.parentElement.style.display='none'">×</button>
                    <div class="notification-content">
                        <h3>Continue where you left off:</h3>
                        <ul>
                            <?php foreach ($_SESSION['incomplete_actions'] as $action): ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($action['page_url']); ?>">
                                    Complete your <?php echo htmlspecialchars(str_replace('form_', '', $action['action_type'])); ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
           <!--end of cookie pop up-->
            
            <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
                <div class="container description">
                    <h3>Why Book with Us</h3>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInLeft" data-animation-delay="0">
                            <i class="soap-icon-support"></i>
                            <div class="description">
                                <h4 class="box-title">24/7 Sales Support</h4>
                                <p style="color:white">Our Global Support Team is Available Anytime Anyday </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.6">
                            <i class="soap-icon-recommend"></i>
                            <div class="description">
                                <h4 class="box-title">Guaranteed Cheaper Rates</h4>
                                <p style="color:white">Competitive Rates with Assured and Quaranteed Excellent Service </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.9">
                            <i class="soap-icon-insurance"></i>
                            <div class="description">
                                <h4 class="box-title">Pay Now or Reserve And Pay later</h4>
                                <p style="color:white">You can Pay Now, Pay Directly to Supplier or Reserve and Pay later</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.9">
                            <i class="soap-icon-insurance"></i>
                            <div class="description">
                                <h4 class="box-title">Direct to Supplier</h4>
                                <p style="color:white">Booking Are Handled Directly by Experienced and Credible Suppliers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <style>
                 .section{
                    padding-top: 20px;
                    padding-bottom: 10px;
                }
            </style>
            <div class="section container">
                <div class="description text-center">
                        <h1>Super Hot Deals and Promos</h1>
                </div>

<style>
                /* Hide the filter container by default on larger screens */
.mobile-filter-container {
    display: none;
}

/* Show the filter container on mobile devices (adjust the max-width as needed) */
@media (max-width: 768px) { /* Example breakpoint for mobile */
    .mobile-filter-container {
        display: block; /* Or any other appropriate display property like 'flex', 'grid', etc. */
    }
}
.desktop-filter-container {
    display: none;
}

/* Show the filter container on mobile devices (adjust the max-width as needed) */
@media (min-width: 768px) { /* Example breakpoint for mobile */
    .desktop-filter-container {
        display: block; /* Or any other appropriate display property like 'flex', 'grid', etc. */
    }
}

/* Apply horizontal scrolling to the image box row only on mobile devices */
@media (max-width: 768px) { /* Adjust the max-width breakpoint as needed for your definition of mobile */
    .row.image-box.style4 {
        overflow-x: auto;
        white-space: nowrap;
        padding-bottom: 10px; /* Optional */
    }

    .row.image-box.style4 > .col-sm-4 {
        display: inline-block;
        float: none;
    }
}
</style>
                <div class="row image-box style4 mobile-filter-container">
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0">
                            <figure>
                                <!--Insert pix from Super Admin Add New Pix-->
                                
                                <a title="Deal of the day" href="deals"><img width="370" style="height:172px; border-radius: 20px" alt="" src="res/images/deal.jpg"><span class="discount"><span class="discount-text">Deal of the Day</span></span></a>
                                 <!--<a title="Deal of the day" href="#" class="hover-effect popup-gallery"><img width="370" style="height:172px" alt="" src="res/images/deal.jpg"><span class="discount"><span class="discount-text">10% Discount</span></span></a>-->
                            </figure>
                            <!--<div class="details">-->
                            <!--    <h4 class="box-title">Deal of the Day</h4>-->
                            <!--    <a class="goto-detail" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>-->
                            <!--</div>-->
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.3">
                            <figure>
                                <a title="" href="deals" class=""><img width="370" style="height:172px; border-radius: 20px" alt="" src="res/images/promo.jpg"><span class="discount"><span class="discount-text">Discounts Off</span></span></a>
                            </figure>
                            <!--<div class="details">-->
                            <!--    <h4 class="box-title">Promo</h4>-->
                            <!--    <a class="goto-detail" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>-->
                            <!--</div>-->
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.6">
                            <figure>
                                <a title="" href="deals" class=""><img width="370" style="height:172px; border-radius: 20px" alt="" src="res/images/Special-offer.jpg"></a>
                            </figure>
                            <!--<div class="details">-->
                            <!--    <h4 class="box-title">Special Offer</h4>-->
                            <!--    <a class="goto-detail" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>-->
                            <!--</div>-->
                        </article>
                    </div>
                </div>
                <div class="row image-box style4 desktop-filter-container">
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0">
                            <figure>
                                <!--Insert pix from Super Admin Add New Pix-->
                                
                                <a title="Deal of the day" href="deals"><img width="370" style="height:172px; border-radius: 20px" alt="" src="res/images/deal.jpg"><span class="discount"><span class="discount-text">Deal of the Day</span></span></a>
                                 <!--<a title="Deal of the day" href="#" class="hover-effect popup-gallery"><img width="370" style="height:172px" alt="" src="res/images/deal.jpg"><span class="discount"><span class="discount-text">10% Discount</span></span></a>-->
                            </figure>
                            <!--<div class="details">-->
                            <!--    <h4 class="box-title">Deal of the Day</h4>-->
                            <!--    <a class="goto-detail" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>-->
                            <!--</div>-->
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.3">
                            <figure>
                                <a title="" href="deals" class=""><img width="370" style="height:172px; border-radius: 20px" alt="" src="res/images/promo.jpg"><span class="discount"><span class="discount-text">Discounts Off</span></span></a>
                            </figure>
                            <!--<div class="details">-->
                            <!--    <h4 class="box-title">Promo</h4>-->
                            <!--    <a class="goto-detail" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>-->
                            <!--</div>-->
                        </article>
                    </div>
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.6">
                            <figure>
                                <a title="" href="deals" class=""><img width="370" style="height:172px; border-radius: 20px" alt="" src="res/images/Special-offer.jpg"></a>
                            </figure>
                            <!--<div class="details">-->
                            <!--    <h4 class="box-title">Special Offer</h4>-->
                            <!--    <a class="goto-detail" href="#"><span class="glyphicon glyphicon-arrow-right"></span></a>-->
                            <!--</div>-->
                        </article>
                    </div>
                </div>
            </div>
            
            
            
            <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="description text-center">
                        <h1>Recommended Aparthotels</h1>
                        <p style="color:#fff">Featured Aparthotels sure to meet your accommodation need</p>
                    </div>
                    <div class="image-carousel style3 flex-slider desktop-filter-container" data-item-width="270" data-item-margin="30">
                        <ul class="slides image-box style9">
                            <?php 
                                $today = date('m/d/Y');$date = new DateTime($today); $tomrw = $date->add(new DateInterval('P1D'))->format('m/d/Y');
                                $buffer = DB::getInstance()->query("SELECT * FROM clients WHERE groups = 4 AND verified = 1 ORDER BY id DESC LIMIT 12");
                                    if($buffer->count()){
                                        foreach ($buffer->results() as $key => $htl) {
                                            $image = DB::getInstance()->query("SELECT * FROM media WHERE hid = $htl->id LIMIT 1");
                                            if($image->count()){
                                                foreach ($image->results() as $key => $img) {$path = 'hotels/'.$img->path;}    
                                            }else{$path = 'http://placehold.it/170x160';}
                            ?>  
                            <li>
                            <?php
                            // Local DB reviews
                            $localCountQuery = "SELECT COUNT(*) as total FROM reviews WHERE hotel = {$htl->id} AND reply = 0";
                            $localCountRes   = DB::getInstance()->query($localCountQuery);
                            $localCount      = $localCountRes->results()[0]->total ?? 0;
                            
                            // Google reviews
                            $googleCount = 0;
                            $apiKey = "AIzaSyDMxBuFa4wqtpMN-iMu8oS8V3yhlQNbGZE"; 
                            $place  = $htl->company_name;
                            
                            $encodedPlace = urlencode($place);
                            $placeIdUrl   = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=$encodedPlace&inputtype=textquery&fields=place_id&key=$apiKey";
                            
                            $placeIdResponse = @file_get_contents($placeIdUrl);
                            $placeIdData     = json_decode($placeIdResponse, true);
                            
                            if (!empty($placeIdData['candidates'][0]['place_id'])) {
                                $placeId = $placeIdData['candidates'][0]['place_id'];
                            
                                $detailsUrl = "https://maps.googleapis.com/maps/api/place/details/json?place_id=$placeId&fields=reviews&key=$apiKey";
                                $detailsResponse = @file_get_contents($detailsUrl);
                                $detailsData     = json_decode($detailsResponse, true);
                            
                                if (!empty($detailsData['result']['reviews'])) {
                                    $googleCount = count($detailsData['result']['reviews']);
                                }
                            }
                            
                            // Total reviews = local + Google
                            $totalReviews = $localCount + $googleCount;
                            ?>
                            
                            <article class="box desktop-filter-container">
                                <figure>
                                    <a href="hotel-detailed?hotel=<?php echo $htl->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>" title="">
                                        <img src="<?php echo $path ?>" alt="hotel-img" style='height:160px ' />
                                    </a>
                                </figure>
                                <div class="details">
                                    <h4 class="box-title" style="text-transform:capitalize!important;"><?php echo substr($htl->company_name, 0,30 );?></h4>
                                    <p style="font-size: 1.0833em; line-height: 1.6666; margin-bottom: 5px">
                                        <small>(<?php echo $totalReviews; ?> reviews)</small>
                                    </p>
                                    <a style="margin-top: 0px" href="hotel-detailed?hotel=<?php echo $htl->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>" title="" class="button">View</a>
                                </div>
                            </article>

                                
                            </li>
                            <?php } }?>

                        </ul>
                    </div>
                    
                    <div class="image-carousel style3 flex-slider mobile-filter-container" data-item-width="270" data-item-margin="30">
                        <ul class="slides image-box style9">
                            <?php 
                                $today = date('m/d/Y');$date = new DateTime($today); $tomrw = $date->add(new DateInterval('P1D'))->format('m/d/Y');
                                $buffer = DB::getInstance()->query("SELECT * FROM clients WHERE groups = 4 AND verified = 1 ORDER BY id DESC LIMIT 12");
                                    if($buffer->count()){
                                        foreach ($buffer->results() as $key => $htl) {
                                            $image = DB::getInstance()->query("SELECT * FROM media WHERE hid = $htl->id LIMIT 1");
                                            if($image->count()){
                                                foreach ($image->results() as $key => $img) {$path = 'hotels/'.$img->path;}    
                                            }else{$path = 'http://placehold.it/170x160';}
                            ?>  
                            <li style="width:200%">
                                <article class="box">
                                    <figure>
                                        <a href="hotel-detailed?hotel=<?php echo $htl->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>" title="" class="">
                                            <img src="<?php echo $path ?>" alt="hotel-img" style='height:160px ' />
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title" style="text-transform:capitalize!important;"><?php  echo substr($htl->company_name, 0,30 );?></small></h4>
                                        <p style="ont-size: 1.0833em;line-height: 1.6666; margin-bottom: 5px"><small>(<?php echo num_reviews($htl->id); ?> reviews)</p>
                                        <a style="margin-top: 0px" href="hotel-detailed?hotel=<?php echo $htl->id.'&from='.$today.'&to='.$tomrw.'&adult=1&infant=1&room=1';?>" title="" class="button">View</a>
                                    </div>
                                </article>z
                                
                            </li>
                            <?php } }?>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="container section">
                <h2>Explore Our Excursions and Vacation Packages</h2>
                <div class="row image-box style10">
                   <?php 
                    $excur = DB::getInstance()->query("SELECT * FROM excursion WHERE status = 1 ORDER BY id DESC LIMIT 4");
                    if ($excur->count()) {
                        foreach ($excur->results() as $key => $excu) {
                            // Decode the JSON-encoded image column
                            $images = json_decode($excu->image, true);
                            // Check if the first image exists
                            $firstImage = !empty($images) ? $images[0] : '';
                    
                            // Ensure the image path is correctly constructed
                            if ($firstImage) {
                    ?>
                                <div class="col-sms-6 col-sm-6 col-md-3">
                                    <article class="box">
                                        <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                            <a href="cruise-detailed?id=<?php echo $excu->id.'&date='.$today.'&kids=1'; ?>" title="" class="hover-effect">
                                                <img src="<?php echo 'cctech-admin/' . $firstImage; ?>" alt="" style='height:160px' />
                                                <?php
                                                        // Assuming $excu is an object and has a 'title' property
                                                        if (isset($excu->title)) {
                                                            $titleToSearch = $excu->title;
                                                            $deal = DB::getInstance()->query("SELECT * FROM deals WHERE title = ?", [$titleToSearch]);
                                                    
                                                            if ($deal->count()){
                                                                $row = $deal->first();
                                                                ?>
                                                                <span class="discount"><span class="discount-text" style="color:#fff">
                                                                    <?php echo htmlspecialchars($row->deal_value); ?> % Discount
                                                                </span></span>
                                                                <?php
                                                            } else {
                                                                // If not found, don't display the span
                                                            }
                                                        } else {
                                                            // If $excu->title is not defined, you might choose not to display anything
                                                            // or display a different message/nothing at all.
                                                        }
                                                    ?>
                                            </a>
                                        </figure>
                                        <div class="details">
                                            <a href="cruise-detailed?id=<?php echo $excu->id.'&date='.$today.'&kids=1'; ?>" class="button btn-mini">See Details</a>
                                            <h4 class="box-title" style="text-transform:capitalize!important;"><?php echo substr($excu->title, 0, 20); ?>..</h4>
                                            <br>
                                            <h5 class="box-title" style="text-transform:capitalize!important;"><span><?php echo substr($excu->type, 0, 20); ?> - <?php echo substr($excu->country, 0, 20); ?></span></h5>
                                        </div>
                                    </article>
                                </div>
                    <?php 
                            } 
                        } 
                    } 
                    ?>


                   <?php 
                    $tours = DB::getInstance()->query("SELECT * FROM tours WHERE status = 1 ORDER BY id DESC LIMIT 4");
                    if ($tours->count()) {
                        foreach ($tours->results() as $key => $tor) {
                            
                            // Decode JSON array of images
                            $tourImages = json_decode($tor->image, true);
                    
                            // Ensure images are available and get the first image path
                            $firstImage = !empty($tourImages) ? 'cctech-admin/' . htmlspecialchars($tourImages[0]) : 'path/to/default-image.jpg';
                            ?>
                            
                            <div class="col-sms-6 col-sm-6 col-md-3">
                                <article class="box">
                                    <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                        <a href="package-detailed?id=<?php echo $tor->id; ?>" title="">
                                            <img src="<?php echo $firstImage; ?>" alt="Tour Image" style='height:160px;' />
                                            <?php
                                                // Assuming $excu is an object and has a 'title' property
                                                if (isset($tor->title)) {
                                                    $titleToSearch = $tor->title;
                                                    $deal = DB::getInstance()->query("SELECT * FROM deals WHERE title = ?", [$titleToSearch]);
                                            
                                                    if ($deal->count()){
                                                        $row = $deal->first();
                                                        ?>
                                                        <span class="discount"><span class="discount-text" style="color:#fff">
                                                            <?php echo htmlspecialchars($row->deal_value); ?> % Discount
                                                        </span></span>
                                                        <?php
                                                    } else {
                                                        // If not found, don't display the span
                                                    }
                                                } else {
                                                    // If $excu->title is not defined, you might choose not to display anything
                                                    // or display a different message/nothing at all.
                                                }
                                            ?>
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <a href="package-detailed?id=<?php echo $tor->id; ?>" class="button btn-mini">See Details</a>
                                        <h4 class="box-title" style="text-transform:capitalize!important;">
                                            <?php echo htmlspecialchars(substr($tor->title, 0, 15)); ?>..
                                        </h4>
                                        <br>
                                        <h5 class="box-title" style="text-transform:capitalize!important;">
                                            <span><?php echo htmlspecialchars(substr($tor->type, 0, 20)); ?> - <?php echo htmlspecialchars(substr($tor->country, 0, 20)); ?></span>
                                        </h5>
                                    </div>
                                </article>
                            </div>
                            
                        <?php 
                        }
                    } 
                    ?>


                    
                </div>
            </div>

            <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
                <div class="container description">
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInLeft" data-animation-delay="0">
                            <i class="soap-icon-friends"></i>
                            <div class="description">
                                <h4 class="box-title">B2B/B2C</h4>
                                <p style="color:white">Designed to serve travel agencies and the walk-in user. Be sure to receive deals and special packages whether B2B or B2C user.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.6">
                            <i class="soap-icon-pickanddrop"></i>
                            <div class="description">
                                <h4 class="box-title">One-Stop-Shop</h4>
                                <p style="color:white">No need to be book from several sites for the same journey. Book all services on one platform and be assure of a well-coordinated services delivery.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated" data-animation-type="slideInDown" data-animation-delay="0.9">
                            <i class="soap-icon-insurance"></i>
                            <div class="description">
                                <h4 class="box-title">Cheaper Rates</h4>
                                <p style="color:white">Get cheaper, discounted rates and the best deals on all services. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="icon-box style6 animated"  data-animation-type="slideInRight" data-animation-delay="1.2">
                            <i class="soap-icon-guideline"></i>
                            <div class="description">
                                <h4 class="box-title">Secured Payment</h4>
                                <p style="color:white">Secured Payment with Visa, Master Card, Bank Transfer, Debit Card, Paypal and Mobile Money</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($showAd): ?>
    <div class="modal fade" id="adModal" tabindex="-1" role="dialog" aria-labelledby="adModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="adModalLabel"><?php echo htmlspecialchars($ad['title']); ?></h2>
                </div>
                <div class="modal-body">
                    <?php if (!empty($ad['image_path'])): ?>
                        <div class="text-center">
                            <?php $fullImageUrl = 'https://travelafric.com/cctech-admin/uploads/' . basename($ad['image_path']); ?>
                            <img src="<?php echo htmlspecialchars($fullImageUrl); ?>" alt="<?php echo htmlspecialchars($ad['title']); ?>" class="ad-modal-image img-responsive">
                        </div>
                    <?php endif; ?>
                    <div style="margin-top:10px;font-size: 13px;font-weight: 400; line-height: 1.82857143;"><?php echo nl2br(htmlspecialchars($ad['content'])); ?></div>
                </div>
                <div class="modal-footer">
                    <?php if (!empty($ad['url_link']) && !empty($ad['button_text'])): ?>
                        <a href="#" class="btn btn-primary" >
                            <?php echo htmlspecialchars($ad['button_text']); ?>
                        </a>
                        <!--<a href="<?php echo htmlspecialchars($ad['url_link']); ?>" class="btn btn-primary" target="_blank">-->
                        <!--    <?php echo htmlspecialchars($ad['button_text']); ?>-->
                        <!--</a>-->
                    <?php endif; ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php if ($showAd): ?>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#adModal').modal('show');
            }, 2000);
        });
    </script>
<?php endif; ?>
<style>
    @media (min-width: 660px) { /* Custom breakpoint */
        #adModal .modal-dialog {
            max-width: 720px; /* Adjust custom width as needed */
        }
    }
    @media (min-width: 768px) { /* Tablet breakpoint */
        #adModal .modal-dialog {
            max-width: 700px; /* Adjust tablet width as needed */
        }
    }
    @media (min-width: 992px) { /* Desktop breakpoint */
        #adModal .modal-dialog {
            max-width: 600px; /* Adjust desktop width as needed */
        }
    }
</style>
        </section>
        
        <?php include 'template/footer.php'; ?>
    </div>
    
    <?php include 'template/js-loader.html'; ?>
    <script src="res/js/jquery.autocomplete.min.js"></script>
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq('.revolution-slider').revolution(
            {
                sliderType:"standard",
				sliderLayout:"auto",
				dottedOverlay:"none",
				delay:9000,
				navigation: {
					keyboardNavigation:"off",
					keyboard_direction: "horizontal",
					mouseScrollNavigation:"off",
					mouseScrollReverse:"default",
					onHoverStop:"on",
					touch:{
						touchenabled:"on",
						swipe_threshold: 75,
						swipe_min_touches: 1,
						swipe_direction: "horizontal",
						drag_block_vertical: false
					}
					,
					arrows: {
						style:"default",
						enable:true,
						hide_onmobile:false,
						hide_onleave:false,
						tmp:'',
						left: {
							h_align:"left",
							v_align:"center",
							h_offset:20,
							v_offset:0
						},
						right: {
							h_align:"right",
							v_align:"center",
							h_offset:20,
							v_offset:0
						}
					}
				},
				visibilityLevels:[1240,1024,778,480],
				gridwidth:1170,
				gridheight:510,
				lazyType:"none",
				shadow:0,
				spinner:"spinner4",
				stopLoop:"off",
				stopAfterLoops:-1,
				stopAtSlide:-1,
				shuffle:"off",
				autoHeight:"off",
				hideThumbsOnMobile:"off",
				hideSliderAtLimit:0,
				hideCaptionAtLimit:0,
				hideAllCaptionAtLilmit:0,
				debugMode:false,
				fallbacks: {
					simplifyAll:"off",
					nextSlideOnWindowFocus:"off",
					disableFocusListener:false,
				}
            });

            /*-----------country autocomplete--------*/
            var countries = {AO: "Angola",
    BJ: "Benin",
    BW: "Botswana",
    BF: "Burkina Faso",
    BI: "Burundi",
    CM: "Cameroon",
    CV: "Cape Verde",
    CF: "Central African Republic",
    TD: "Chad",
    DJ: "Djibouti",
    EG: "Egypt",
    GQ: "Equatorial Guinea",
    ER: "Eritrea",
    ET: "Ethiopia",
    GA: "Gabon",
    GH: "Ghana",
    GN: "Guinea",
    GW: "Guinea-Bissau",
    KE: "Kenya",
    LS: "Lesotho",
    LR: "Liberia",
    MG: "Madagascar",
    MW: "Malawi",
    ML: "Mali",
    MR: "Mauritania",
    MU: "Mauritius",
    MA: "Morocco",
    MZ: "Mozambique",
    NA: "Namibia",
    NE: "Niger",
    NG: "Nigeria",
    RW: "Rwanda",
    ST: "São Tomé and Príncipe",
    SN: "Senegal",
    SC: "Seychelles",
    SL: "Sierra Leone",
    SO: "Somalia",
    ZA: "South Africa",
    SD: "Sudan",
    SZ: "Swaziland",
    TZ: "Tanzania",
    TG: "Togo",
    UG: "Uganda",
    ZM: "Zambia",
    ZW: "Zimbabwe",
    ZZ:"Unknown or Invalid Region" };
            var countriesArray = tjq.map(countries, function(value, key) {return {value: value,data: key}; });            
                  
            // initialize autocomplete with custom appendTo
            tjq('#hotelAutoCompleteCountry').autocomplete({
                lookup: countriesArray,appendTo: '#autocomplete-container'
            });

        });
        
        
    </script>
</body>
</html>
<script>
   document.addEventListener("DOMContentLoaded", function() {
        // Create Check Out datepicker instance
        const checkOutPicker = new Pikaday({
            field: document.getElementById('out-date'),
            format: 'MM/DD/YYYY',
            minDate: new Date(Date.now() + 24 * 60 * 60 * 1000) // One day after today
        });

        // Initialize Check In datepicker
        const checkInPicker = new Pikaday({
            field: document.getElementById('in-date'),
            format: 'MM/DD/YYYY',
            minDate: new Date(),
            onSelect: function(date) {
                // Update Check Out datepicker minDate
                checkOutPicker.setMinDate(new Date(date.getTime() + 24 * 60 * 60 * 1000)); // One day after selected Check In
            }
        });
    });



    
    document.addEventListener('DOMContentLoaded', function() {
    // Get the category dropdown by its 'name' attribute
    var categoryDropdown = document.querySelector('select[name="type"]'); // Updated to match your HTML
    if (!categoryDropdown) {
        console.error("Category dropdown not found!");
        return;
    }

    // Add event listener for 'change' event on the category dropdown
    categoryDropdown.addEventListener('change', function() {
        var categoryValue = this.value;

        // Get the pick-up dropdown by its 'name' attribute
        var pickUpDropdown = document.querySelector('select[name="pick_up"]');
        if (!pickUpDropdown) {
            console.error("Pick-Up dropdown not found!");
            return;
        }

        // Get the drop-off dropdown by its 'name' attribute
        var dropOffDropdown = document.querySelector('select[name="drop_off"]');
        if (!dropOffDropdown) {
            console.error("Drop-Off dropdown not found!");
            return;
        }

        console.log("Category selected:", categoryValue);

        // Replace the placeholder option for pick-up when "Rent-A-Car" is selected
        if (categoryValue === 'Rent-A-Car') {
            // Clear existing options in the pick-up dropdown except the first one
            while (pickUpDropdown.options.length > 1) {
                pickUpDropdown.remove(1); // Remove options beyond the first
            }
            // Replace the placeholder option text
            pickUpDropdown.options[0].text = 'Rent-A-Car-Pick-Up';
            pickUpDropdown.options[0].value = 'Rent-A-Car-Pick-Up'; // Update value to match the new text
            pickUpDropdown.selectedIndex = 1; // Select the new placeholder
            console.log("Pick-Up placeholder replaced with Rent-A-Car-Pick-Up.");

            // Clear existing options in the drop-off dropdown except the first one
            while (dropOffDropdown.options.length > 1) {
                dropOffDropdown.remove(1); // Remove options beyond the first
            }
            // Replace the placeholder option text
            dropOffDropdown.options[0].text = 'Rent-A-Car-Drop-Off';
            dropOffDropdown.options[0].value = 'Rent-A-Car-Drop-Off'; // Update value to match the new text
            dropOffDropdown.selectedIndex = 1; // Select the new placeholder
            console.log("Drop-Off placeholder replaced with Rent-A-Car-Drop-Off.");
        } else {
            // Reset the pick-up selection to the default option
            pickUpDropdown.selectedIndex = 0; // Reset to "Select Pick-Up"
            pickUpDropdown.options[0].text = 'Select Pick-Up'; // Restore the original placeholder text
            pickUpDropdown.options[0].value = '0'; // Restore the original placeholder value
            console.log("Pick-Up reset to default.");

            // Reset the drop-off selection to the default option
            dropOffDropdown.selectedIndex = 0; // Reset to "Select Drop-Off"
            dropOffDropdown.options[0].text = 'Select Drop-Off'; // Restore the original placeholder text
            dropOffDropdown.options[0].value = '0'; // Restore the original placeholder value
            console.log("Drop-Off reset to default.");
        }
    });
});

</script>
