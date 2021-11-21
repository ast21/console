## My console commands

### install for linux

Install packages
```shell
composer install
```

Move to executable folder
```shell
sudo ln -s $PWD/console.php /usr/local/bin/con
```

## Other instructions

### Install mysqldump
```shell
# go to https://dev.mysql.com/downloads/repo/apt/
# find the link for the latest deb package (use that in the following steps)
# on your server:
wget -c https://dev.mysql.com/get/mysql-apt-config_0.8.16-1_all.deb
sudo dpkg -i mysql-apt-config*
sudo apt-get update
sudo apt-get install mysql-client
mysqldump --version # (should say Ver 8.x.x)
```