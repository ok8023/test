<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: core/message.proto

namespace Zaly\Proto\Core;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>core.DocumentMessage</code>
 */
class DocumentMessage extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string url = 1;</code>
     */
    private $url = '';
    /**
     *bytes
     *
     * Generated from protobuf field <code>int32 size = 2;</code>
     */
    private $size = 0;
    /**
     * Generated from protobuf field <code>string name = 3;</code>
     */
    private $name = '';

    public function __construct() {
        \GPBMetadata\Core\Message::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string url = 1;</code>
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Generated from protobuf field <code>string url = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setUrl($var)
    {
        GPBUtil::checkString($var, True);
        $this->url = $var;

        return $this;
    }

    /**
     *bytes
     *
     * Generated from protobuf field <code>int32 size = 2;</code>
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     *bytes
     *
     * Generated from protobuf field <code>int32 size = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setSize($var)
    {
        GPBUtil::checkInt32($var);
        $this->size = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string name = 3;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

}
