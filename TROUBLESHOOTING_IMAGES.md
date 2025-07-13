# 🖼️ Troubleshooting Image Upload - Ubuntu Server

## 🚨 Masalah: Gambar tidak tampil setelah upload

### 📋 Langkah-langkah Troubleshooting:

#### 1. **Jalankan Fix Image Command**

```bash
php artisan system:fix-images
```

#### 2. **Manual Storage Link**

```bash
php artisan storage:link
```

#### 3. **Set File Permissions**

```bash
chmod -R 775 storage
chmod -R 775 public/storage
chown -R www-data:www-data storage
chown -R www-data:www-data public/storage
```

#### 4. **Clear Laravel Cache**

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### 🔧 **Manual Troubleshooting**

#### **Cek Storage Link:**

```bash
ls -la public/
# Harus ada symbolic link 'storage' yang mengarah ke storage/app/public
```

#### **Cek Directory Structure:**

```bash
ls -la storage/app/public/
ls -la storage/app/public/menu-images/
```

#### **Cek File Permissions:**

```bash
ls -la storage/app/public/menu-images/
# Semua file harus memiliki permission 644 atau 664
```

#### **Test Upload Directory:**

```bash
# Test write permission
touch storage/app/public/menu-images/test.txt
rm storage/app/public/menu-images/test.txt
```

### 🌐 **Web Server Configuration**

#### **Apache (.htaccess):**

Pastikan file `.htaccess` di folder `public` memiliki:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### **Nginx Configuration:**

Pastikan konfigurasi nginx memiliki:

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location /storage {
    alias /path/to/your/app/public/storage;
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

### 🐛 **Debugging Commands**

#### **Cek Database Images:**

```bash
php artisan tinker
>>> App\Models\Menu::whereNotNull('gambar')->get(['id', 'nama', 'gambar'])
```

#### **Test Image URL:**

```bash
php artisan tinker
>>> $menu = App\Models\Menu::first();
>>> echo $menu->image_url;
```

#### **Check File Exists:**

```bash
php artisan tinker
>>> $menu = App\Models\Menu::first();
>>> $path = storage_path('app/public/' . $menu->gambar);
>>> echo file_exists($path) ? 'File exists' : 'File missing';
```

### 📝 **Common Issues & Solutions**

#### **Issue 1: Storage link not created**

```bash
php artisan storage:link
```

#### **Issue 2: Permission denied**

```bash
sudo chown -R www-data:www-data storage
sudo chmod -R 775 storage
```

#### **Issue 3: Images not accessible via web**

```bash
# Check if symbolic link exists
ls -la public/storage

# Recreate if broken
rm public/storage
php artisan storage:link
```

#### **Issue 4: Upload directory not writable**

```bash
mkdir -p storage/app/public/menu-images
chmod 775 storage/app/public/menu-images
```

### 🔍 **Environment Variables**

Pastikan file `.env` memiliki:

```env
FILESYSTEM_DISK=local
APP_URL=http://your-domain.com
```

### 🚀 **Quick Fix Script**

Jalankan script ini untuk fix semua masalah gambar:

```bash
#!/bin/bash
echo "🖼️ Fixing image upload system..."

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Set permissions
chmod -R 775 storage
chmod -R 775 public/storage

# Create storage link
php artisan storage:link

# Create upload directory
mkdir -p storage/app/public/menu-images
chmod 775 storage/app/public/menu-images

# Run fix command
php artisan system:fix-images

echo "✅ Image system fixed!"
```

### 📊 **Verification**

Setelah menjalankan semua perintah:

1. **Upload gambar baru** di menu
2. **Cek apakah gambar tampil** di daftar menu
3. **Cek URL gambar** di browser developer tools
4. **Test akses langsung** ke URL gambar

### 🔗 **Image URL Format**

Gambar seharusnya bisa diakses via:

```
http://your-domain.com/storage/menu-images/filename.jpg
```

### 📞 **Jika Masih Bermasalah**

1. **Cek log Laravel**: `tail -f storage/logs/laravel.log`
2. **Cek web server log**: `/var/log/apache2/error.log` atau `/var/log/nginx/error.log`
3. **Test upload dengan file kecil** (1KB)
4. **Cek disk space**: `df -h`
