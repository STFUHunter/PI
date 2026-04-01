<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <!-- Pour centrer le formulaire -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .center-wrapper {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body data-bs-theme="dark">
    <div class="center-wrapper">
        <form method="post" action="loginHandler" style="width: 400px;">
            <fieldset>
                <legend>Log-in</legend>
                <div class="mb-3 row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email <span class="text-danger"> 
                       
                     </span></label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Adresse email">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPassword3" name="pwd" placeholder="Mot de passe">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>