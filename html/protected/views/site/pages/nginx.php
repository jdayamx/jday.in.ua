<?php
$this->layout = 'list';
?>
<pre>
server {
    listen 80; ## listen for ipv4; this line is default and implied
    #listen [::]:80 default ipv6only=on; ## listen for ipv6

    # Make site accessible from http://localhost/ or server IP-address
    server_name <?=$_SERVER['SERVER_NAME'];?>;
    server_name_in_redirect off;

    charset utf-8;

    access_log /www/<?=$_SERVER['SERVER_NAME'];?>/logs/access.log;
    error_log /www/<?=$_SERVER['SERVER_NAME'];?>/logs/error.log;

    root /www/<?=$_SERVER['SERVER_NAME'];?>/html;
    index index.php index.html index.htm;

    location / {
        # First attempt to serve request as file, then
        # as directory, then trigger 404
        try_files $uri $uri/ =404;
    }

    # pass the PHP scripts to FPM socket

    location ~ \.php$ {
    try_files $uri =404;

    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    # NOTE: You should have "cgi.fix_pathinfo = 0;" in php.ini

    #fastcgi_pass php;
    #fastcgi_pass phpcgi;
    fastcgi_pass 127.0.0.1:9000;

    fastcgi_index index.php;

    fastcgi_param SCRIPT_FILENAME /www/<?=$_SERVER['SERVER_NAME'];?>/html$fastcgi_script_name;
    fastcgi_param DOCUMENT_ROOT /www/<?=$_SERVER['SERVER_NAME'];?>/html;

    # send bad requests to 404
    fastcgi_intercept_errors on;

    include fastcgi_params;
}


}
