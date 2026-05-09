# LEMP Stack Automation

Automated LEMP (Linux, Nginx, MySQL, PHP) stack provisioning script for local development using VirtualBox. Configures a full web server environment with self-signed SSL in a single command.

---

## Project Structure

```
lemp-automation/
├── setup.sh       # Main automation script
└── index.php      # LEMP stack confirmation page
```

---

## What `setup.sh` Does

The script automatically handles the following steps in order:

1. **System Update** — Runs `apt update && apt upgrade`
2. **Nginx Installation** — Installs and enables the Nginx web server
3. **MySQL Installation** — Installs MySQL Server
4. **PHP-FPM Installation** — Adds the `ondrej/php` PPA and installs PHP 8.5 with FPM & MySQL extension
5. **Firewall Configuration (UFW)** — Allows SSH and `Nginx Full` (ports 80 & 443)
6. **SSL Certificate Generation** — Creates a self-signed certificate using OpenSSL
7. **Nginx Server Block** — Configures a virtual host for `myporto.local` with HTTP + HTTPS support
8. **Test File Deployment** — Places `info.php` at the web root for verification
9. **Service Restart** — Validates Nginx config and restarts all services

---

## Requirements

- OS: Ubuntu 26.04 (inside VirtualBox VM)
- User with `sudo` privileges
- Internet access from inside the VM
- VirtualBox with **Bridged Adapter** configured

---

## How to Use

### Step 1 — Clone the Repository

```bash
git clone https://github.com/eggimugi/lemp.git
cd lemp
```

### Step 2 — Make the Script Executable

```bash
chmod +x setup.sh
```

### Step 3 — Run the Setup Script

```bash
./setup.sh
```

> The script will prompt for your `sudo` password. Let it run to completion, it may take a few minutes depending on your connection speed.

### Step 4 — Deploy the Test Page

Copy `index.php` to the web root:

```bash
sudo cp index.php /var/www/html/index.php
```

### Step 5 — Edit Your Hosts File (on the Host Machine)

To resolve `myporto.local` from your browser on the **host machine**, add an entry to your hosts file.

**On Linux/macOS (host):**
```bash
sudo nano /etc/hosts
```

**On Windows (host) — run Notepad as Administrator:**
```
C:\Windows\System32\drivers\etc\hosts
```

Add the following line (replace `<VM_IP>` with your VirtualBox VM's IP address):
```
<VM_IP>   myporto.local
```

> To find your VM's IP, run `ip a` inside the VM and look for the `enp0s3` or `eth0` interface.

### Step 6 — Access the Site

Open your browser and visit:

```
https://myporto.local
```

> Since this uses a self-signed certificate, your browser will show a security warning. This is expected — click **Advanced → Proceed** to continue.

To verify PHP is working correctly, also visit:
```
https://myporto.local/info.php
```

---

## About the SSL Certificate

This project uses **OpenSSL** to generate a **self-signed certificate** rather than a certificate authority like Let's Encrypt. Here's why:

### Why Not Let's Encrypt?

Let's Encrypt is a free, trusted Certificate Authority — but it has a hard requirement: **the domain must be publicly accessible from the internet** so that Let's Encrypt's servers can verify domain ownership via HTTP challenge (port 80 must be reachable from outside).

Since this project runs **entirely inside a VirtualBox VM on a local network**, the domain `myporto.local` is:
- Not a real public domain
- Not reachable from the internet
- Only resolvable via a manual `/etc/hosts` entry

Let's Encrypt's validation would simply fail under these conditions.

## Configuration Reference

| Variable | Value |
|---|---|
| PHP Version | `8.5` |
| Domain | `myporto.local` |
| Web Root | `/var/www/html` |
| Nginx Config | `/etc/nginx/sites-available/myporto` |
| SSL Certificate | `/etc/ssl/certs/nginx-selfsigned.crt` |
| SSL Key | `/etc/ssl/private/nginx-selfsigned.key` |
| PHP-FPM Socket | `/var/run/php/php8.5-fpm.sock` |

---