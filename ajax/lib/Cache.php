<?

namespace travelsoft\adapters;
/**
 * Адаптер для кеширования
 *
 * @author dimabresky
 * @copyright (c) 2017, travelsoft
 */
class Cache {

    /**
     * @var \Bitrix\Main\Data\Cache
     */
    protected $_cache = null;

    /**
     * @var string
     */
    protected $_cacheId = null;
    protected $_cacheTime = null;
    protected $_cacheDir = null;

    public function __construct($cacheId, $cacheDir, $cacheTime = 3600) {

        $this->_cache = \Bitrix\Main\Data\Cache::createInstance();
        $this->_cacheId = $cacheId;
        $this->_cacheDir = $cacheDir;
        $this->_cacheTime = $cacheTime;
    }

    /**
     * Получение из кеша
     * @return array
     */
    public function get () {

        $result = array();

        if ($this->_cache->initCache(
            $this->_cacheTime, $this->_cacheId, $this->_cacheDir)) {

            $result = $this->_cache->getVars();

        }

        return $result;

    }

    /**
     * Кеширование информации
     * @param callable $callback
     * @return array
     */
    public function caching ($callback) {

        $result = '';

        if (is_callable($callback)) {

            if ($this->_cache->startDataCache()) {

                $result = $callback();

                if (!empty($result)) {
                    $this->_cache->endDataCache($result);
                } else {
                    $this->_cache->abortDataCache();
                }
            }

        }

        return $result;
    }
}