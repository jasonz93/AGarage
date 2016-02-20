<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 上午4:40
 */

if ( ! in_array("mysaekv", stream_get_wrappers()) )
    stream_wrapper_register("mysaekv", "MySaeKVWrapper");

class MySaeKVWrapper // implements WrapperInterface
{
    private $dir_mode = 16895 ; //040000 + 0222;
    private $file_mode = 33279 ; //0100000 + 0777;
    private $kvkey;


    public function __construct() { }

    private function kv() {
        if ( !isset( $this->kv ) ) $this->kv = new SaeKV();
        $this->kv->init();
        return $this->kv;
    }

    private function open( $key ) {
        $value = $this->kv()->get( $key );
        if ( $value !== false && $this->unpack_stat(substr($value, 0, 20)) === true ) {
            $this->kvcontent = substr($value, 20);
            return true;
        } else {
            return false;
        }
    }

    private function save( $key ) {
        $this->stat['mtime'] = $this->stat[9] = time();
        if ( isset($this->kvcontent) ) {
            $this->stat['size'] = $this->stat[7] = strlen($this->kvcontent);
            $value = $this->pack_stat() . $this->kvcontent;
        } else {
            $this->stat['size'] = $this->stat[7] = 0;
            $value = $this->pack_stat();
        }
        return $this->kv()->set($key, $value);
    }

    private function unpack_stat( $str ) {
        $arr = unpack("L5", $str);

        // check if valid
        if ( $arr[1] < 10000 ) return false;
        if ( !in_array($arr[2], array( $this->dir_mode, $this->file_mode ) ) ) return false;
        if ( $arr[4] > time() ) return false;
        if ( $arr[5] > time() ) return false;

        $this->stat['dev'] = $this->stat[0] = 0x8003;
        $this->stat['ino'] = $this->stat[1] = $arr[1];
        $this->stat['mode'] = $this->stat[2] = $arr[2];
        $this->stat['nlink'] = $this->stat[3] = 0;
        $this->stat['uid'] = $this->stat[4] = 0;
        $this->stat['gid'] = $this->stat[5] = 0;
        $this->stat['rdev'] = $this->stat[6] = 0;
        $this->stat['size'] = $this->stat[7] = $arr[3];
        $this->stat['atime'] = $this->stat[8] = 0;
        $this->stat['mtime'] = $this->stat[9] = $arr[4];
        $this->stat['ctime'] = $this->stat[10] = $arr[5];
        $this->stat['blksize'] = $this->stat[11] = 0;
        $this->stat['blocks'] = $this->stat[12] = 0;

        return true;
    }

    private function pack_stat( ) {
        $str = pack("LLLLL", $this->stat['ino'], $this->stat['mode'], $this->stat['size'], $this->stat['ctime'], $this->stat['mtime']);
        return $str;
    }

    public function stream_open( $path , $mode , $options , &$opened_path)
    {
        $this->position = 0;
        $this->kvkey = rtrim(trim(substr(trim($path), 10)), '/');
        $this->mode = $mode;
        $this->options = $options;

        if ( in_array( $this->mode, array( 'r', 'r+', 'rb' ) ) ) {
            if ( $this->open( $this->kvkey ) === false ) {
                trigger_error("fopen({$path}): No such key in KVDB.", E_USER_WARNING);
                return false;
            }
        } elseif ( in_array( $this->mode, array( 'a', 'a+', 'ab' ) ) ) {
            if ( $this->open( $this->kvkey ) === true ) {
                $this->position = strlen($this->kvcontent);
            } else {
                $this->kvcontent = '';
                $this->statinfo_init();
            }
        } elseif ( in_array( $this->mode, array( 'x', 'x+', 'xb' ) ) ) {
            if ( $this->open( $this->kvkey ) === false ) {
                $this->kvcontent = '';
                $this->statinfo_init();
            } else {
                trigger_error("fopen({$path}): Key exists in KVDB.", E_USER_WARNING);
                return false;
            }
        } elseif ( in_array( $this->mode, array( 'w', 'w+', 'wb' ) ) ) {
            $this->kvcontent = '';
            $this->statinfo_init();
        } else {
            $this->open( $this->kvkey );
        }

        return true;
    }

    public function stream_read($count)
    {
        if (in_array($this->mode, array('w', 'x', 'a', 'wb', 'xb', 'ab') ) ) {
            return false;
        }

        $ret = substr( $this->kvcontent , $this->position, $count);
        $this->position += strlen($ret);

        return $ret;
    }

