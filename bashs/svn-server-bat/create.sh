#! /bin/bash
# 1用户名 2密码 3主机名 4svn 端口
svnadmin create /data/svn/$1
cp /data/svn/svn_public/svnserve.conf /data/svn/$1/conf/
cp post-commit /data/svn/$1/hooks/
sed -i "s#通用#$3#g" "/data/svn/$1/conf/svnserve.conf"
sed -i "s#user#$1#g" "/data/svn/$1/hooks/post-commit"
svnserve -d -r /data/svn/$1 --listen-port $4
svn co svn://localhost:$4 /data/www/$1 --username=lrenwang --password=zonghengtianxia
#chown $1:www -R  /data/www/$1
chown www:www -R  /data/www/$1
chmod 775 -R /data/www/$1
cp conf "$1.conf"
sed -i "s#domain#$3#g" "$1.conf"
sed -i "s#user#$1#g" "$1.conf"
mv $1.conf /usr/local/nginx/conf/vhost/
php -f mysql.php $1 $2
nginx -s reload

