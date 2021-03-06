#!/bin/bash

function Create_rt_pass
{
echo "========================================";
echo "Will now create a new root password,";
echo "so later you can use your account with root priviledges.";
sleep 1;
echo "========================================";
sudo passwd root;
echo "========================================";
echo "Password successfully created/changed!";
}

function Change_perm
{
sudo chmod -R 777 /home/$USER/Documents/;
sudo chmod 777 /;
sudo chmod -R 777 /media/;
sudo chown -R $USER /media/;
sudo chgrp -R $USER /media/;
sudo mkdir /gintasview/;
sudo chmod -R 777 /gintasview/;
sudo ln -s /media/ /gopromedia;
sudo ln -s /media/ /gintasview/gopromedia;
}

function Update
{
echo "========================================";
echo "Starting to update...";
echo "========================================";
sleep 1;
sudo apt-get update;
echo "========================================";
echo "Update finished.";
}

function Upgrade
{
echo "========================================";
echo "Starting to upgrade...";
echo "========================================";
sleep 1;
sudo apt-get upgrade;
echo "========================================";
echo "Upgrade finished.";
}

function Install_exfat_fuse
{
echo "========================================";
echo "Installing exfat-fuse...";
echo "========================================";
sleep 1;
sudo apt-get install exfat-fuse;
sudo apt-add-repository ppa:relan/exfat;
sudo add-apt-repository ppa:relan/exfat;
sudo apt-get install exfat-utils;
sudo apt-get install fuse-exfat;
echo "========================================";
echo "Exfat-fuse installed.";
}

function Install_apache
{
echo "========================================";
echo "Installing apache2 server...";
echo "========================================";
sleep 1;
sudo apt-get install apache2;
echo "========================================";
echo "apache2 server installed.";
}

function Install_synaptic
{
echo "========================================";
echo "Installing synapctic package manager...";
echo "========================================";
sleep 1;
sudo apt-get install synaptic
echo "========================================";
echo "Synaptic package manager installed.";
}

function Install_stuff
{
echo "========================================";
echo "Installing extra stuff...";
echo "========================================";
sleep 1;
sudo apt-get install ubuntu-restricted-extras
echo "========================================";
echo "Extra stuff for ubuntu installed.";
}


