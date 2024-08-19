<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/slick-theme.css" />
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->

    <link href="/assets/css/app.css" rel="stylesheet">

    <title>Hello, world!</title>
    <script type="text/javascript">
        var tWidth = '100%';                  // width (in pixels)
        var tHeight = '50px';                  // height (in pixels)
        var tcolour = '#ffffcc';               // background colour:
        var moStop = true;                     // pause on mouseover (true or false)
        var fontfamily = 'arial,sans-serif'; // font for content
        var tSpeed = 3;                        // scroll speed (1 = slow, 5 = fast)

        // enter your ticker content here (use \/ and \' in place of / and ' respectively)
        var content = 'Are you looking for loads of useful information <a href="http:\/\/javascript.about.com\/">About Javascript<\/a>? Well now you\'ve found it.';

        var cps = -tSpeed;
        var aw, mq;
        var fsz = parseInt(tHeight) - 4;
        function startticker() {
            if (document.getElementById) {
                var tick = '<div style="position:relative;width:' + tWidth + ';height:' + tHeight + ';overflow:hidden;background-color:' + tcolour + '"';
                if (moStop) tick += ' onmouseover="cps=0" onmouseout="cps=-tSpeed"'; tick += '><div id="mq" style="position:absolute;right:0px;top:0px;font-family:' + fontfamily + ';font-size:' + fsz + 'px;white-space:nowrap;"><\/div><\/div>'; document.getElementById('ticker').innerHTML = tick; mq = document.getElementById("mq"); mq.style.right = (10 + parseInt(tWidth)) + "px"; mq.innerHTML = '<span id="tx">' + content + '<\/span>'; aw = document.getElementById("tx").offsetWidth; lefttime = setInterval("scrollticker()", 50);
            }
        } function scrollticker() {
            mq.style.right = (parseInt(mq.style.right) > (-10 - aw)) ?
                mq.style.right = parseInt(mq.style.right) + cps + "px" : parseInt(tWidth) + 10 + "px";
        } window.onload = startticker;
    </script>
</head>

<body>
    {{ $slot }}

    <!-- Optional JavaScript; choose one of the two! -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.slider').slick({
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        });
    </script>
    @stack('scripts') <!-- For pushing custom scripts from other views -->
</body>

</html>