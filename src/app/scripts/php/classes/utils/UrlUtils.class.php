<?php

    class UrlUtils {

        public static function addParameter($url, $name, $value = '') {
            $pair = ($value != '') ? $name . '=' . $value : $name;
        
            $queryIndex = strpos($url, '?');
            if ($queryIndex == '') {
                $url .= '?' . $pair;
            } else {
                if (strpos($url, $name, $queryIndex) == '') {
                    $url .= '&' . $pair;
                } else {
                    $query = substr($url, $queryIndex + 1);
                    $query = explode('&', $query);
                    $url = substr($url, 0, $queryIndex);
                    $isFirst = true;
                    foreach ($query as $item) {
                        $keyvalue = explode('=', $item);
                        if ($keyvalue[0] == $name) {
                            $item = $pair;
                        }
        
                        if ($isFirst) {
                            $url .= '?' . $item;
                            $isFirst = false;
                        } else {
                            $url .= '&' . $item;
                        }
                    }
                }
            }

            return $url;
        }

        public static function removeParameter($url, $name) {
            $queryIndex = strpos($url, '?');
            if ($queryIndex == '') {
                return $url;
            }

            if (strpos($url, $name, $queryIndex) == '') {
                return $url;
            }

            $query = substr($url, $queryIndex + 1);
            $query = explode('&', $query);
            $url = substr($url, 0, $queryIndex);
            $isFirst = true;
            foreach ($query as $item) {
                $keyvalue = explode('=', $item);
                if ($keyvalue[0] != $name) {
                    if ($isFirst) {
                        $url .= '?' . $item;
                        $isFirst = false;
                    } else {
                        $url .= '&' . $item;
                    }
                }
            }

            return $url;
        }
        
        public static function addCurrentQueryString($url) {
            foreach ($_GET as $key => $value) {
                if ($key != 'WEB_PAGE_PATH') {
                    $url = UrlUtils::addParameter($url, $key, $value);
                }
            }

            return $url;
        }

        public static function removeQueryString($url) {
            $queryIndex = strpos($url, '?');
            return substr($url, 0, $queryIndex);
        }
        
    }

?>