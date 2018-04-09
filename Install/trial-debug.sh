#!/bin/bash

function Create_rt_pass
{
#echo "========================================";
#echo "Will now create a new root password,";
#echo "so later you can use your account with root priviledges.";
#sleep 1;
#echo "========================================";
#sudo passwd root;
#echo "========================================";
echo "Password successfully created/changed!";
}

function Change_perm
{
sudo chmod -R 777 /home/$USER/Documents/;
}

function Update
{
#echo "========================================";
#echo "Starting to update...";
#echo "========================================";
#sleep 1;
#sudo apt-get update;
#echo "========================================";
echo "Update finished.";
}

function Upgrade
{
#echo "========================================";
#echo "Starting to upgrade...";
#echo "========================================";
#sleep 1;
#sudo apt-get upgrade;
#echo "========================================";
echo "Upgrade finished.";
}

function Install_exfat_fuse
{
#echo "========================================";
#echo "Installing exfat-fuse...";
#echo "========================================";
#sleep 1;
#sudo apt-get install exfat-fuse;
#sudo apt-add-repository ppa:relan/exfat;
#sudo add-apt-repository ppa:relan/exfat;
#sudo apt-get install exfat-utils;
#sudo apt-get install fuse-exfat;
#echo "========================================";
echo "Exfat-fuse installed.";
}

function Install_apache
{
#echo "========================================";
#echo "Installing apache2 server...";
#echo "========================================";
#sleep 1;
#sudo apt-get install apache2;
#echo "========================================";
echo "apache2 server installed.";
}

function Install_synaptic
{
#echo "========================================";
#echo "Installing synapctic package manager...";
#echo "========================================";
#sleep 1;
#sudo apt-get install synaptic
#echo "========================================";
echo "Synaptic package manager installed.";
}

function Install_stuff
{
#echo "========================================";
#echo "Installing extra stuff...";
#echo "========================================";
#sleep 1;
#sudo apt-get install ubuntu-restricted-extras
#echo "========================================";
echo "Extra stuff for ubuntu installed.";
}


