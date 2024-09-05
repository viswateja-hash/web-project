<?php
require_once 'Database.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wedding";
$database = new Database($servername, $username, $password, $dbname);
$database->connect(); 
if (isset($_POST['send'])) {
    $names = $_POST['name'];
    $emails = $_POST['email'];
    $numbers = $_POST['number'];
    $dates = $_POST['date'];
    $addresss = $_POST['address'];
    $plans = $_POST['plan'];
    $messages = $_POST['message'];
    $file_path = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (in_array($file_ext, $allowed_types) && $file_size <= 2097152) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_path = $upload_dir . basename($file_name);
            if (!move_uploaded_file($file_tmp, $file_path)) {
                $file_path = null;
                echo "Failed to upload photo.";
            }
        } else {
            echo "Invalid file type or file too large.";
        }
    }
    $user_id = $database->insertContact($names, $emails, $numbers, $dates, $addresss, $plans, $messages, $file_path);
    $menuitems = $_POST['menuitem'];
    $menucat = $_POST['menucategory'];
    $quantities = $_POST['quantity'];
    $numguests = $_POST['numguests'];
    $database->insertMenu($user_id, $menuitems, $menucat, $quantities, $numguests);   
    $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $loc = $_POST['location'];
    $keyact = $_POST['keyactivities'];
    $database->insertEvent($user_id, $eventname, $eventdate, $starttime, $endtime, $loc, $keyact);
    echo "Data submitted successfully!";
}
$database->disconnect(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="t1.css">
</head>
<body>
<script>      
        console.log("Name: <?php echo htmlspecialchars($_COOKIE['uname']); ?>");
        console.log("Mobile: <?php echo htmlspecialchars($_COOKIE['umobile']); ?>");
    </script>
<header class="header">
    <a data-aos="zoom-in-left" data-aos-delay="150" href="#" class="logo"> <i class="fas fa-user"></i> planner </a>
    <nav class="navbar">
       <a data-aos="zoom-in-left" data-aos-delay="300" href="#home">home</a>
       <a data-aos="zoom-in-left" data-aos-delay="450" href="#about">about</a>
       <a data-aos="zoom-in-left" data-aos-delay="600" href="#service">service</a>
       <a data-aos="zoom-in-left"  data-aos-delay="600" href="#plan">pricing</a>
       <a data-aos="zoom-in-left" data-aos-delay="750" href="#team">team</a>
       <a data-aos="zoom-in-left" data-aos-delay="1050" href="#review">review</a>
       <a data-aos="zoom-in-left" data-aos-delay="1200" href="#contact">contact</a>
       <a data-aos="zoom-in-left" data-aos-delay="1400" href="dashboard.php">Admin</a>
    </nav>
    <div class="icons">
        <div data-aos="zoom-in-left" data-aos-delay="1350" class="fas fa-moon" id="theme-btn"></div>
        <div data-aos="zoom-in-left" data-aos-delay="1500" class="fas fa-bars" id="menu"></div>
    </div>
</header>
<section class="home" id="home">
    <div class="content" data-aos="fade-down">
        <h3>your dream wedding <br> as simple as </h3>
        <a href="#" class="btn"> see more info</a>
    </div>
 </section>
<section class="about" id="about">
    <h1 class="heading"> <span>about</span> us</h1>
    
    <div class="row">
        
        <div class="content" data-aos="fade-up" data-aos-delay="25">
            
        <h3>team of passionate people</h3>
            <h1>Wedding and marriage are closely related but distinct concepts. A wedding is a ceremony that marks the beginning of marriage, typically involving vows or promises exchanged between partners in front of witnesses. 
                It's a public declaration of commitment and often includes cultural or religious rituals.</h1>
            <br><br>
            <h1>Marriage, on the other hand, is a legal and/or spiritual union between two people that establishes their rights and obligations to each other, usually recognized by the state or religious institution. 
                It encompasses the lifelong partnership, responsibilities, and legal benefits that come with being spouses.</h1>
            <a href="#" class="btn">read more</a>
        </div>
        <div class="image" data-aos="fade-down" data-aos-delay="300">
            <img src="mar.png" alt="">
        </div>
    </div>
 </section>

 
 <section class="service" id="service" data-aos="fade-up">
 <h1 class="heading">Our Services</h1>
    <div class="services-row">
        <div class="services-col">
            <i class="fas fa-book-open"></i>
            <h2>invitation</h2>
            
        </div>
        <div class="services-col">
            <i class="fas fa-camera"></i>
            <h2>Photography & Video</h2>
            
        </div>
        <div class="services-col">
            <i class="fas fa-brush"></i>
            <h2>Beauty & Makeup</h2>
            
        </div>
        <div class="services-col">
            <i class="fab fa-pagelines"></i>
            <h2>Wedding flowers</h2>
            
        </div>
        <div class="services-col">
            <i class="fas fa-birthday-cake"></i>
            <h2>wedding cake</h2>
            
        </div>
        <div class="services-col">
            <i class="fas fa-music"></i>
            <h2>music band</h2>
           
        </div>
        <div class="services-col">
            <i class="fas fa-utensils"></i>
            <h2>Catering</h2>
           
        </div>
        <div class="services-col">
            <i class="fas fa-ring"></i>
            <h2>Jewellery</h2>
            
        </div>
    </div>
</section>
<section class="plan" id="plan">
    <h1 class="heading">membership plan</h1> 
    <div class="box-container">
        <div class="box" >
            <h3 class="title">basic</h3>
            <h3 class="price">49999<span>rupees</span></h3>
            <ul>
                <li><i class="fas fa-check"></i>photography</li>
                <li><i class="fas fa-check"></i>Invitation</li>
                <li><i class="fas fa-check"></i>wedding flowers</li>
                <li><i class="fas fa-times"></i>Music Band</li>
                <li><i class="fas fa-times"></i>Beauty & Makeup</li>
            </ul>
            <a href="#"><button class="btn">buy now</button></a>
        </div>
        <div class="box" >
            <h3 class="title">standard</h3>
            <h3 class="price">59999<span>rupees</span></h3>
            
            <ul>
                <li><i class="fas fa-check"></i>photography</li>
                <li><i class="fas fa-check"></i>Invitation</li>
                <li><i class="fas fa-check"></i>wedding flowers</li>
                <li><i class="fas fa-check"></i>Music Band</li>
                <li><i class="fas fa-times"></i>Beauty & Makeup</li>
            </ul>
            <a href="#"><button class="btn">buy now</button></a>
        </div>
    
        <div class="box" >
            <h3 class="title">premium</h3>
            <h3 class="price">69999<span>rupees</span></h3>
            
            <ul>
                <li><i class="fas fa-check"></i>photography</li>
                <li><i class="fas fa-check"></i>Invitation</li>
                <li><i class="fas fa-check"></i>wedding flowers</li>
                <li><i class="fas fa-check"></i>Music Band</li>
                <li><i class="fas fa-check"></i>Beauty & Makeup</li>
            </ul>
            <a href="#"><button class="btn">buy now</button></a>
        </div>
    
    </div>
    
    </section>



    
<section class="review" id="review">

    <h1 class="heading"> client's review </h1>

    <div class="swiper review-slider"  >

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <img src="raghu.jpg" alt="">
                <h3>Raghu Manikanta</h3>
                <p>I cannot express enough gratitude for the exceptional service provided by Aravind. From our very first meeting, he displayed a level of professionalism and creativity that immediately put us at ease. Mark took the time to understand our vision and went above and beyond to make our dream wedding a reality.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <img src="phani.jpg" alt="">
                <h3>Phani</h3>
                <p>From the moment we met Aravind, we knew we were in good hands. His expertise and genuine enthusiasm for wedding planning shone through in every interaction. He listened carefully to our ideas and offered insightful suggestions that enhanced our vision.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <img src="raj.jpg" alt="">
                <h3>jahnavee</h3>
                <p>Aravind is an extraordinary wedding planner who turned our vision into a beautiful reality. From start to finish, his dedication, expertise, and passion were evident in every detail.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide slide">
                <img src="vass.jpg" alt="">
                <h3>Vasavi</h3>
                <p>Choosing Aravind as our wedding planner was the best decision we made during our wedding journey. His professionalism, creativity, and commitment to excellence made our wedding day perfect.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>
<section class="team" id="team">

    <h1 class="heading">our team</h1>
 
    <div class="box-container" data-aos="">
 
       <div class="box">
          <img src="aravind.jpg" alt="">
          <h3>Aravind Naidu</h3>
          <p>wedding planner</p>
          <div class="share">
             <a href="#" class="fab fa-facebook-f"></a>
             <a href="#" class="fab fa-twitter"></a>
             <a href="#" class="fab fa-linkedin"></a>
             <a href="#" class="fab fa-instagram"></a>
          </div>
       </div>
 
       <div class="box">
          <img src="viswa.jpg" alt="">
          <h3>Viswa Teja</h3>
          <p>Photography & Video</p>
          <div class="share">
             <a href="#" class="fab fa-facebook-f"></a>
             <a href="#" class="fab fa-twitter"></a>
             <a href="#" class="fab fa-linkedin"></a>
             <a href="#" class="fab fa-instagram"></a>
          </div>
       </div>
 
       <div class="box">
          <img src="pooja.jpg" alt="">
          <h3>Pooja Lakshmi</h3>
          <p>Beauty & Makeup</p>
          <div class="share">
             <a href="#" class="fab fa-facebook-f"></a>
             <a href="#" class="fab fa-twitter"></a>
             <a href="#" class="fab fa-linkedin"></a>
             <a href="#" class="fab fa-instagram"></a>
          </div>
       </div>
 
       <div class="box">
          <img src="viraja.jpg" alt="">
          <h3>Viraja</h3>
          <p>Invitation</p>
          <div class="share">
             <a href="#" class="fab fa-facebook-f"></a>
             <a href="#" class="fab fa-twitter"></a>
             <a href="#" class="fab fa-linkedin"></a>
             <a href="#" class="fab fa-instagram"></a>
          </div>
       </div>
 
    </div>
 
 </section>
<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="inputBox">
            <input type="text" placeholder="name" name="name" required>
            <input type="email" placeholder="email" name="email" required>
        </div>
        <div class="inputBox">
            <input type="number" placeholder="number" name="number" required>
            <input type="date" name="date" required>
        </div>
        <div class="inputBox">
            <input type="text" placeholder="your address" name="address" required>
            <select name="plan" required>
                <option value="basic">basic plan</option>
                <option value="premium">premium plan</option>
                <option value="ultimate">ultimate plan</option>
            </select>
        </div>

        <div class="inputBox">
            <input type="file"  name="photo" placeholder="upload couple image" accept="image/*" required>
        </div>

        <textarea name="message" placeholder="your message" cols="30" rows="10" required></textarea>
      
        <h1 class="heading">MENU List</h1>
        <div class="inputBox">
            <input type="text" placeholder="Menu Item" name="menuitem" required>
            <select name="menucategory" required>
                <option value="Main Courses">Main Courses</option>
                <option value="Side Dishes">Side Dishes</option>
                <option value="Desserts">Desserts</option>
            </select>
            <input type="number" placeholder="Quantity" name="quantity" required>
            <input type="number" placeholder="Number of Guests" name="numguests" required>
        </div>
        <h1 class="heading">EVENT FORM</h1>
        <div class="inputBox">
            <input type="text" placeholder="Event Name" name="eventname" required>
            <input type="date" name="eventdate" required>
            <input type="time" placeholder="Start Time" name="starttime" required>
            <input type="time" placeholder="End Time" name="endtime" required>
            <input type="text" placeholder="Location" name="location" required>
         </div>
            <textarea name="keyactivities" placeholder="Key Activities" cols="30" rows="5" required></textarea>
        
        <input type="submit" name="send" class="btn">
   </form>

</section>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="t2.js"></script>

</body>
</html>