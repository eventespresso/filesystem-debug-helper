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
			return parent::get_contents( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::get_contents_array( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::put_contents( $this->_simulate_remote_filepath_is_different_from_local( $file ), $contents, $mode);
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
			return parent::chdir( $this->_simulate_remote_filepath_is_different_from_local( $dir ) );
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
			return parent::chgrp( $this->_simulate_remote_filepath_is_different_from_local( $file ), $group, $recursive );
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
			return parent::chmod( $this->_simulate_remote_filepath_is_different_from_local( $file ), $mode, $recursive );
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
			return parent:: chown( $this->_simulate_remote_filepath_is_different_from_local( $file ), $owner, $recursive );
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
			return parent::owner( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::getchmod( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::group( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::copy( $this->_simulate_remote_filepath_is_different_from_local( $source ), 
					$this->_simulate_remote_filepath_is_different_from_local( $destination ), 
					$overwrite, 
					$mode );
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
			return parent::move(
					$this->_simulate_remote_filepath_is_different_from_local( $source), 
					$this->_simulate_remote_filepath_is_different_from_local( $destination ), 
					$overwrite );
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
			return parent::delete( $this->_simulate_remote_filepath_is_different_from_local( $file ), $recursive, $type );
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
			return parent::exists( $this->_simulate_remote_filepath_is_different_from_local( $file ));
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
			return parent::is_file( $this->_simulate_remote_filepath_is_different_from_local( $file ));
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
			return parent::is_dir($this->_simulate_remote_filepath_is_different_from_local( $path ));
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
			return parent::is_readable( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::is_writable( $this->_simulate_remote_filepath_is_different_from_local( $file ));
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
			return parent::atime( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::mtime( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::size( $this->_simulate_remote_filepath_is_different_from_local( $file ) );
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
			return parent::touch( $this->_simulate_remote_filepath_is_different_from_local( $file ), $time, $atime );
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
			return parent:: mkdir( $this->_simulate_remote_filepath_is_different_from_local( $path ), $chmod, $chown, $chgrp );
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
			return parent::rmdir( $this->_simulate_remote_filepath_is_different_from_local( $path ), $recursive );
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
			return parent::dirlist( $this->_simulate_remote_filepath_is_different_from_local( $path ), $include_hidden, $recursive );
		} else{
			return false;
		}
	}
	
	/**
	 * Because the filepath on the server may be different for the PHP code than
	 * for the filesystem method (ftp or ssh), we want to simulate that in this plugin.
	 * Specifically, folks need to use $wp_filesystem->wp_content_dir() instead of WP_CONTENT_DIR,
	 * because they aren't necessarily always going to be the same. 
	 * $wp_filesystem->wp_content_dir() should be passed into $wp_filesystem methods,
	 * whereas WP_CONTENT_DIR should be passed into php functions that access the filesystem.
	 * SO if someone forgets that, let's have them instead read/write from "wp-content-IMPROPER-USAGE-OF-WP-FILESYSTEM"
	 * @param string $should_be_remote_filepath
	 */
	protected function _simulate_remote_filepath_is_different_from_local( $should_be_remote_filepath ) {
		if( strpos( $should_be_remote_filepath, WP_CONTENT_DIR . self::remote_filesystem_proof_using_properly ) === false ) {
			//gotcha! you werent using $wp_filesystme->wp_content_dir()!
			throw new Exception( 'The WP FIlesystem Debugger caught you doing something naughty. '
					. 'You passed in WP_CONTENT_DIR as a filepath right? Specifically, you passed in ' . 
					$should_be_remote_filepath
					. 'You should use '
					. '$wp_filesystem->wp_content_dir() because that is the path '
					. 'according to the method being used to access the filesystem, '
					. 'which might be different than the local path set by WP_CONTENT_DIR.');
		} else {
			//ok you're good. We'll let you know the correct filepath
			return str_replace( WP_CONTENT_DIR . self::remote_filesystem_proof_using_properly, WP_CONTENT_DIR, $should_be_remote_filepath );
		}
	}
	
	/**
	 * As explained on WP_Filesystem_Debug::_simulate_remote_filepath_is_different_from_local(),
	 * this pretends the correct filepath to the wp-content directory has the string
	 * "IMPROPER-USAGE-OF-WP-FILESYSTEM" on the wp-content folder name.
	 * Anyone who doesn't use that won't have that string and will be FOUND OUT!
	 * This will help detect if someone is forgetting to use this folder
	 * @param type $folder
	 */
	public function find_folder( $folder ) {
		return str_replace( WP_CONTENT_DIR, WP_CONTENT_DIR . self::remote_filesystem_proof_using_properly, $folder );
	}
	const remote_filesystem_proof_using_properly = 'PROPERLY-USING-OF-WP-FILESYSTEM';
}