function Change_www
{
sudo chown -R $USER /etc/apache2/;
sudo chmod 777 /etc/apache2/sites-enabled/000-default.conf;
sudo chmod 777 /etc/apache2/apache2.conf;
yes n | cp -i /etc/apache2/sites-enabled/000-default.conf /etc/apache2/sites-enabled/000-default.conf-original 2>/dev/null;
yes n | cp -i /etc/apache2/apache2.conf /etc/apache2/apache2.conf-original 2>/dev/null;

echo "<VirtualHost *:80>" > /etc/apache2/sites-enabled/000-default.conf;
echo "	# The ServerName directive sets the request scheme, hostname and port that" >> /etc/apache2/sites-enabled/000-default.conf;
echo "	# the server uses to identify itself. This is used when creating" >> /etc/apache2/sites-enabled/000-default.conf;
echo "	# redirection URLs. In the context of virtual hosts, the ServerName" >> /etc/apache2/sites-enabled/000-default.conf;
echo "	# specifies what hostname must appear in the request's Host: header to" >> /etc/apache2/sites-enabled/000-default.conf;
echo "	# match this virtual host. For the default virtual host (this file) this" >> /etc/apache2/sites-enabled/000-default.conf;
echo "	# value is not decisive as it is used as a last resort host regardless." >> /etc/apache2/sites-enabled/000-default.conf;
echo "	# However, you must set it for any further virtual host explicitly." >> /etc/apache2/sites-enabled/000-default.conf;
echo "	#ServerName www.example.com" >> /etc/apache2/sites-enabled/000-default.conf;
echo " " >> /etc/apache2/sites-enabled/000-default.conf;
echo "	ServerAdmin webmaster@localhost" >> /etc/apache2/sites-enabled/000-default.conf;
echo "	DocumentRoot /gintasview/" >> /etc/apache2/sites-enabled/000-default.conf;
echo " # the line above was changed" >> /etc/apache2/sites-enabled/000-default.conf;
echo " " >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn," >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# error, crit, alert, emerg." >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# It is also possible to configure the loglevel for particular" >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# modules, e.g." >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	#LogLevel info ssl:warn" >> /etc/apache2/sites-enabled/000-default.conf;
echo " " >> /etc/apache2/sites-enabled/000-default.conf;
echo '	ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/sites-enabled/000-default.conf;
echo '	CustomLog ${APACHE_LOG_DIR}/access.log combined' >> /etc/apache2/sites-enabled/000-default.conf;
echo " " >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# For most configuration files from conf-available/, which are" >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# enabled or disabled at a global level, it is possible to" >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# include a line for only one particular virtual host. For example the" >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	# following line enables the CGI configuration for this host only" >> /etc/apache2/sites-enabled/000-default.conf;
echo ' 	# after it has been globally disabled with "a2disconf".' >> /etc/apache2/sites-enabled/000-default.conf;
echo " 	#Include conf-available/serve-cgi-bin.conf" >> /etc/apache2/sites-enabled/000-default.conf;
echo " </VirtualHost>" >> /etc/apache2/sites-enabled/000-default.conf;
echo " " >> /etc/apache2/sites-enabled/000-default.conf;
echo "# vim: syntax=apache ts=4 sw=4 sts=4 sr noet" >> /etc/apache2/sites-enabled/000-default.conf;

echo ' # This is the main Apache server configuration file.  It contains the' > /etc/apache2/apache2.conf;
echo ' # configuration directives that give the server its instructions.' >> /etc/apache2/apache2.conf;
echo ' # See http://httpd.apache.org/docs/2.4/ for detailed information about' >> /etc/apache2/apache2.conf;
echo ' # the directives and /usr/share/doc/apache2/README.Debian about Debian specific' >> /etc/apache2/apache2.conf;
echo ' # hints.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # Summary of how the Apache 2 configuration works in Debian:' >> /etc/apache2/apache2.conf;
echo ' # The Apache 2 web server configuration in Debian is quite different to' >> /etc/apache2/apache2.conf;
echo ' # upstream's suggested way to configure the web server. This is because Debian's' >> /etc/apache2/apache2.conf;
echo ' # default Apache2 installation attempts to make adding and removing modules,' >> /etc/apache2/apache2.conf;
echo ' # virtual hosts, and extra configuration directives as flexible as possible, in' >> /etc/apache2/apache2.conf;
echo ' # order to make automating the changes and administering the server as easy as' >> /etc/apache2/apache2.conf;
echo ' # possible.' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # It is split into several files forming the configuration hierarchy outlined' >> /etc/apache2/apache2.conf;
echo ' # below, all located in the /etc/apache2/ directory:' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' #	/etc/apache2/' >> /etc/apache2/apache2.conf;
echo ' #	|-- apache2.conf' >> /etc/apache2/apache2.conf;
echo ' #	|	`--  ports.conf' >> /etc/apache2/apache2.conf;
echo ' #	|-- mods-enabled' >> /etc/apache2/apache2.conf;
echo ' #	|	|-- *.load' >> /etc/apache2/apache2.conf;
echo ' #	|	`-- *.conf' >> /etc/apache2/apache2.conf;
echo ' #	|-- conf-enabled' >> /etc/apache2/apache2.conf;
echo ' #	|	`-- *.conf' >> /etc/apache2/apache2.conf;
echo ' # 	`-- sites-enabled' >> /etc/apache2/apache2.conf;
echo ' #	 	`-- *.conf' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # * apache2.conf is the main configuration file (this file). It puts the pieces' >> /etc/apache2/apache2.conf;
echo ' #   together by including all remaining configuration files when starting up the' >> /etc/apache2/apache2.conf;
echo ' #   web server.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # * ports.conf is always included from the main configuration file. It is' >> /etc/apache2/apache2.conf;
echo ' #   supposed to determine listening ports for incoming connections which can be' >> /etc/apache2/apache2.conf;
echo ' #   customized anytime.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # * Configuration files in the mods-enabled/, conf-enabled/ and sites-enabled/' >> /etc/apache2/apache2.conf;
echo ' #   directories contain particular configuration snippets which manage modules,' >> /etc/apache2/apache2.conf;
echo ' #   global configuration fragments, or virtual host configurations,' >> /etc/apache2/apache2.conf;
echo ' #   respectively.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' #   They are activated by symlinking available configuration files from their' >> /etc/apache2/apache2.conf;
echo ' #   respective *-available/ counterparts. These should be managed by using our' >> /etc/apache2/apache2.conf;
echo ' #   helpers a2enmod/a2dismod, a2ensite/a2dissite and a2enconf/a2disconf. See' >> /etc/apache2/apache2.conf;
echo ' #   their respective man pages for detailed information.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # * The binary is called apache2. Due to the use of environment variables, in' >> /etc/apache2/apache2.conf;
echo ' #   the default configuration, apache2 needs to be started/stopped with' >> /etc/apache2/apache2.conf;
echo ' #   /etc/init.d/apache2 or apache2ctl. Calling /usr/bin/apache2 directly will not' >> /etc/apache2/apache2.conf;
echo ' #   work with the default configuration.' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Global configuration' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # ServerRoot: The top of the directory tree under which the servers' >> /etc/apache2/apache2.conf;
echo ' # configuration, error, and log files are kept.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # NOTE!  If you intend to place this on an NFS (or otherwise network)' >> /etc/apache2/apache2.conf;
echo ' # mounted filesystem then please read the Mutex documentation (available' >> /etc/apache2/apache2.conf;
echo ' # at <URL:http://httpd.apache.org/docs/2.4/mod/core.html#mutex>);' >> /etc/apache2/apache2.conf;
echo ' # you will save yourself a lot of trouble.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # Do NOT add a slash at the end of the directory path.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' #ServerRoot "/etc/apache2"' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # The accept serialization lock file MUST BE STORED ON A LOCAL DISK.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' Mutex file:${APACHE_LOCK_DIR} default' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # PidFile: The file in which the server should record its process' >> /etc/apache2/apache2.conf;
echo ' # identification number when it starts.' >> /etc/apache2/apache2.conf;
echo ' # This needs to be set in /etc/apache2/envvars' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' PidFile ${APACHE_PID_FILE}' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # Timeout: The number of seconds before receives and sends time out.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' Timeout 300' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # KeepAlive: Whether or not to allow persistent connections (more than' >> /etc/apache2/apache2.conf;
echo ' # one request per connection). Set to "Off" to deactivate.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' KeepAlive On' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # MaxKeepAliveRequests: The maximum number of requests to allow' >> /etc/apache2/apache2.conf;
echo ' # during a persistent connection. Set to 0 to allow an unlimited amount.' >> /etc/apache2/apache2.conf;
echo ' # We recommend you leave this number high, for maximum performance.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' MaxKeepAliveRequests 100' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # KeepAliveTimeout: Number of s;econds to wait for the next request from the' >> /etc/apache2/apache2.conf;
echo ' # same client on the same connection.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' KeepAliveTimeout 5' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # These need to be set in /etc/apache2/envvars' >> /etc/apache2/apache2.conf;
echo ' User ${APACHE_RUN_USER}' >> /etc/apache2/apache2.conf;
echo ' Group ${APACHE_RUN_GROUP}' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # HostnameLookups: Log the names of clients or just their IP addresses' >> /etc/apache2/apache2.conf;
echo ' # e.g., www.apache.org (on) or 204.62.129.132 (off).' >> /etc/apache2/apache2.conf;
echo ' # The default is off because itd be overall better for the net if people' >> /etc/apache2/apache2.conf;
echo ' # had to knowingly turn this feature on, since enabling it means that' >> /etc/apache2/apache2.conf;
echo ' # each client request will result in AT LEAST one lookup request to the' >> /etc/apache2/apache2.conf;
echo ' # nameserver.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' HostnameLookups Off' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # ErrorLog: The location of the error log file.' >> /etc/apache2/apache2.conf;
echo ' # If you do not specify an ErrorLog directive within a <VirtualHost>' >> /etc/apache2/apache2.conf;
echo ' # container, error messages relating to that virtual host will be' >> /etc/apache2/apache2.conf;
echo ' # logged here.  If you *do* define an error logfile for a <VirtualHost>' >> /etc/apache2/apache2.conf;
echo ' # container, that hosts errors will be logged there and not here.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # LogLevel: Control the severity of messages logged to the error_log.' >> /etc/apache2/apache2.conf;
echo ' # Available values: trace8, ..., trace1, debug, info, notice, warn,' >> /etc/apache2/apache2.conf;
echo ' # error, crit, alert, emerg.' >> /etc/apache2/apache2.conf;
echo ' # It is also possible to configure the log level for particular modules, e.g.' >> /etc/apache2/apache2.conf;
echo ' # "LogLevel info ssl:warn"' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' LogLevel warn' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Include module configuration:' >> /etc/apache2/apache2.conf;
echo ' IncludeOptional mods-enabled/*.load' >> /etc/apache2/apache2.conf;
echo ' IncludeOptional mods-enabled/*.conf' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Include list of ports to listen on' >> /etc/apache2/apache2.conf;
echo ' Include ports.conf' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Sets the default security model of the Apache2 HTTPD server. It does' >> /etc/apache2/apache2.conf;
echo ' # not allow access to the root filesystem outside of /usr/share and /var/www.' >> /etc/apache2/apache2.conf;
echo ' # The former is used by web applications packaged in Debian,' >> /etc/apache2/apache2.conf;
echo ' # the latter may be used for local directories served by the web server. If' >> /etc/apache2/apache2.conf;
echo ' # your system is serving content from a sub-directory in /srv you must allow' >> /etc/apache2/apache2.conf;
echo ' # access here, or in any related virtual host.' >> /etc/apache2/apache2.conf;
echo ' <Directory />' >> /etc/apache2/apache2.conf;
echo ' 	Options FollowSymLinks' >> /etc/apache2/apache2.conf;
echo ' 	AllowOverride None' >> /etc/apache2/apache2.conf;
echo ' 	Require all denied' >> /etc/apache2/apache2.conf;
echo ' </Directory>' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' <Directory /usr/share>' >> /etc/apache2/apache2.conf;
echo ' 	AllowOverride None' >> /etc/apache2/apache2.conf;
echo ' 	Require all granted' >> /etc/apache2/apache2.conf;
echo ' </Directory>' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' <Directory /gintasview/> # This line was edited' >> /etc/apache2/apache2.conf;
echo ' # The line above was edited' >> /etc/apache2/apache2.conf;
echo ' 	Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf;
echo ' 	AllowOverride None' >> /etc/apache2/apache2.conf;
echo ' 	Require all granted' >> /etc/apache2/apache2.conf;
echo ' </Directory>' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #<Directory /srv/>' >> /etc/apache2/apache2.conf;
echo ' #	Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf;
echo ' #	AllowOverride None' >> /etc/apache2/apache2.conf;
echo ' #	Require all granted' >> /etc/apache2/apache2.conf;
echo ' #</Directory>' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # AccessFileName: The name of the file to look for in each directory' >> /etc/apache2/apache2.conf;
echo ' # for additional configuration directives.  See also the AllowOverride' >> /etc/apache2/apache2.conf;
echo ' # directive.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' AccessFileName .htaccess' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # The following lines prevent .htaccess and .htpasswd files from being' >> /etc/apache2/apache2.conf;
echo ' # viewed by Web clients.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' <FilesMatch "^\.ht">' >> /etc/apache2/apache2.conf;
echo ' 	Require all denied' >> /etc/apache2/apache2.conf;
echo ' </FilesMatch>' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # The following directives define some format nicknames for use with' >> /etc/apache2/apache2.conf;
echo ' # a CustomLog directive.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # These deviate from the Common Log Format definitions in that they use %O' >> /etc/apache2/apache2.conf;
echo ' # (the actual bytes sent including headers) instead of %b (the size of the' >> /etc/apache2/apache2.conf;
echo ' # requested file), because the latter makes it impossible to detect partial' >> /etc/apache2/apache2.conf;
echo ' # requests.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' # Note that the use of %{X-Forwarded-For}i instead of %h is not recommended.' >> /etc/apache2/apache2.conf;
echo ' # Use mod_remoteip instead.' >> /etc/apache2/apache2.conf;
echo ' #' >> /etc/apache2/apache2.conf;
echo ' LogFormat "%v:%p %h %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\"" vhost_combined' >> /etc/apache2/apache2.conf;
echo ' LogFormat "%h %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\"" combined' >> /etc/apache2/apache2.conf;
echo ' LogFormat "%h %l %u %t \"%r\" %>s %O" common' >> /etc/apache2/apache2.conf;
echo ' LogFormat "%{Referer}i -> %U" referer' >> /etc/apache2/apache2.conf;
echo ' LogFormat "%{User-agent}i" agent' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Include of directories ignores editors and dpkgs backup files,' >> /etc/apache2/apache2.conf;
echo ' # see README.Debian for details.' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Include generic snippets of statements' >> /etc/apache2/apache2.conf;
echo ' IncludeOptional conf-enabled/*.conf' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # Include the virtual host configurations:' >> /etc/apache2/apache2.conf;
echo ' IncludeOptional sites-enabled/*.conf' >> /etc/apache2/apache2.conf;
echo ' ' >> /etc/apache2/apache2.conf;
echo ' # vim: syntax=apache ts=4 sw=4 sts=4 sr noet' >> /etc/apache2/apache2.conf;

sudo chmod 777 /etc/apache2/apache2.conf;
sudo chmod 777 /etc/apache2/sites-enabled/000-default.conf;
sudo service apache2 restart;

echo "Server's default folder changed.";
}




