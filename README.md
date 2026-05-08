# Automated LEMP Stack Deployment Tool

A powerful Bash-based automation script designed to provision a fully functional **LEMP Stack** (Linux, Nginx, MySQL, PHP) on Ubuntu. This tool streamlines server setup, handles security hardening, and eliminates common configuration pitfalls.

[![asciicast](https://asciinema.org/a/RqiZy1Mx7dEZzBHD)](https://asciinema.org/a/RqiZy1Mx7dEZzBHD)

## Overview

Setting up a web server manually is error-prone and time-consuming. This script automates the entire process, ensuring a consistent environment every time. It was specifically built to handle dynamic PHP-FPM socket mapping and secure firewall configurations.

### Key Features
- **Automated Installation:** Installs Nginx, MySQL, and PHP-FPM with a single command.
- **Dynamic PHP-FPM Configuration:** Automatically syncs Nginx with the installed PHP version (e.g., PHP 8.5) to prevent `502 Bad Gateway` errors.
- **Instant HTTPS:** Generates self-signed SSL certificates for immediate secure local development.
- **UFW Security Hardening:** Configures firewall rules for SSH and Web traffic (HTTP/HTTPS) safely.
- **Zero-Configuration Test:** Automatically creates a `phpinfo()` landing page to verify the stack immediately.

## Tech Stack
- **OS:** Ubuntu 26.04
- **Web Server:** Nginx
- **Database:** MySQL 8.4
- **Interpreter:** PHP 8.5 (FPM)
- **Scripting:** Bash (Shell Script)

## How to Use

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/yourusername/lemp-autoinstall.git](https://github.com/yourusername/lemp-autoinstall.git)
   cd lemp-setup