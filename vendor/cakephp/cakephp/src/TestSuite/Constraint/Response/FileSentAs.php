<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @since         3.7.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\TestSuite\Constraint\Response;

/**
 * FileSentAs
 *
 * @internal
 */
class FileSentAs extends ResponseBase
{
    /**
     * Checks assertion
     *
     * @param mixed $other Expected type
     * @return bool
     */
    public function matches($other)
    {
        return $this->response->getFile()->path === $other;
    }

    /**
     * Assertion message
     *
     * @return string
     */
    public function toString()
    {
        return 'file was sent';
    }
}