function Install_vlc
{
echo "========================================";
echo "Installing VLC media player...";
echo "========================================";
sleep 1;
sudo apt-get install vlc;
echo "========================================";
echo "Installing libraries...";
echo "========================================";
sleep 1;
sudo apt-get install libdvdread4;
echo "========================================";
echo "VLC media player installed.";
}

function Install_avconv
{
echo "========================================";
echo "Installing avconv...";
echo "========================================";
sleep 1;
sudo apt-get install libav-tools;
echo "========================================";
echo "avconv installed.";
}

function Install_css
{
echo "========================================";
echo "Installing CSS...";
echo "========================================";
sleep 1;
sudo /usr/share/doc/libdvdread4/install-css.sh;
echo "========================================";
echo "CSS installed.";
}

function Install_hwinfo
{
echo "========================================";
echo "Installing hwinfo...";
echo "========================================";
sleep 1;
sudo apt-get install hwinfo;
echo "========================================";
echo "hwinfo installed.";
}

function Install_php
{
echo "========================================";
echo "Installing PHP5...";
echo "========================================";
sleep 1;
sudo apt-get install php5;
echo "========================================";
echo "Installing libraries...";
echo "========================================";
sudo apt-get install libapache2-mod-php5;
sudo service apache2 restart;
echo "========================================";
echo "PHP5 installed.";
}