    public function stream_write($data)
    {
        if ( in_array( $this->mode, array( 'r', 'rb' ) ) ) {
            return false;
        }

        $left = substr($this->kvcontent, 0, $this->position);
        $right = substr($this->kvcontent, $this->position + strlen($data));
        $this->kvcontent = $left . $data . $right;

        if ( $this->save( $this->kvkey ) === true ) {
            $this->position += strlen($data);
            return strlen( $data );
        } else return false;
    }

    public function stream_close()
    {
        $this->save( $this->kvkey );
    }


    public function stream_eof()
    {

        return $this->position >= strlen( $this->kvcontent  );
    }

    public function stream_tell()
    {

        return $this->position;
    }

    public function stream_seek($offset , $whence = SEEK_SET)
    {

        switch ($whence) {
            case SEEK_SET:

                if ($offset < strlen( $this->kvcontent ) && $offset >= 0) {
                    $this->position = $offset;
                    return true;
                }
                else
                    return false;

                break;

            case SEEK_CUR:

                if ($offset >= 0) {
                    $this->position += $offset;
                    return true;
                }
                else
                    return false;

                break;

            case SEEK_END:

                if (strlen( $this->kvcontent ) + $offset >= 0) {
                    $this->position = strlen( $this->kvcontent ) + $offset;
                    return true;
                }
                else
                    return false;

                break;

            default:

                return false;
        }
    }

    public function stream_stat()
    {
        return $this->stat;
    }

    // ============================================
    public function mkdir($path , $mode , $options)
    {
        $path = rtrim(trim(substr(trim($path), 10)), '/');

        if ( $this->open( $path ) === false ) {
            $this->statinfo_init( false );
            return $this->save( $path );
        } else {
            trigger_error("mkdir({$path}): Key exists in KVDB.", E_USER_WARNING);
            return false;
        }
    }

    public function rename($path_from , $path_to)
    {
        $path_to = rtrim(trim(substr(trim($path_to), 8)), '/');
        if (strpos($path_from, 'mysaekv://') === 0) {
            sae_debug('Renaming inside kvdb.');
            $path_from = rtrim(trim(substr(trim($path_from), 8)), '/');
            sae_debug("Rename from $path_from to $path_to");

            if ( $this->open( $path_from ) === true ) {
                clearstatcache( true );
                return $this->save( $path_to );
            } else {
                sae_debug("rename({$path_from}, {$path_to}): No such key in KVDB.");
                trigger_error("rename({$path_from}, {$path_to}): No such key in KVDB.", E_USER_WARNING);
                return false;
            }
        } else {
            sae_debug('Renaming from outside to kvdb.');
            return false !== file_put_contents($path_to, file_get_contents($path_from));
        }
    }

    public function rmdir($path , $options)
    {
        $path = rtrim(trim(substr(trim($path), 10)), '/');

        clearstatcache( true );
        return $this->kv()->delete($path);
    }

    public function unlink($path)
    {
        $path = rtrim(trim(substr(trim($path), 10)), '/');

        clearstatcache( true );
        return $this->kv()->delete($path);
    }

    public function url_stat($path , $flags)
    {
        $path = rtrim(trim(substr(trim($path), 10)), '/');

        if ( $this->open( $path ) !== false ) {
            return $this->stat;
        } else {
            return false;
        }
    }






    // ============================================

    private function statinfo_init( $is_file = true )
    {
        $this->stat['dev'] = $this->stat[0] = 0x8003;
        $this->stat['ino'] = $this->stat[1] = crc32(SAE_APPNAME . '/' . $this->kvkey);

        if( $is_file )
            $this->stat['mode'] = $this->stat[2] = $this->file_mode;
        else
            $this->stat['mode'] = $this->stat[2] = $this->dir_mode;

        $this->stat['nlink'] = $this->stat[3] = 0;
        $this->stat['uid'] = $this->stat[4] = 0;
        $this->stat['gid'] = $this->stat[5] = 0;
        $this->stat['rdev'] = $this->stat[6] = 0;
        $this->stat['size'] = $this->stat[7] = 0;
        $this->stat['atime'] = $this->stat[8] = 0;
        $this->stat['mtime'] = $this->stat[9] = time();
        $this->stat['ctime'] = $this->stat[10] = 0;
        $this->stat['blksize'] = $this->stat[11] = 0;
        $this->stat['blocks'] = $this->stat[12] = 0;

    }

    public function dir_closedir() {
        return false;
    }

    public function dir_opendir($path, $options) {
        return false;
    }

    public function dir_readdir() {
        return false;
    }

    public function dir_rewinddir() {
        return false;
    }

    public function stream_cast($cast_as) {
        return false;
    }

    public function stream_flush() {
        return false;
    }

    public function stream_lock($operation) {
        return false;
    }

    public function stream_set_option($option, $arg1, $arg2) {
        return false;
    }

}