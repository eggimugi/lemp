#!/bin/bash

# Variable
PHP_V="8.5"
DOMAIN="myporto.local"

echo "--- Starting LEMP Stack Automation ---"

# Update System
sudo apt update && sudo apt upgrade -y

# Install Nginx
sudo apt install nginx -y

# Install MySQL
sudo apt install mysql-server -y

# Install PHP-FPM
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php${PHP_V}-fpm php${PHP_V}-mysql -y

# Configure Firewall (UFW)
sudo ufw allow ssh
sudo ufw allow 'Nginx Full'
sudo ufw --force enable

# Create Self-Signed SSL (To simulate HTTPS locally)
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
-keyout /etc/ssl/private/nginx-selfsigned.key \
-out /etc/ssl/certs/nginx-selfsigned.crt \
-subj "/C=ID/ST=Jatim/L=Malang/O=Portofolio/OU=Dev/CN=$DOMAIN"

# Configure Nginx Server Block
cat <<EOF | sudo tee /etc/nginx/sites-available/myporto
server {
    listen 80;
    listen 443 ssl;
    server_name $DOMAIN;

    ssl_certificate /etc/ssl/certs/nginx-selfsigned.crt;
    ssl_certificate_key /etc/ssl/private/nginx-selfsigned.key;

    root /var/www/html;
    index index.php index.html;

    location / {
        try_files \$uri \$uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php${PHP_V}-fpm.sock;
    }
}
EOF

# Enable Configuration
sudo ln -sf /etc/nginx/sites-available/myporto /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default

# Create Test File
echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/info.php

# Restart Services
sudo nginx -t && sudo systemctl restart nginx

echo "--- Setup Complete! Access via https://myporto.local (after editing hosts) ---"