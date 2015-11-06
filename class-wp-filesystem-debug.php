<?php
class WP_Filesystem_Debug extends WP_Filesystem_Direct {
	protected $_authorized = false;
	public function __construct($opt) {
		parent::__construct($opt);
		$this->method = 'debug';
		$this->options['username'] = $opt['username'];
		$this->options['password'] = $opt['password'];
	}
	function connect() {
		if( $this->options[ 'username' ] !== 'username' ) {
			$this->errors->add( 'bad_username', __( 'Bad Username. Use the username "username"', 'event_espresso' ));
		}
		if( $this->options[ 'password' ] !== 'password' ) {
			$this->errors->add( 'bad_password', __( 'Bad Password. Use the password "password"', 'event_espresso' ));
		}
		if( $this->authorized() ) {
			return true;
		} else {
			return false;
		}
	}
	
	public function authorized() {
		if( is_wp_error( $this->errors )  && $this->errors->get_error_code() ) {
			return false;
		} else { 
			return true;
		}
	}
	
	/**
	 * Reads entire file into a string
	 *
	 * @access public
	 *
	 * @param string $file Name of the file to read.
	 * @return string|bool The function returns the read data or false on failure.
	 */
	public function get_contents($file) {
		if( $this->authorized() ) {
			return parent::get_contents( $file );
		} else{
			return false;
		}
	}

	/**
	 * Reads entire file into an array
	 *
	 * @access public
	 *
	 * @param string $file Path to the file.
	 * @return array|bool the file contents in an array or false on failure.
	 */
	public function get_contents_array($file) {
		if( $this->authorized() ) {
			return parent::get_contents_array( $file );
		} else{
			return false;
		}
	}

	/**
	 * Write a string to a file
	 *
	 * @access public
	 *
	 * @param string $file     Remote path to the file where to write the data.
	 * @param string $contents The data to write.
	 * @param int    $mode     Optional. The file permissions as octal number, usually 0644.
	 *                         Default false.
	 * @return bool False upon failure, true otherwise.
	 */
	public function put_contents( $file, $contents, $mode = false ) {
		if( $this->authorized() ) {
			return parent::put_contents( $file, $contents, $mode);
		} else{
			return false;
		}
	}

	/**
	 * Gets the current working directory
	 *
	 * @access public
	 *
	 * @return string|bool the current working directory on success, or false on failure.
	 */
	public function cwd() {
		if( $this->authorized() ) {
			return parent::cwd();
		} else{
			return false;
		}
	}

	/**
	 * Change directory
	 *
	 * @access public
	 *
	 * @param string $dir The new current directory.
	 * @return bool Returns true on success or false on failure.
	 */
	public function chdir($dir) {
		if( $this->authorized() ) {
			return parent::chdir( $dir );
		} else{
			return false;
		}
	}

	/**
	 * Changes file group
	 *
	 * @access public
	 *
	 * @param string $file      Path to the file.
	 * @param mixed  $group     A group name or number.
	 * @param bool   $recursive Optional. If set True changes file group recursively. Default false.
	 * @return bool Returns true on success or false on failure.
	 */
	public function chgrp($file, $group, $recursive = false) {
		if( $this->authorized() ) {
			return parent::chgrp($file, $group, $recursive );
		} else{
			return false;
		}
	}

	/**
	 * Changes filesystem permissions
	 *
	 * @access public
	 *
	 * @param string $file      Path to the file.
	 * @param int    $mode      Optional. The permissions as octal number, usually 0644 for files,
	 *                          0755 for dirs. Default false.
	 * @param bool   $recursive Optional. If set True changes file group recursively. Default false.
	 * @return bool Returns true on success or false on failure.
	 */
	public function chmod($file, $mode = false, $recursive = false) {
		if( $this->authorized() ) {
			return parent::chmod($file, $mode, $recursive );
		} else{
			return false;
		}
	}

	/**
	 * Changes file owner
	 *
	 * @access public
	 *
	 * @param string $file      Path to the file.
	 * @param mixed  $owner     A user name or number.
	 * @param bool   $recursive Optional. If set True changes file owner recursively.
	 *                          Default false.
	 * @return bool Returns true on success or false on failure.
	 */
	public function chown($file, $owner, $recursive = false) {
		if( $this->authorized() ) {
			return parent:: chown($file, $owner, $recursive );
		} else{
			return false;
		}
	}

