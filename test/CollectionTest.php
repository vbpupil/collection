<?php
/**
 * CollectionTest.php Class
 *
 * @author    Dean Haines
 * @copyright: Dean Haines, 03/02/19, UK
 * @license: GPL V3.0+ See LICENSE.md
 */

namespace Test\Vbpupil\Collection;


use PHPUnit\Framework\TestCase;
use Vbpupil\Collection\Collection;
use Vbpupil\Collection\Exception\CollectionException;
use Vbpupil\Collection\Exception\KeyInUseException;

class CollectionTest extends TestCase
{
    protected $sut;

    public function setUp()
    {
        $this->sut = new Collection();
    }

    public function testAddItem()
    {
        $this->sut->addItem('test');
        $this->assertEquals('test', $this->sut->getItem(0));


        try {
            $this->sut->addItem('test2', 'test2');
            $this->sut->addItem('test2', 'test2');
        }catch (KeyInUseException $e){
            $this->assertEquals('Key test2 already in use.', $e->getMessage());
        }

        $this->assertEquals('test2', $this->sut->getItem('test2'));
    }

    public function testDeleteItem()
    {
        $this->sut->addItem('test3', 'test3');
        $this->assertEquals('test3', $this->sut->getItem('test3'));

        try {
            $this->sut->deleteItem('test3');
            $this->sut->deleteItem('test3');
        }catch (CollectionException $e){
            $this->assertEquals('Key test3 does not exist to delete.', $e->getMessage());
        }
    }

    public function testGetItem()
    {
        try {
            $this->assertEquals('test3', $this->sut->getItem('test3'));
        }catch (CollectionException $e){
            $this->assertEquals('Key test3 does not exist to get.', $e->getMessage());
        }
    }
    public function testKeyExists()
    {
        try {
            $this->sut->keyExists();
        }catch (CollectionException $e){
            $this->assertEquals('A key required to perform check.', $e->getMessage());
        }
    }

    public function testGetLengthOfCollection()
    {
        $this->sut->addItem('test4', 'test4');
        $this->assertEquals(1, $this->sut->getLength());
        $this->sut->addItem('test5', 'test5');
        $this->sut->addItem('test6', 'test6');
        $this->assertEquals(3, $this->sut->getLength());
        $this->sut->deleteItem('test6');
        $this->assertEquals(2, $this->sut->getLength());
    }

    public function testGetCollectionKeys()
    {
        $this->sut->addItem('test4', 'test4');
        $this->sut->addItem('test5', 'test5');
        $this->sut->addItem('test6', 'test6');

        $this->assertEquals( array('test4','test5','test6'), $this->sut->getKeys());
    }

    public function testGetItems()
    {
        $this->sut->addItem('test4', 'test4');

        $this->assertEquals( array('test4'=> 'test4'), $this->sut->getItems());
    }
    
}