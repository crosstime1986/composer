<?php
/**
 * Created by PhpStorm.
 * User: crosstime
 * Date: 2017/2/28
 * Time: 下午2:16
 */
namespace Quan\Common\Libraries;

use Phalcon\Di;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\DiInterface;
use Quan\System\Services;

class Curl implements InjectionAwareInterface
{
    protected $_denpendencyInjector;

    public static function get($url, $data, $timeout = 3)
    {
        $ch = curl_init(rtrim($url, '/'). '?'. http_build_query($data));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout ? : 3);
        $result = curl_exec($ch);

        if (curl_errno($ch) > 0) {
            $di = Services::getDefault();
            $di->get('log')->error(curl_error($ch), null, 'curl_error.log');
            $di->get('log')->error($url, null, 'curl_error.log');
        }

        return $result;
    }

    public static function getUrl($url, $timeout = 3)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout ? : 3);
        $result = curl_exec($ch);

        if (curl_errno($ch) > 0) {
            $di = Services::getDefault();
            $di->get('log')->error(curl_error($ch), null, 'curl_error.log');
            $di->get('log')->error($url, null, 'curl_error.log');
        }

        return $result;
    }

    public static function post($url, $data, $timeout = 3)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout ? : 3);
        $result = curl_exec($ch);

        if (curl_errno($ch) > 0) {
            $di = Services::getDefault();
            $di->get('log')->error(curl_error($ch), null, 'curl_error.log');
            $di->get('log')->error($url, null, 'curl_error.log');
        }

        return $result;
    }

    public function setDI(DiInterface $dependencyInjector)
    {
        $this->_denpendencyInjector = $dependencyInjector;
    }

    public function getDI()
    {
        return $this->_denpendencyInjector;
    }
}