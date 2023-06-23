<?=$this->extend('tmplt/admin/template')?>

<?=$this->section('content')?>


<html lang="en">

<head>

 
<style>
    .bg-dashboard {
        background-image: url('/assets/img/fotor2.png');
    background-size: cover;
   
    background-repeat: no-repeat;
    background-attachment: fixed;
}
    .parallax {
    background-attachment: fixed;
    background-position:bottom center;
    background-repeat: no-repeat;
    background-size:auto;
    height: 32vh;
}
  .hr-4.left {
  border-color: black;
  
}
.team-member {
  position: relative;
  display: inline-block;
  margin: 10px;
}

.team-member img {
  display: block;
  border: 5px solid #000;
  border-radius: 50%;
  width: 150px;
  height: 150px;
  transition: transform 0.3s;
}

.team-member:hover img {
  transform: scale(1.2);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.team-member .overlay {
  position: absolute;
  top: 0;
  left: 100%;
  width: 200px;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  padding: 20px;
  transition: transform 0.3s;
  transform: translateX(100%);
}

.team-member:hover .overlay {
  transform: translateX(0%);
}

.team-member h4,
.team-member p {
  color: #fff;
  margin: 0;
  text-align: center;
}
/*batas
member dan manager
 */

 .team-manager {
  position: relative;
  display:block;
  margin:auto;
}

.team-manager img {
  display:block;
  border: 5px solid #000;
  border-radius: 50%;
  width: 150px;
  height: 150px;
  transition: transform 0.3s;
  margin: auto;
}

.team-manager:hover img {
  transform: scale(1.2);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.team-manager .overlay {
  position: absolute;
  top: 0;
  left: 100%;
  width: 200px;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  padding: 20px;
  transition: transform 0.3s;
  transform: translateX(100%);
}

.team-manager:hover .overlay {
  transform: translateX(0%);
}

.team-manager h4,
.team-manager p {
  color: #fff;
  margin: 0;
  text-align: center;
}

iframe {
    border: 1px solid #000;
}



</style>
</head>

<body class="">

  

<div class="parallax bg-dashboard">
    <br>
    
    <div class="container ">
        <div class="row ">
            <div class="col-sm-4">
                <div class="iconbox-4">
                    <h4 class="heading text-light">PLATFORM PENYEDIA BENGKEL</h4>
                    <p class="text-light">Untuk menunjang pelayanan yang baik, kami menghadirkan platform yang memudahkan
                        pengguna, untuk melakukan pengorderan serta mendaftarkan bengkelnya.
                        
                    </p>
                </div>
            
            </div>
            <div class="col-sm-4 ">
                <div class="iconbox-4">
  
                    <h4 class="heading text-light">KEUNTUNGAN YANG DIHARAPKAN</h4>
                    <p class="text-light">Kami menyadari bahwa masih banyak kekurangan dalam dunia service otomotif,
                        oleh karena itu kami membuat platform ini supaya pengguna dapat dipermudah dalam melakukan service.
                        Baik dari sisi Pelanggan maupun Bengkel. 
                    </p>
                    
                   
                </div>
                
                
            </div>
        </div>
        
    </div>
    
</div>






<div class="container mt-80 ">
    <div class="row ">
        <div class="col-sm-8">
            <br>
            <h2 class="heading text-dark">Tentang Kami</h2>
            <p class="text-dark">Reservasi Homeservice Berbasis Web merupakan tugas Web Programming kami pada Smester 4.
                Kami adalah layanan reservasi homeservice berbasis web yang berfokus pada memberikan kemudahan dan kenyamanan
                 bagi Anda dalam memesan jasa layanan service di rumah secara online dan memperoleh layanan tersebut di rumah Anda 
                 sendiri. Kami berlokasi di Pontianak dan siap melayani kebutuhan layanan homeservice Anda di wilayah Pontianak
                  dan sekitarnya. Jangan ragu untuk menghubungi kami melalui Whatsapp atau Instagram untuk informasi lebih lanjut.
            </p>

<br>
<br>
            <h2 class="heading text-dark text-center">Our Team</h2>
                <div class="team-manager">
                <img src="<?=base_url('assets/images/bella.jpeg')?>" alt="Team Manager"></img>
                <h4 class="text-dark">Bella Pesta</h4>
                <p class="text-dark">Project Manager</p>
                </div>
        
        
          

<div class="team-member">
  <img src="<?=base_url('assets/images/bonadev.jpg')?>" alt="Team Member">
  <h4 class="text-dark">Bona Ventura</h4>
  <p class="text-dark">Web Developer</p>
  
</div>
<div class="team-member">
  <img src="<?=base_url('assets/images/gafri.jpeg')?>" alt="Team Member">
  <h4 class="text-dark">Gafriansyah</h4>
  <p class="text-dark">Data Analyst</p>
</div>
<div class="team-member">
  <img src="<?=base_url('assets/images/raka.jpeg')?>" alt="Team Member">
  <h4 class="text-dark">Raka Sahal</h4>
  <p class="text-dark">UI/UX Designer</p>
</div>
<div class="team-member">
  <img src="<?=base_url('assets/images/eva.jpeg')?>" alt="Team Member">
  <h4 class="text-dark">Eva Novianti</h4>
  <p class="text-dark">Software Tester</p>
</div>
<br>
<br>

    
<h2 class="heading text-dark text-center">Lokasi Kami</h2>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3143.937167591189!2d109.35726920324596!3d-0.058725613953302405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d59eb7759bd55%3A0x19c3e04c2e455bfc!2sAmik%20BSI%20Pontianak!5e0!3m2!1sen!2sid!4v1682320797216!5m2!1sen!2sid"
     width="700" height="200"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    

             
</div>
        
        
        <div class="col-sm-4">
            <div class="news-slider style-1">
                <div class="slider-items">
                    <div>
               <br>
                        <h4 class="heading text-dark">VISI</h4>
                        <hr class="hr-4 left">
                        <p class="text-dark">Menjadi platform reservasi bengkel terdepan yang mampu memberikan kemudahan dan kepuasan bagi pengguna, 
                            serta memberikan peluang bagi para mitra bengkel untuk berkembang dan meningkatkan kualitas pelayanan.</p>
                    </div>
                    <div>
                    <hr class="hr-4 left">
                        <h4 class="heading text-dark">MISI 1</h4>
                        <hr class="hr-4 left">
                        <p class="text-dark">Memberikan kemudahan bagi pengguna dalam melakukan reservasi bengkel melalui platform online.</p>
                    </div>
                    <div>
                    <hr class="hr-4 left">
                        <h4 class="heading text-dark">MISI 2</h4>
                        <hr class="hr-4 left">
                        <p class="text-dark">Menjaga kualitas pelayanan bengkel mitra melalui evaluasi dan pelatihan berkala.</p>
                    </div>
                    <div>
                    <hr class="hr-4 left">
                        <h4 class="heading text-dark">MISI 3</h4>
                        <hr class="hr-4 left">
                        <p class="text-dark">Meningkatkan pengalaman pengguna dan kepuasan pelanggan dengan memberikan layanan yang cepat, mudah, dan terpercaya.</p>
                    </div>
                    <div>
                    <hr class="hr-4 left ">
                        <h4 class="heading text-dark">MISI 4</h4>
                        <hr class="hr-4 left">
                        <p class="text-dark">Terus berinovasi dan mengembangkan platform untuk memenuhi kebutuhan pengguna dan bengkel mitra.</p>
                    </div>

    
    <div>
    <hr class="hr-4 left ">
    <h4 class="heading text-dark">OUR SOCIAL MEDIA :</h4>

   
    <a style="display:inline-block" class="text-dark" href="https://wa.me/62895374915177">
    <img src="<?=base_url('assets/images/whatsapp.png')?>" style="width:50px; height:50px; display:inline-block; ">
    <p class="text-dark" style="margin-right: 20px;">Whatsapp</p></img>
    </a>
    
    <a style="display:inline-block" class="text-dark" href="https://www.instagram.com/bonaliebert/">
    <img src="<?=base_url('assets/images/instagram.png')?>" style="width:50px; height:50px;  display:inline-block; ">
    <p class="text-dark">Instagram</p></img> 
    </a> 
    </div>
    


                   
                  
                   
              
            </div>
        </div>
    </div>
</div>

    


</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<?=$this->endSection()?>