	/**
	 * Gets file owner
	 *
	 * @access public
	 *
	 * @param string $file Path to the file.
	 * @return string|bool Username of the user or false on error.
	 */
	public function owner($file) {
		if( $this->authorized() ) {
			return parent::owner( $file );
		} else{
			return false;
		}
	}

	/**
	 * Gets file permissions
	 *
	 * FIXME does not handle errors in fileperms()
	 *
	 * @access public
	 *
	 * @param string $file Path to the file.
	 * @return string Mode of the file (last 3 digits).
	 */
	public function getchmod($file) {
		if( $this->authorized() ) {
			return parent::getchmod( $file );
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @return string|false
	 */
	public function group($file) {
		if( $this->authorized() ) {
			return parent::group( $file );
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $source
	 * @param string $destination
	 * @param bool   $overwrite
	 * @param int    $mode
	 * @return bool
	 */
	public function copy($source, $destination, $overwrite = false, $mode = false) {
		if( $this->authorized() ) {
			return parent::copy($source, $destination, $overwrite, $mode );
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $source
	 * @param string $destination
	 * @param bool $overwrite
	 * @return bool
	 */
	public function move($source, $destination, $overwrite = false) {
		if( $this->authorized() ) {
			return parent::move($source, $destination, $overwrite );
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @param bool $recursive
	 * @param string $type
	 * @return bool
	 */
	public function delete($file, $recursive = false, $type = false) {
		if( $this->authorized() ) {
			return parent::delete($file, $recursive, $type );
		} else{
			return false;
		}
	}
	/**
	 * @access public
	 *
	 * @param string $file
	 * @return bool
	 */
	public function exists($file) {
		if( $this->authorized() ) {
			return parent::exists($file);
		} else{
			return false;
		}
	}
	/**
	 * @access public
	 *
	 * @param string $file
	 * @return bool
	 */
	public function is_file($file) {
		if( $this->authorized() ) {
			return parent::is_file($file);
		} else{
			return false;
		}
	}
	/**
	 * @access public
	 *
	 * @param string $path
	 * @return bool
	 */
	public function is_dir($path) {
		if( $this->authorized() ) {
			return parent::is_dir($path);
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @return bool
	 */
	public function is_readable($file) {
		if( $this->authorized() ) {
			return parent::is_readable($file);
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @return bool
	 */
	public function is_writable($file) {
		if( $this->authorized() ) {
			return parent::is_writable($file);
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @return int
	 */
	public function atime($file) {
		if( $this->authorized() ) {
			return parent::atime($file);
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @return int
	 */
	public function mtime($file) {
		if( $this->authorized() ) {
			return parent::mtime($file);
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @return int
	 */
	public function size($file) {
		if( $this->authorized() ) {
			return parent::size($file);
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $file
	 * @param int $time
	 * @param int $atime
	 * @return bool
	 */
	public function touch($file, $time = 0, $atime = 0) {
		if( $this->authorized() ) {
			return parent::touch($file, $time, $atime );
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $path
	 * @param mixed  $chmod
	 * @param mixed  $chown
	 * @param mixed  $chgrp
	 * @return bool
	 */
	public function mkdir($path, $chmod = false, $chown = false, $chgrp = false) {
		if( $this->authorized() ) {
			return parent:: mkdir($path, $chmod, $chown, $chgrp );
		} else{
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $path
	 * @param bool $recursive
	 * @return bool
	 */
	public function rmdir($path, $recursive = false) {
		if( $this->authorized() ) {
			return parent::rmdir($path, $recursive );
		} else {
			return false;
		}
	}

	/**
	 * @access public
	 *
	 * @param string $path
	 * @param bool $include_hidden
	 * @param bool $recursive
	 * @return bool|array
	 */
	public function dirlist($path, $include_hidden = true, $recursive = false) {
		if( $this->authorized() ) {
			return parent::dirlist($path, $include_hidden, $recursive );
		} else{
			return false;
		}
	}	
}

