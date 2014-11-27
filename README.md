#IP Location

---

**This project is for getting the location of users.**

##Usage

    <?php
    
    require_once 'Geo.class.php';
    
    $geo=new Geo();
    $geo->query($_SERVER['REMOTE_ADDR']);
    echo $geo->city;