function Change_www
{
sudo chown -R $USER /etc/apache2/;
sudo chmod 777 /etc/apache2/sites-enabled/000-default.conf;
sudo chmod 777 /etc/apache2/apache2.conf;

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
echo "	DocumentRoot /" >> /etc/apache2/sites-enabled/000-default.conf;
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

echo ' # This is the main Apache server configuration file.  It contains the' > /etc/apache2/apache2.conf2;
echo ' # configuration directives that give the server its instructions.' >> /etc/apache2/apache2.conf2;
echo ' # See http://httpd.apache.org/docs/2.4/ for detailed information about' >> /etc/apache2/apache2.conf2;
echo ' # the directives and /usr/share/doc/apache2/README.Debian about Debian specific' >> /etc/apache2/apache2.conf2;
echo ' # hints.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # Summary of how the Apache 2 configuration works in Debian:' >> /etc/apache2/apache2.conf2;
echo ' # The Apache 2 web server configuration in Debian is quite different to' >> /etc/apache2/apache2.conf2;
echo ' # upstream's suggested way to configure the web server. This is because Debian's' >> /etc/apache2/apache2.conf2;
echo ' # default Apache2 installation attempts to make adding and removing modules,' >> /etc/apache2/apache2.conf2;
echo ' # virtual hosts, and extra configuration directives as flexible as possible, in' >> /etc/apache2/apache2.conf2;
echo ' # order to make automating the changes and administering the server as easy as' >> /etc/apache2/apache2.conf2;
echo ' # possible.' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # It is split into several files forming the configuration hierarchy outlined' >> /etc/apache2/apache2.conf2;
echo ' # below, all located in the /etc/apache2/ directory:' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' #	/etc/apache2/' >> /etc/apache2/apache2.conf2;
echo ' #	|-- apache2.conf' >> /etc/apache2/apache2.conf2;
echo ' #	|	`--  ports.conf' >> /etc/apache2/apache2.conf2;
echo ' #	|-- mods-enabled' >> /etc/apache2/apache2.conf2;
echo ' #	|	|-- *.load' >> /etc/apache2/apache2.conf2;
echo ' #	|	`-- *.conf' >> /etc/apache2/apache2.conf2;
echo ' #	|-- conf-enabled' >> /etc/apache2/apache2.conf2;
echo ' #	|	`-- *.conf' >> /etc/apache2/apache2.conf2;
echo ' # 	`-- sites-enabled' >> /etc/apache2/apache2.conf2;
echo ' #	 	`-- *.conf' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # * apache2.conf is the main configuration file (this file). It puts the pieces' >> /etc/apache2/apache2.conf2;
echo ' #   together by including all remaining configuration files when starting up the' >> /etc/apache2/apache2.conf2;
echo ' #   web server.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # * ports.conf is always included from the main configuration file. It is' >> /etc/apache2/apache2.conf2;
echo ' #   supposed to determine listening ports for incoming connections which can be' >> /etc/apache2/apache2.conf2;
echo ' #   customized anytime.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # * Configuration files in the mods-enabled/, conf-enabled/ and sites-enabled/' >> /etc/apache2/apache2.conf2;
echo ' #   directories contain particular configuration snippets which manage modules,' >> /etc/apache2/apache2.conf2;
echo ' #   global configuration fragments, or virtual host configurations,' >> /etc/apache2/apache2.conf2;
echo ' #   respectively.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' #   They are activated by symlinking available configuration files from their' >> /etc/apache2/apache2.conf2;
echo ' #   respective *-available/ counterparts. These should be managed by using our' >> /etc/apache2/apache2.conf2;
echo ' #   helpers a2enmod/a2dismod, a2ensite/a2dissite and a2enconf/a2disconf. See' >> /etc/apache2/apache2.conf2;
echo ' #   their respective man pages for detailed information.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # * The binary is called apache2. Due to the use of environment variables, in' >> /etc/apache2/apache2.conf2;
echo ' #   the default configuration, apache2 needs to be started/stopped with' >> /etc/apache2/apache2.conf2;
echo ' #   /etc/init.d/apache2 or apache2ctl. Calling /usr/bin/apache2 directly will not' >> /etc/apache2/apache2.conf2;
echo ' #   work with the default configuration.' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Global configuration' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # ServerRoot: The top of the directory tree under which the servers' >> /etc/apache2/apache2.conf2;
echo ' # configuration, error, and log files are kept.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # NOTE!  If you intend to place this on an NFS (or otherwise network)' >> /etc/apache2/apache2.conf2;
echo ' # mounted filesystem then please read the Mutex documentation (available' >> /etc/apache2/apache2.conf2;
echo ' # at <URL:http://httpd.apache.org/docs/2.4/mod/core.html#mutex>);' >> /etc/apache2/apache2.conf2;
echo ' # you will save yourself a lot of trouble.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # Do NOT add a slash at the end of the directory path.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' #ServerRoot "/etc/apache2"' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # The accept serialization lock file MUST BE STORED ON A LOCAL DISK.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' Mutex file:${APACHE_LOCK_DIR} default' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # PidFile: The file in which the server should record its process' >> /etc/apache2/apache2.conf2;
echo ' # identification number when it starts.' >> /etc/apache2/apache2.conf2;
echo ' # This needs to be set in /etc/apache2/envvars' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' PidFile ${APACHE_PID_FILE}' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # Timeout: The number of seconds before receives and sends time out.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' Timeout 300' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # KeepAlive: Whether or not to allow persistent connections (more than' >> /etc/apache2/apache2.conf2;
echo ' # one request per connection). Set to "Off" to deactivate.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' KeepAlive On' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # MaxKeepAliveRequests: The maximum number of requests to allow' >> /etc/apache2/apache2.conf2;
echo ' # during a persistent connection. Set to 0 to allow an unlimited amount.' >> /etc/apache2/apache2.conf2;
echo ' # We recommend you leave this number high, for maximum performance.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' MaxKeepAliveRequests 100' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # KeepAliveTimeout: Number of seconds to wait for the next request from the' >> /etc/apache2/apache2.conf2;
echo ' # same client on the same connection.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' KeepAliveTimeout 5' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # These need to be set in /etc/apache2/envvars' >> /etc/apache2/apache2.conf2;
echo ' User ${APACHE_RUN_USER}' >> /etc/apache2/apache2.conf2;
echo ' Group ${APACHE_RUN_GROUP}' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # HostnameLookups: Log the names of clients or just their IP addresses' >> /etc/apache2/apache2.conf2;
echo ' # e.g., www.apache.org (on) or 204.62.129.132 (off).' >> /etc/apache2/apache2.conf2;
echo ' # The default is off because itd be overall better for the net if people' >> /etc/apache2/apache2.conf2;
echo ' # had to knowingly turn this feature on, since enabling it means that' >> /etc/apache2/apache2.conf2;
echo ' # each client request will result in AT LEAST one lookup request to the' >> /etc/apache2/apache2.conf2;
echo ' # nameserver.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' HostnameLookups Off' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # ErrorLog: The location of the error log file.' >> /etc/apache2/apache2.conf2;
echo ' # If you do not specify an ErrorLog directive within a <VirtualHost>' >> /etc/apache2/apache2.conf2;
echo ' # container, error messages relating to that virtual host will be' >> /etc/apache2/apache2.conf2;
echo ' # logged here.  If you *do* define an error logfile for a <VirtualHost>' >> /etc/apache2/apache2.conf2;
echo ' # container, that hosts errors will be logged there and not here.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' ErrorLog ${APACHE_LOG_DIR}/error.log' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # LogLevel: Control the severity of messages logged to the error_log.' >> /etc/apache2/apache2.conf2;
echo ' # Available values: trace8, ..., trace1, debug, info, notice, warn,' >> /etc/apache2/apache2.conf2;
echo ' # error, crit, alert, emerg.' >> /etc/apache2/apache2.conf2;
echo ' # It is also possible to configure the log level for particular modules, e.g.' >> /etc/apache2/apache2.conf2;
echo ' # "LogLevel info ssl:warn"' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' LogLevel warn' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Include module configuration:' >> /etc/apache2/apache2.conf2;
echo ' IncludeOptional mods-enabled/*.load' >> /etc/apache2/apache2.conf2;
echo ' IncludeOptional mods-enabled/*.conf' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Include list of ports to listen on' >> /etc/apache2/apache2.conf2;
echo ' Include ports.conf' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Sets the default security model of the Apache2 HTTPD server. It does' >> /etc/apache2/apache2.conf2;
echo ' # not allow access to the root filesystem outside of /usr/share and /var/www.' >> /etc/apache2/apache2.conf2;
echo ' # The former is used by web applications packaged in Debian,' >> /etc/apache2/apache2.conf2;
echo ' # the latter may be used for local directories served by the web server. If' >> /etc/apache2/apache2.conf2;
echo ' # your system is serving content from a sub-directory in /srv you must allow' >> /etc/apache2/apache2.conf2;
echo ' # access here, or in any related virtual host.' >> /etc/apache2/apache2.conf2;
echo ' <Directory />' >> /etc/apache2/apache2.conf2;
echo ' 	Options FollowSymLinks' >> /etc/apache2/apache2.conf2;
echo ' 	AllowOverride None' >> /etc/apache2/apache2.conf2;
echo ' 	Require all denied' >> /etc/apache2/apache2.conf2;
echo ' </Directory>' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' <Directory /usr/share>' >> /etc/apache2/apache2.conf2;
echo ' 	AllowOverride None' >> /etc/apache2/apache2.conf2;
echo ' 	Require all granted' >> /etc/apache2/apache2.conf2;
echo ' </Directory>' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' <Directory />' >> /etc/apache2/apache2.conf2;
echo ' 	Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf2;
echo ' 	AllowOverride None' >> /etc/apache2/apache2.conf2;
echo ' 	Require all granted' >> /etc/apache2/apache2.conf2;
echo ' </Directory>' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #<Directory /srv/>' >> /etc/apache2/apache2.conf2;
echo ' #	Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf2;
echo ' #	AllowOverride None' >> /etc/apache2/apache2.conf2;
echo ' #	Require all granted' >> /etc/apache2/apache2.conf2;
echo ' #</Directory>' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # AccessFileName: The name of the file to look for in each directory' >> /etc/apache2/apache2.conf2;
echo ' # for additional configuration directives.  See also the AllowOverride' >> /etc/apache2/apache2.conf2;
echo ' # directive.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' AccessFileName .htaccess' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # The following lines prevent .htaccess and .htpasswd files from being' >> /etc/apache2/apache2.conf2;
echo ' # viewed by Web clients.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' <FilesMatch "^\.ht">' >> /etc/apache2/apache2.conf2;
echo ' 	Require all denied' >> /etc/apache2/apache2.conf2;
echo ' </FilesMatch>' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # The following directives define some format nicknames for use with' >> /etc/apache2/apache2.conf2;
echo ' # a CustomLog directive.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # These deviate from the Common Log Format definitions in that they use %O' >> /etc/apache2/apache2.conf2;
echo ' # (the actual bytes sent including headers) instead of %b (the size of the' >> /etc/apache2/apache2.conf2;
echo ' # requested file), because the latter makes it impossible to detect partial' >> /etc/apache2/apache2.conf2;
echo ' # requests.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' # Note that the use of %{X-Forwarded-For}i instead of %h is not recommended.' >> /etc/apache2/apache2.conf2;
echo ' # Use mod_remoteip instead.' >> /etc/apache2/apache2.conf2;
echo ' #' >> /etc/apache2/apache2.conf2;
echo ' LogFormat "%v:%p %h %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\"" vhost_combined' >> /etc/apache2/apache2.conf2;
echo ' LogFormat "%h %l %u %t \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\"" combined' >> /etc/apache2/apache2.conf2;
echo ' LogFormat "%h %l %u %t \"%r\" %>s %O" common' >> /etc/apache2/apache2.conf2;
echo ' LogFormat "%{Referer}i -> %U" referer' >> /etc/apache2/apache2.conf2;
echo ' LogFormat "%{User-agent}i" agent' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Include of directories ignores editors and dpkgs backup files,' >> /etc/apache2/apache2.conf2;
echo ' # see README.Debian for details.' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Include generic snippets of statements' >> /etc/apache2/apache2.conf2;
echo ' IncludeOptional conf-enabled/*.conf' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # Include the virtual host configurations:' >> /etc/apache2/apache2.conf2;
echo ' IncludeOptional sites-enabled/*.conf' >> /etc/apache2/apache2.conf2;
echo ' ' >> /etc/apache2/apache2.conf2;
echo ' # vim: syntax=apache ts=4 sw=4 sts=4 sr noet' >> /etc/apache2/apache2.conf2;


sudo chmod 777 /etc/apache2/apache2.conf2;

echo "Server's default folder changed.";
}




