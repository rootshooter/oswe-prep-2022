<?php
require_once("validator_error_messages.php");

class Message
{
    public function __construct($to, $from, $title, $body)
    {
        $this->to = $to;
        $this->from = $from;
        $this->title = $title;
        $this->body = $body;

        $this->filePath = tempnam("/var/www/html/messages", "");
        $this->fileName = end(explode("/", $this->filePath));
    }

    public function __destruct()
    {
        file_put_contents($this->filePath, sprintf(
            "<h3>To: %s, From: %s</h3><h1>%s</h1><p>%s</p>",
            $this->to,
            $this->from,
            $this->title,
            $this->body
        ));
    }
}

function getTagValue($xmldoc, $tagName)
{
    return $xmldoc->getElementsByTagName($tagName)[0]->nodeValue;
}

if (isset($_POST["message"])) {
    $msgXml = new DOMDocument();
    $msgXml->loadXML($_POST["message"], LIBXML_NOENT | LIBXML_DTDLOAD);

    if ($msgXml->schemaValidate("valid_message.xsd")) {
        $msgObj = new Message(
            getTagValue($msgXml, "to"),
            getTagValue($msgXml, "from"),
            getTagValue($msgXml, "title"),
            getTagValue($msgXml, "body")
        );

        echo sprintf(
            "Message <a href=\"%s\">saved!</a>",
            "http://" . $_SERVER["HTTP_HOST"] . "/messages/" . $msgObj->fileName
        );
    } else {
        echo "Invalid XML.";
        libxml_display_errors();
    }
} else if (isset($_FILES["image"])) {
    $imageExt = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $imageMime = mime_content_type($_FILES["image"]["tmp_name"]);

    if ($imageExt !== "jpg" && $imageExt != "jpeg" && $imageExt !== "gif" && $imageExt !== "png")
        die("Invalid extension.");

    if ($imageMime !== "image/jpeg" && $imageMime !== "image/gif" && $imageMime !== "image/png")
        die("invalid mime type.");

    if (getimagesize($_FILES["image"]["tmp_name"]) === false)
        die("Invalid size.");

    $uploadPath = "/var/www/html/images/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);
    echo sprintf(
        "Uploaded <a href=\"%s\">image</a>!",
        "http://" . $_SERVER["HTTP_HOST"] . "/" . $uploadPath
    );
} else {
    echo sprintf(
        "<h4>index.php:</h4>%s<hr><h4>valid_message.xsd:</h4>%s",
        highlight_file(__FILE__, true),
        highlight_file("valid_message.xsd", true)
    );
}
