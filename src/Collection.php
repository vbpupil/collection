<?php
/**
 * Collection.php Class
 *
 * @author    Dean Haines
 * @copyright: Dean Haines, 2018, UK
 * @license: GPL V3.0+ See LICENSE.md
 */

namespace Vbpupil\Collection;

use Vbpupil\Collection\Exception\CollectionException;
use Vbpupil\Collection\Exception\KeyInUseException;

/**
 * Class Collection
 * @package Vbpupil\Collection
 */
class Collection
{
    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param $obj
     * @param null $key
     * @return Collection
     * @throws KeyInUseException
     */
    public function addItem($obj, $key = null)
    {
        if (is_null($key)) {
            $this->items[] = $obj;
        } else {
            if (isset($this->items[$key])) {
                throw new KeyInUseException("Key {$key} already in use.");
            } else {
                $this->items[$key] = $obj;
            }
        }

        return $this;
    }

    /**
     * @param null $key
     * @throws CollectionException
     */
    public function deleteItem($key = null)
    {
        if ($this->keyExists($key)) {
            unset($this->items[$key]);
        } else {
            throw new CollectionException("Key {$key} does not exist to delete.");
        }
    }

    /**
     * @param null $key
     * @return mixed
     * @throws CollectionException
     */
    public function getItem($key = null)
    {
        if ($this->keyExists($key)) {
            return $this->items[$key];
        } else {
            throw new CollectionException("Key {$key} does not exist to get.");
        }
    }

    /**
     * @param null $key
     * @return bool
     * @throws CollectionException
     */
    public function keyExists($key = null)
    {
        if (is_null($key)) {
            throw new CollectionException('A key required to perform check.');
        }

        return (bool)isset($this->items[$key]);
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return count($this->items);
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->items);
    }
    
    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
}