function Install_vlc
{
#echo "========================================";
#echo "Installing VLC media player...";
#echo "========================================";
#sleep 1;
#sudo apt-get install vlc;
#echo "========================================";
#echo "Installing libraries...";
#echo "========================================";
#sleep 1;
#sudo apt-get install libdvdread4;
#echo "========================================";
echo "VLC media player installed.";
}

function Install_avconv
{
#echo "========================================";
#echo "Installing avconv...";
#echo "========================================";
#sleep 1;
#sudo apt-get install libav-tools;
#echo "========================================";
echo "avconv installed.";
}

function Install_css
{
#echo "========================================";
#echo "Installing CSS...";
#echo "========================================";
#sleep 1;
#sudo /usr/share/doc/libdvdread4/install-css.sh;
#echo "========================================";
echo "CSS installed.";
}

function Install_hwinfo
{
#echo "========================================";
#echo "Installing hwinfo...";
#echo "========================================";
#sleep 1;
#sudo apt-get install hwinfo;
#echo "========================================";
echo "hwinfo installed.";
}

function Install_php
{
#echo "========================================";
#echo "Installing PHP5...";
#echo "========================================";
#sleep 1;
#sudo apt-get install php5;
#echo "========================================";
#echo "Installing libraries...";
#echo "========================================";
#sudo apt-get install libapache2-mod-php5;
#sudo service apache2 restart;
#echo "========================================";
echo "PHP5 installed.";
}

