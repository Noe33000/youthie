<?php
if(isset($_POST['email'])) {
    $from      = $_POST['email'];
    $to        = 'info@youthie.io';
    $message   = $_POST['name'] ."\n\n". $_POST['message'];
    $subject   = 'Youthie';
    $headers   = "From: <".$from.">\n";
    $mail_sent = mail($to, $subject, $message, $headers);
    if($mail_sent){
        header("Location: ../accueil/");
    }
}
?>
    <!DOCTYPE html>
    <html>
<head>
    <meta charset="utf-8" />
    <title>Youthie : Faire d'une mission un succès</title>
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/mode.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-87485637-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<div class="wrapper">

    <a href="../menumob/"><div class="nav-toggle"></div></a>

    <?php require '../navbar/navbar.php'; ?>
    <main>
        <section id="contact" class="module content" style="height:700px">
            <div class="container">
                <h2 class="title" style="color:white">Nous contacter</h2>
                <form style="max-width:800px;margin:auto" method="post">
                    <div class="form-group">
                        <input type="text" id="name" name="name" maxlength="255" class="form-control" placeholder="Nom*" required />
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Adresse mail*" required />
                    </div>
                    <div class="form-group">
                        <textarea style="resize:none;" id="message" name="message" class="form-control" placeholder="Votre message*" rows="10" required></textarea>
                        <div style="text-align:right;">*champs obligatoire</div>
                        <br>
                        <div style="text-align:center;"><button type="submit" class="btn btn-default">Envoyer</button></div>
                    </div>
                </form>
            </div>
        </section>
    </main>

</div>
<?php require '../footer/footer.php'; ?>