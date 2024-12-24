# filesystem-debug-helper
Debug code that uses the WordPress Filesystem API without needing to setup FTP or SSH access to your server.

Usage:

1. Just upload this Wordpress plugin using the plugin uploader, or manually place it in your plugins directory.
2. Activate this plugin
3. Anytime a plugin or theme uses the Wordpress Filesystem API to write to the filesystem, we pretend you require a username
and password, just like you would if you were using the FTP or SSH methods.
4. When asked for credentials, use the username "username" and the password "password". You can also put these into your wp-config.php file in the constant "FTP_USER" and "FTP_PASS". Otherwise, this should behave as the FTP or 
SSH filesystem methods. 