function Udev_restart
{
#echo "========================================";
#echo "Restarting udev service...";
#echo "========================================";
#sleep 1;
#sudo service udev restart;
#echo "========================================";
echo "udev service restarted.";
}

function Install_gedit
{
#echo "========================================";
#echo "Installing gedit text editor...";
#echo "========================================";
#sleep 1;
#sudo apt-get install gedit;
#echo "========================================";
echo "gedit installed.";
}

function Install_mysql
{
#echo "========================================";
#echo "Installing MySQL server...";
#echo "========================================";
#sleep 1;
#sudo apt-get install  mysql-server;
#echo "========================================";
echo "MySQL server installed.";
}

function Install_workb
{
#echo "========================================";
#echo "Installing MySQL Workbench...";
#echo "========================================";
#sleep 1;
#sudo apt-get install mysql-workbench;
#echo "========================================";
echo "MySQL Workbench installed.";
}

function Install_php5_ext
{
#echo "========================================";
#echo "Installing extensions...";
#echo "========================================";
#sleep 1;
#sudo apt-get install php5-mysql;
#sudo chmod 777 /etc/php5/apache2/php.ini;
#echo "extension=mysqli.so" >> /etc/php5/apache2/php.ini;
#echo "========================================";
echo "Extensions installed.";
}

