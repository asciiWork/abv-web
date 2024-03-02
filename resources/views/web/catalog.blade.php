<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Source code</title>
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.css') }}">
    <script src="{{ asset('web/js/jquery.min.js')}}" type="text/javascript"></script>
</head>

<body>

    <div class="source-link">
        <a class="show-source" data="simple-tag-pdf">Show source code</a>
    </div>
    <!-- <iframe src="{{ asset('a.pdf') }}" width="100%" height="600px"></iframe> -->

    <div class="sample-container-box">
        <div class="sample-container flip-book-container" src="{{ asset('a.pdf') }}">

        </div>
    </div>

    <div id="pdfViewer"></div>

    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.12.313/build/pdf.min.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Your PDF.js code here
            PDFJS.getDocument('/a.pdf').then(function(pdf) {
                // Handle PDF document
            }).catch(function(error) {
                // Handle error
            });
        });
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.12.313/build/pdf.min.js"></script>
    <script>
        var pdfFile = '{{ asset("a.pdf") }}';
        PDFJS.getDocument(pdfFile).then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                var scale = 1.5;
                var viewport = page.getViewport({
                    scale: scale
                });
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                document.getElementById('pdfViewer').appendChild(canvas);
                page.render(renderContext);
            });
        });
    </script> -->


    <!-- 
    <script src="
https://cdn.jsdelivr.net/npm/3d-flip-book@1.9.9/dist/flip-book.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/3d-flip-book@1.9.9/css/black-book-view.min.css
" rel="stylesheet"> -->
    <!-- 
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@version/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@version/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@version/build/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/package-name@version/dist/3dflipbook.min.js"></script> -->


    <!-- <script type="text/javascript">
        window.PDFJS_LOCALE = {
            pdfJsWorker: 'js/pdf.worker.js',
            pdfJsCMapUrl: 'cmaps'
        };
    </script>

    <script type="text/javascript">
        $('.sample-container').FlipBook({
            pdf: 'books/gallery/Travel/Qantas-Holidays-Disney-Magic-2017-2018.pdf',
            template: {
                "html": "templates\/default-book-view.html",
                "styles": ["css\/font-awesome.min.css", "css\/short-black-book-view.css"],
                "script": "js\/default-book-view.js",
                "sounds": {
                    "startFlip": "sounds\/start-flip.mp3",
                    "endFlip": "sounds\/end-flip.mp3"
                }
            }
        });
    </script> -->
</body>

</html>