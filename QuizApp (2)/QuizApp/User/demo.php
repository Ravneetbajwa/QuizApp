<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">

 <head>

   <meta http-equiv="content-type" content="text/html; charset=UTF-8">

   <title>Testing</title>

   <script type="text/javascript">

     var i = 0;

     var typos = ['element1','element2','element3'];

     window.onload = function() {

       document.getElementById('txt1').onclick = showHint;

     };

     function showHint() {

       document.getElementById('data-here').innerHTML = typos[i];

       i++;

     }

   </script>

 </head>

 <body>

   <p>For Next Sentence: <button id="txt1">Click</button></p>

   <div id="data-here"></div>

 </body>

</html>