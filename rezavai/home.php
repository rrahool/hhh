<?php include 'header.php'?>
<?php
//$userClass = new UserClass();
$content = $us->contentSetting();
?>
<link rel="stylesheet" href="hhhstyle.css">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="without-main-border">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="">
                            <main>
      <section>
<!--        <h2>Helping Hearts and Hands</h2>-->
        <article>
            <label>Organization</label>
            <p><?=$content['organization']?></p>
        </article>

	</section>

    </main>

    <aside>
        <div class="biography" style="">
          <h2>Be a member</h2>
            <div class="row">
                <div class="col-4 text-right"> <img src="../uploads/<?=$user['cimage']?>" alt="logo" class="img-fluid" style="height: 75px;"></div>
                <p class="col-8"><?=$user['cname']?>,<?=$user['cdesignation']?><br><?=$user['caddress']?><br>Cell: <?=$user['cphone']?><br>e-mail: <?=$user['cemail']?></p>
            </div>

        </div>
        <article>
            <label>Behind the Machine</label>
            <p><?=$content['behind_machine']?></p>
        </article>
    </aside>

 
    <footer>
      <p>@2020 Helping Hearts and Hands, LLC. USA</p>
    </footer>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5ebd255a8ee2956d73a10e59/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
