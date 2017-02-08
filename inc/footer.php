</div> <!-- END OF WRAPPER -->
</main> <!-- END OF MAIN -->
<footer style="position: relative;">

    <div style="position: relative; text-align:center;color:#fff;">
        <div style="text-align:right;margin-right:40px;">
            <ul id="footer_menu">
                <li><a href="../nous-contacter/">Nous contacter</a></li>
                <li><a href="../cgu/">CGU</a></li>
                <li><a href="../qui-sommes-nous/">Nous connaître</a></li>
                <li><a href="../inscriptioncx/">S'inscrire</a></li>
            </ul>
        </div>
        <div id="Newsletter" style="float: bottom left; position: absolute; bottom: 1em; left: 5%; height: 10em; width: 25%; background-color: transparent;">
            <form id="newsletter">
                <h4 style="color: #3cb5e8">ABONNEMENT A LA NEWSLETTER</h3>
                <input id="mail" type="email" class="form-control width" for="newsletter" placeholder="Entrez votre adresse mail" required><br>
                <input type="submit" id="btn-news" type="button" class="form-control" value="S'abonner">
            </form>
        </div>
        <div style="clear: both"></div>
        <h1 style="color:white">Youthie</h1>
        <h3 style="color:white">Faire d'une mission un succès</h3>
        <a href="https://www.facebook.com/helloyouthie/">
            <img title="Facebook" src="../images/facebook.png" />
        </a>
        <a href="https://twitter.com/helloyouthie">
            <img title="Twitter" src="../images/twitter.png" />
        </a>
        <a href="#">
            <img title="Linkdin" src="../images/linkdin.png" />
        </a>
        <a href="#">
            <img title="Viadeo" src="../images/viadeo.png" />
        </a>
        <p style="color:#AAA;">© 2016 Youthie.io, tous droits réservés</p>
    </div>
</footer>
<script>
    $("#newsletter").submit(function(){
        var $e = $('#err');
        if($e.val()){
            event.preventDefault();
        }else{
            event.preventDefault();
            $('#Newsletter').text('Merci, votre abonnement a bien été pris en compte.');
        }
    })
    $("#btn-news").click(function(){
        var $e = $('#err');

        if(!$e.val()){
            $('newsletter').submit();
        }
    })
</script>