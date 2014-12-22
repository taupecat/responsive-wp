#!/usr/bin/env bash

# Update variables here. We'll get to them later in the script.

# Database
MYSQL_PASS=password

# Base WordPress Installation
DEV_URL=responsive-website.dev
DEV_TITLE="Responsive WordPress Theming"
DEV_ADMIN_USER=trotton
DEV_ADMIN_PASSWORD=password
DEV_ADMIN_EMAIL="tracy@taupecat.com"

# _s Starter Theme (must be urlencoded. Try http://meyerweb.com/eric/tools/dencoder/)
THEME_NAME=Responsive%20WP
THEME_SLUG=responsive-wp
THEME_AUTHOR=Tracy%20Rotton
THEME_AUTHOR_URI=http%3A%2F%2Ftaupecat.com
THEME_DESCRIPTION=



# Now go forth and provision...

echo "Installing Node and npm"
apt-get update >/dev/null 2>&1
apt-get install -y software-properties-common python-software-properties >/dev/null 2>&1
apt-get install -y python g++ make >/dev/null 2>&1
add-apt-repository -y ppa:chris-lea/node.js >/dev/null 2>&1
apt-get update >/dev/null 2>&1
apt-get install -y nodejs >/dev/null 2>&1

echo "Installing Ruby"
apt-get install -y ruby-full build-essential >/dev/null 2>&1
apt-get install -y rubygems >/dev/null 2>&1

echo "Installing Bundler"
gem install bundler >/dev/null 2>&1

echo "Installing Sass and other Sass-related things via Bundler"
cd /vagrant # Let's just make doubly sure we're in the correct directory
sudo -u vagrant bundle install >/dev/null 2>&1

echo "Installing gulp globally"
npm install gulp -g >/dev/null 2>&1

echo "Installing Local Packages"
cd /vagrant
npm install >/dev/null 2>&1

echo "Installing apache2..."
apt-get update >/dev/null 2>&1
apt-get install -y apache2 libapache2-mod-php5 php5-gd php5-curl php5-memcache >/dev/null 2>&1
service apache2 stop
chown vagrant:vagrant /var/lock/apache2
rm -rf /var/www
ln -fs /vagrant /var/www
a2enmod rewrite
sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/sites-enabled/000-default
sed -i 's/www-data/vagrant/' /etc/apache2/envvars
service apache2 start

echo "Installing php5..."
apt-get install -y php5 >/dev/null 2>&1

echo "Installing curl..."
apt-get install -y curl >/dev/null 2>&1

echo "Installing Subversion"
apt-get install -y subversion >/dev/null 2>&1

echo "Installing composer"
curl -sS https://getcomposer.org/installer | php >/dev/null 2>&1
mv composer.phar /usr/bin/composer

echo "Installing packages from composer"
cd /var/www
composer install >/dev/null 2>&1

echo "Installing mysql..."
apt-get update
debconf-set-selections <<< "mysql-server mysql-server/root_password password $MYSQL_PASS"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $MYSQL_PASS"
apt-get install -y mysql-server mysql-client >/dev/null 2>&1
mysql -uroot -proot -p$MYSQL_PASS -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '"$MYSQL_PASS"'; FLUSH PRIVILEGES;"
service mysql restart

echo "Getting php5 & mysql to talk to each other..."
apt-get install -y php5-mysql >/dev/null 2>&1

echo "Installing vim..."
apt-get install -y vim >/dev/null 2>&1

echo "Installing pecl_http"
apt-get install -y libpcre3-dev php-http php-pear libcurl3-openssl-dev >/dev/null 2>&1
pear config-set php_ini /etc/php5/apache2/php.ini >/dev/null 2>&1
pecl config-set php_ini /etc/php5/apache2/php.ini >/dev/null 2>&1
printf "\n" | pecl install pecl_http-1.7.6 >/dev/null 2>&1

echo "Restarting Apache"
service apache2 restart

echo "Installing wp-cli..."
curl -L https://raw.github.com/wp-cli/builds/gh-pages/phar/wp-cli.phar > wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/bin/wp

echo "Initializing our WordPress installation..."
cd /var/www

# Create the database based on values that already exist in wp-config.php
sudo -u vagrant -i -- wp --path=/var/www/_wp db create

# Install the bare minimum of our site
sudo -u vagrant -i -- wp --path=/var/www/_wp core install --url="$DEV_URL" --title="$DEV_TITLE" --admin_user="$DEV_ADMIN_USER" --admin_password="$DEV_ADMIN_PASSWORD" --admin_email="$DEV_ADMIN_EMAIL"

# Pull down a copy of _s, install and activate it
cd /var/www
sudo -u vagrant curl -d "underscoresme_generate=1&underscoresme_name=$THEME_NAME&underscoresme_slug=$THEME_SLUG&underscoresme_author=$THEME_AUTHOR&underscoresme_author_uri=$THEME_AUTHOR_URI&underscoresme_description=$THEME_DESCRIPTION&underscoresme_sass=1&underscoresme_generate_submit=Generate" http://underscores.me > /var/www/underscores.zip
sudo -u vagrant wp --path=/var/www/_wp theme install /var/www/underscores.zip
sudo -u vagrant wp --path=/var/www/_wp theme activate $THEME_SLUG
sudo -u vagrant mv /var/www/wp-content/themes/$THEME_SLUG/sass /var/www/src
sudo -u vagrant mv /var/www/wp-content/themes/$THEME_SLUG/js /var/www/src
sudo -u vagrant rm /var/www/underscores.zip
