<html>
<head>
    <style>
        main{
            display: grid;
            height: 100vh;
        }
        header{
            height: 10vh;
        }
        .col{
            grid-column: 5fr 1;
        }
    </style>
</head>
<body>
    <main>
        <header>
            <section>Logo</section>
            <nav>nav</nav>
        </header>
        <div class="container">
            <div class="col col5">mainbody</div>
            <div class="col col1">sidebar</div>
        </div>
        <footer>
            footer
        </footer>
    </main>
</body>
</html>
