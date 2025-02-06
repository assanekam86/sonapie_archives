<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Scanner</title>

	 <script type="text/javascript" src="scanner/scanner.js"></script>
  <!DOCTYPE html>
<html lang="en">
<head>
    <title>Scanner.js demo: Scan JPEG to Form</title>
    <meta charset='utf-8'>
    <script
              src="https://code.jquery.com/jquery-1.12.4.min.js"
              integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
              crossorigin="anonymous"></script>
    <script src="https://cdn.asprise.com/scannerjs/scanner.js" type="text/javascript"></script>

    <script>
        var d = new FormData();
            d.append('t','ok')

        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Initiates a scan */
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                    {
                        "output_settings": [
                            {
                                "type": "return-base64",
                                "format": "jpg"
                            }
                        ]
                    }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('User cancelled');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
           //var formdata =new FormData();
           //formdata.append('type','ok')
          // console.log(formdata)
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
               d.append('photo',scannedImage.src)
                $.ajax({
                url:'traitement.php',
                type:'POST',
                data:d,
                contentType:false,
                processData:false,
                dataType:'json',

            })
                processScannedImage(scannedImage);
            }
            
           
           
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            document.getElementById('images').appendChild(elementImg);
        }

        <!-- Previous lines are same as demo-01, below is new addition to demo-02 -->

        /** Upload scanned images by submitting the form */
        function submitFormWithScannedImages() {
            if (scanner.submitFormWithImages('form1', imagesScanned, function (xhr) {
                //console.log(xhr)
                if (xhr.readyState == 4) { // 4: request finished and response is ready
                    document.getElementById('server_response').innerHTML = "<h2>Reponse du serveur: </h2>" + xhr.responseText;
                    document.getElementById('images').innerHTML = ''; // clear images
                    imagesScanned = [];
                }


            })) {
                document.getElementById('server_response').innerHTML = "Veillez patienter ...";
 /*for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                d.append('photo',scannedImage.src)
                 $.ajax({
                url:'traitement.php',
                type:'POST',
                data:d,
                contentType:false,
                processData:false,
                dataType:'json',

            })
                processScannedImage(scannedImage);
            }*/
            } else {
                document.getElementById('server_response').innerHTML = "echec. reprendre le scan.";
            }
        }

    </script>

    <style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }

        div#images {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Scanner.js: Scan JPG to Form and then Submit</h2>

    <button type="button" onclick="scanToJpg();">Lancer le scan</button>
 <form id="form1" action="trait.php" method="POST" enctype="multipart/form-data" target="_blank" >
    <div id="images">
        
    </div>

    <!-- Previous lines are same as demo-01, below is new addition to demo-02 | https://asprise.com/scan/applet/upload.php?action=dump-->

   
        <input type="text" id="sample-field" name="sample-field" value="Test scan"/>
        <input type="submit" value="Submit" name="images" onclick="">
    </form>

    <div id="server_response"></div>

    <!-- HELP_LINKS_START help links at the bottom -->
    <style>
        .asprise-footer, .asprise-footer a:visited { font-family: Arial, Helvetica, sans-serif; color: #999; font-size: 13px; }
        .asprise-footer a {  text-decoration: none; color: #999; }
        .asprise-footer a:hover {  padding-bottom: 2px; border-bottom: solid 1px #9cd; color: #06c; }
    </style><!--
    <div class="asprise-footer" style="margin-top: 48px;">
        <a href="http://asprise.com/document-scan-upload-image-browser/direct-to-server-php-asp.net-overview.html" target="_blank" title="Opens in new tab">Scanner.js Homepage</a> |
        <a href="http://asprise.com/scan/scannerjs/docs/html/scannerjs-javascript-guide.html" target="_blank" title="Opens in new tab">Developer's Guide to ScannerJs</a> |
        <a href="https://github.com/Asprise/scannerjs.javascript-scanner-access-in-browsers-chrome-ie.scanner.js" target="_blank" title="Opens in new tab">Sample code on Github</a>
    </div>-->
    <!-- HELP_LINKS_END -->
</body>
</html>