function Udev_restart
{
echo "========================================";
echo "Restarting udev service...";
echo "========================================";
sleep 1;
sudo service udev restart;
echo "========================================";
echo "udev service restarted.";
}

function Install_gedit
{
echo "========================================";
echo "Installing gedit text editor...";
echo "========================================";
sleep 1;
sudo apt-get install gedit;
echo "========================================";
echo "gedit installed.";
}


function Install_lamp
{
echo "========================================";
echo "Installing LAMP server...";
echo "========================================";
sudo apt-get install lamp-server^;
echo "========================================";
echo "LAMP server installed.";
}

function Install_mysql
{
echo "========================================";
echo "Installing MySQL server...";
echo "========================================";
sleep 1;
wget http://dev.mysql.com/get/Downloads/MySQL-5.6/mysql-5.6.16-debian6.0-x86_64.deb
sudo dpkg -i mysql-5.6.16-debian6.0-x86_64.deb
echo "========================================";
echo "MySQL server installed.";
}

function Install_workb
{
echo "========================================";
echo "Installing MySQL Workbench...";
echo "========================================";
sleep 1;
wget http://dev.mysql.com/get/Downloads/MySQLGUITools/mysql-workbench-community-6.0.9-1ubu1310-amd64.deb
sudo dpkg -i mysql-workbench-community-6.0.9-1ubu1310-amd64.deb;
echo "========================================";
echo "MySQL Workbench installed.";
}