function Install_firefox
{
#echo "========================================";
#echo "Installing Mozilla Firefox...";
#echo "========================================";
#sleep 1;
#sudo apt-get install firefox;
#echo "========================================";
echo "Mozilla Firefox browser installed.";
}

function Install_chrome
{
#echo "========================================";
#echo "Installing Google Chrome...";
#echo "========================================";
#sleep 2;
#sudo apt-get install libxss1;
#wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb;
#sudo dpkg -i google-chrome*.deb;
#echo "========================================";
echo "Google Chrome browser installed.";
}

function Install_website
{
#echo "========================================";
#echo "Installing website...";
#echo "========================================";
#sleep 1;
#sudo unzip webhere.zip -d /;
sudo chown $USER /alljavascript.js;
sudo chown $USER /alt-logo2.png;
sudo chown $USER /alt-logo.png;
sudo chown $USER /audio.png;
sudo chown $USER /down-arrow.png;
sudo chown $USER /favicon.ico;
sudo chown $USER -R /fonts;
sudo chown $USER -R /images;
sudo chown $USER /index.php;
sudo chown $USER /jquery-1.10.2.js;
sudo chown $USER /jquery-1.7.1.js;
sudo chown $USER /jquery-ui.css;
sudo chown $USER /jquery-ui.js;
sudo chown $USER /Number-1.png;
sudo chown $USER /Number-2.png;
sudo chown $USER /Number-3.png;
sudo chown $USER /Number-4.png;
sudo chown $USER /pause.png;
sudo chown $USER /play.png;
sudo chown $USER /reset.png;
sudo chown $USER /save.php;
sudo chown $USER /SkejSimlogo_name.png;
sudo chown $USER /stopwatch.php;
sudo chown $USER /style.css;
sudo chown $USER /submit.png;
sudo chown $USER /tag.php;
sudo chown $USER /timetags.php;
#echo "========================================";
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
Install_mysql;
Install_workb;
Install_php5_ext;
Install_firefox;
Install_chrome;
Update;
Install_website;


