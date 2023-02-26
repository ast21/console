## My console commands

### install for linux

1. Clone to folder
```shell
git clone https://github.com/ast21/console-php.git && cd console
```

2. Install packages
```shell
composer install
```

3. Move to executable folder
```shell
sudo ln -s $PWD/console.php /usr/local/bin/con
```

4. Get command list
```shell
con list
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
