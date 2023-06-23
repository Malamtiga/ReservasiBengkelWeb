<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet" crosorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
            ></script>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Login Bengkel</title>
    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
	body {
			background-image: url('/assets/img/motor.png');
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
      

		}
        .card {
            background-image: url('/assets/img/mekanik.jpg');
            background-size: cover;
            background-position: center;
            margin-top: 150px;
}


	</style>
    
</head>

<body class="blur">
    
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
           
                <div class="card">
               
                    <div class="card-header">
                        <h4 class="text-light">Login Pengguna Dan Bengkel</h4>
                    </div>
                    <div class="card-body">
                 
                        <form class="user" id="form-login" method="post" action="<?=base_url('/login')?>">
                                        <div class="form-group">                                           
                                                <div class="mb-3">
                                                <label for="username" class="form-label text-light">Username</label>
                                                <input type="username" name="username" class="form-control" id="username" placeholder="Isikan Username">
                                                </div>

                                            <div class="mb-3">
                                            <label for="password" class="form-label text-light">Password</label>
                                                <input type="password" name="password" class="form-control " id="password" placeholder="Isikan Password anda disini">
                                            </div>
                                            
    <div class="mb-3">
    <label class="form-label text-light">Login Sebagai :</label>
    <div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="admin" value="admin">
            <label class="form-check-label text-light" for="admin">Admin</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="bengkel" value="bengkel">
            <label class="form-check-label text-light" for="bengkel">Bengkel</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="level" id="pengguna" value="pengguna">
            <label class="form-check-label text-light" for="pengguna">Pengguna</label>
        </div>
    </div>
</div>

                                            <div class="mb-3">
                                            <button type="submit" class="btn-control btn-light  btn-block mb-3">Login</button>
                                            </div>
                                            
                                            <div class=" text-center py-3">
                                        <div class="small text-dark"><a href="register" class="text-light">Belum Punya Akun? Klik Disini!</a></div>
                                        </div>

                                        
                                    </div>
                                    </div>
                                    </form>
                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
document.getElementById("register-btn").addEventListener("click", function() {
    window.location.href = "register";
});
</script>

<script>
        $(document).ready(function(){
        
        
        $('form#form-login').submitAjax({
        pre:()=>{
            $('form#form-login button [type=submit]').hide();
            
        },
        pasca:()=>{
            $('form#form-login button [type=submit]').show();

        },

        success: (response, status) => {
  var js =  $.parseJSON(response);
  alert(js.message);
  var level = $('form#form-login input[name="level"]:checked').val();
  if (level == 'pengguna') {
    window.location = "<?=url_to('pengguna/dashboard')?>";
  } else if (level == 'bengkel') {
    window.location = "<?=url_to('bengkel/dashboard')?>";
  } else if (level == 'admin') {
    window.location = "<?=url_to('admin/dashboard')?>";
  } else {
    window.location = "<?=url_to('login')?>";
  }
},

        error:(xhr, status)=>{
            var json = $.parseJSON(xhr.responseText);
            alert(json.message);
        }

        });
    });

    </script>

</html>
