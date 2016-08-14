<?php

namespace PhpSpreadsheet\Tests\Worksheet\AutoFilter;

use PHPExcel\Worksheet\AutoFilter;

class AutofilterColumnTest extends \PHPUnit_Framework_TestCase
{
    private $testInitialColumn = 'H';

    private $testAutoFilterColumnObject;

    private $mockAutoFilterObject;

    public function setUp()
    {
        $this->mockAutoFilterObject = $this->getMockBuilder(AutoFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockAutoFilterObject->expects($this->any())
            ->method('testColumnInRange')
            ->will($this->returnValue(3));

        $this->testAutoFilterColumnObject = new AutoFilter\Column(
            $this->testInitialColumn,
            $this->mockAutoFilterObject
        );
    }

    public function testGetColumnIndex()
    {
        $result = $this->testAutoFilterColumnObject->getColumnIndex();
        $this->assertEquals($this->testInitialColumn, $result);
    }

    public function testSetColumnIndex()
    {
        $expectedResult = 'L';

        //    Setters return the instance to implement the fluent interface
        $result = $this->testAutoFilterColumnObject->setColumnIndex($expectedResult);
        $this->assertInstanceOf(AutoFilter\Column::class, $result);

        $result = $this->testAutoFilterColumnObject->getColumnIndex();
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetParent()
    {
        $result = $this->testAutoFilterColumnObject->getParent();
        $this->assertInstanceOf(AutoFilter::class, $result);
    }

    public function testSetParent()
    {
        //    Setters return the instance to implement the fluent interface
        $result = $this->testAutoFilterColumnObject->setParent($this->mockAutoFilterObject);
        $this->assertInstanceOf(AutoFilter\Column::class, $result);
    }

    public function testGetFilterType()
    {
        $result = $this->testAutoFilterColumnObject->getFilterType();
        $this->assertEquals(AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER, $result);
    }

    public function testSetFilterType()
    {
        $result = $this->testAutoFilterColumnObject->setFilterType(AutoFilter\Column::AUTOFILTER_FILTERTYPE_DYNAMICFILTER);
        $this->assertInstanceOf(AutoFilter\Column::class, $result);

        $result = $this->testAutoFilterColumnObject->getFilterType();
        $this->assertEquals(AutoFilter\Column::AUTOFILTER_FILTERTYPE_DYNAMICFILTER, $result);
    }

    /**
     * @expectedException \PHPExcel\Exception
     */
    public function testSetInvalidFilterTypeThrowsException()
    {
        $expectedResult = 'Unfiltered';

        $result = $this->testAutoFilterColumnObject->setFilterType($expectedResult);
    }

    public function testGetJoin()
    {
        $result = $this->testAutoFilterColumnObject->getJoin();
        $this->assertEquals(AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_OR, $result);
    }

    public function testSetJoin()
    {
        $result = $this->testAutoFilterColumnObject->setJoin(AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_AND);
        $this->assertInstanceOf(AutoFilter\Column::class, $result);

        $result = $this->testAutoFilterColumnObject->getJoin();
        $this->assertEquals(AutoFilter\Column::AUTOFILTER_COLUMN_JOIN_AND, $result);
    }

    /**
     * @expectedException \PHPExcel\Exception
     */
    public function testSetInvalidJoinThrowsException()
    {
        $expectedResult = 'Neither';

        $result = $this->testAutoFilterColumnObject->setJoin($expectedResult);
    }

    public function testSetAttributes()
    {
        $attributeSet = array(    'val' => 100,
                                'maxVal' => 200
                             );

        //    Setters return the instance to implement the fluent interface
        $result = $this->testAutoFilterColumnObject->setAttributes($attributeSet);
        $this->assertInstanceOf(AutoFilter\Column::class, $result);
    }

    public function testGetAttributes()
    {
        $attributeSet = array(    'val' => 100,
                                'maxVal' => 200
                             );

        $this->testAutoFilterColumnObject->setAttributes($attributeSet);

        $result = $this->testAutoFilterColumnObject->getAttributes();
        $this->assertTrue(is_array($result));
        $this->assertEquals(count($attributeSet), count($result));
    }

    public function testSetAttribute()
    {
        $attributeSet = array(    'val' => 100,
                                'maxVal' => 200
                             );

        foreach ($attributeSet as $attributeName => $attributeValue) {
            //    Setters return the instance to implement the fluent interface
            $result = $this->testAutoFilterColumnObject->setAttribute($attributeName, $attributeValue);
            $this->assertInstanceOf(AutoFilter\Column::class, $result);
        }
    }

    public function testGetAttribute()
    {
        $attributeSet = array(    'val' => 100,
                                'maxVal' => 200
                             );

        $this->testAutoFilterColumnObject->setAttributes($attributeSet);

        foreach ($attributeSet as $attributeName => $attributeValue) {
            $result = $this->testAutoFilterColumnObject->getAttribute($attributeName);
            $this->assertEquals($attributeValue, $result);
        }
        $result = $this->testAutoFilterColumnObject->getAttribute('nonExistentAttribute');
        $this->assertNull($result);
    }

    public function testClone()
    {
        $result = clone $this->testAutoFilterColumnObject;
        $this->assertInstanceOf(AutoFilter\Column::class, $result);
    }
}