function Install_php5_ext
{
echo "========================================";
echo "Installing extensions...";
echo "========================================";
sleep 1;
sudo apt-get install php5-mysql;
sudo chmod 777 /etc/php5/apache2/php.ini;
echo "extension=mysqli.so" >> /etc/php5/apache2/php.ini;
echo "========================================";
echo "Extensions installed.";
}

function Install_firefox
{
echo "========================================";
echo "Installing Mozilla Firefox...";
echo "========================================";
sleep 1;
sudo apt-get install firefox;
echo "========================================";
echo "Mozilla Firefox browser installed.";
}

function Install_chrome
{
echo "========================================";
echo "Installing Google Chrome...";
echo "========================================";
sleep 2;
sudo apt-get install libxss1;
wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb;
sudo dpkg -i google-chrome*.deb;
echo "========================================";
echo "Google Chrome browser installed.";
}


function Mysql_commands
{
echo "========================================";
echo "If you will be asked for password, enter MySQL root's password.";
echo "========================================";
sleep 1;

./myscomm timetagging gopro gopro;

MYCMD='USE timetagging; CREATE TABLE IF NOT EXISTS `timetagging`.`timetags` (
`id` INT NOT NULL AUTO_INCREMENT, 
`date` VARCHAR(45) NULL, 
`timestamp` VARCHAR(45) NULL, 
`timetag` VARCHAR(45) NULL, 
`session` VARCHAR(45) NULL, 
PRIMARY KEY (`id`));';
mysql -u root -pprojektas66 -e "$MYCMD";
echo "========================================";
echo "Database and users created.";
}


function Install_website
{
echo "========================================";
echo "Installing website...";
echo "========================================";
sleep 1;
echo $USER > /userr.txt;
echo $USER > /gintasview/userr.txt;
sudo chmod 777 /userr.txt;
sudo chmod 777 /gintasview/userr.txt;
sudo unzip web.zip -d /gintasview/;
sudo chown -R $USER /gintasview;

echo "========================================";
echo "Website installed.";
}







Create_rt_pass; 
Update;
Upgrade;
Install_exfat_fuse;
Install_apache;
Install_synaptic;
Install_stuff;
Change_www;
Change_perm;
Install_vlc;
Install_avconv;
Install_css;
Install_hwinfo;
Update;
Install_php;
Udev_restart;
Install_gedit;
Install_lamp;
Install_mysql;
Install_workb;
Install_php5_ext;
Install_firefox;
Install_chrome;
Update;
Mysql_commands;
Install_website;




