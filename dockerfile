# استخدم صورة رسمية لـ PHP مع Composer و Nginx
FROM php:8.2-fpm

# تثبيت الإضافات المطلوبة لـ Laravel
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql bcmath

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ضبط مجلد العمل داخل الحاوية
WORKDIR /var/www/html

# نسخ الملفات إلى الحاوية
COPY . .

# تثبيت الـ dependencies
RUN composer install --no-dev --optimize-autoloader

# إعداد الصلاحيات
RUN chmod -R 777 storage bootstrap/cache

# تشغيل Laravel migration عند بدء التشغيل
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000