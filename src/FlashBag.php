<?php
/**
 * This file is part of Berlioz framework.
 *
 * @license   https://opensource.org/licenses/MIT MIT License
 * @copyright 2017 Ronan GIRON
 * @author    Ronan GIRON <https://github.com/ElGigi>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code, to the root.
 */

namespace Berlioz\FlashBag;

use \Countable;

/**
 * FlashBag class manage flash messages to showed to the user.
 *
 * When a message is retrieved from stack, he is deleted from stack and can't be reused.
 *
 * @package Berlioz\FlashBag
 * @see     \Countable
 */
class FlashBag implements Countable
{
    const TYPE_INFO = 'info';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';
    const SESSION_KEY = '_BERLIOZ_FLASH_BAG';
    /** @var array[string[]] List of messages */
    private $messages;

    /**
     * FlashBag constructor.
     *
     * Only one instance of FlashBag can be instanced.
     * An fatal error occur if an new FlashBag class is instanced.
     */
    public function __construct()
    {
        if (session_status() == PHP_SESSION_DISABLED) {
            trigger_error('To use FlashBag class, you must be active sessions', E_USER_ERROR);
        } else {
            // Start session if doesn't exists
            if (session_status() == PHP_SESSION_NONE && !headers_sent()) {
                session_start();
            }

            if (isset($_SESSION[self::SESSION_KEY]) && is_array($_SESSION[self::SESSION_KEY])) {
                $this->messages = $_SESSION[self::SESSION_KEY];
            } else {
                $this->messages = [];
            }
        }
    }

    /**
     * Get the number of messages in flash bag.
     *
     * @return int
     */
    public function count()
    {
        return count($this->messages, COUNT_RECURSIVE) - count($this->messages);
    }

    /**
     * Get all messages, all mixed types.
     *
     * @return string[] List of messages
     */
    public function all()
    {
        $messages = $this->messages;

        // Clear messages
        $this->clear();

        return $messages;
    }

    /**
     * Get all messages for given type and clear flash bag of them.
     *
     * @param string $type Type of message
     *
     * @return string[] List of messages
     */
    public function get($type)
    {
        if (isset($this->messages[$type])) {
            $messages = $this->messages[$type];

            // Clear messages
            $this->clear($type);

            return $messages;
        } else {
            return [];
        }
    }

    /**
     * Add new message in flash bag.
     *
     * @param string $type    Type of message
     * @param string $message Message
     *
     * @return static
     */
    public function add($type, $message): FlashBag
    {
        if (is_string($type) && is_string($message)) {
            $this->messages[$type][] = $message;

            // Save into session
            $this->saveToSession();
        } else {
            trigger_error('FlashBag::add() accept only string parameters', E_USER_ERROR);
        }

        return $this;
    }

    /**
     * Clear messages in flash bag.
     *
     * @param string $type Type of message
     *
     * @return static
     */
    public function clear($type = null): FlashBag
    {
        if (is_null($type)) {
            $this->messages = [];
        } else {
            if (isset($this->messages[$type])) {
                unset($this->messages[$type]);
            }
        }

        // Save into session
        $this->saveToSession();

        return $this;
    }

    /**
     * Save flash bag in PHP session.
     */
    protected function saveToSession()
    {
        // Save into sessions
        $_SESSION[self::SESSION_KEY] = $this->messages;
    }
}
