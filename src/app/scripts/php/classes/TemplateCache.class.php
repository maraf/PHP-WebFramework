<?php

    class TemplateCache {

        private function getPath(array $keys) {
            $subPath = implode("/", $keys);
            $path = CACHE_TEMPLATES_PATH . $subPath . ".php";
            return $path;
        }

        private function ensurePath(string $filePath) {
            $directoryPath = dirname($filePath);
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
        }

        public function exists(array $keys) {
            $path = $this->getPath($keys);
            return file_exists($path);
        }
        
        public function delete(array $keys) {
            $path = $this->getPath($keys);
            unlink($path);
        }
        
        public function set(array $keys, string $content) {
            $path = $this->getPath($keys);
            $this->ensurePath($path);
            $content = "<?php" . PHP_EOL . PHP_EOL . $content . PHP_EOL . PHP_EOL . "?>";
            file_put_contents($path, $content);
        }
        
        public function load(array $keys) {
            $path = $this->getPath($keys);
            if (file_exists($path)) {
                require_once($path);
            }
        }
    }

?>