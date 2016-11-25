<?php

/**
 * This file is part of contao-community-alliance/dependency-container.
 *
 * (c) 2013 Contao Community Alliance
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    contao-community-alliance/dependency-container
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @copyright  2013-2015 Contao Community Alliance
 * @license    https://github.com/contao-community-alliance/dependency-container/blob/master/LICENSE LGPL-3.0+
 * @link       http://c-c-a.org
 * @filesource
 */

namespace DependencyInjection\Container\Test;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use DependencyInjection\Container\LegacyDependencyInjectionContainer;

/**
 * Test the class LegacyDependencyInjectionContainer.
 */
class LegacyDependencyInjectionContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the service is retrieved from the legacy container.
     *
     * @return void
     */
    public function testGetService()
    {
        if (!interface_exists('Contao\CoreBundle\Framework\ContaoFrameworkInterface')) {
            $this->markTestSkipped('Only available in Contao 4');
        }

        $framework = $this->getMock(ContaoFrameworkInterface::class);
        $framework->expects($this->once())->method('initialize');

        $legacyContainer = new LegacyDependencyInjectionContainer($framework);

        $GLOBALS['container'] = ['test-service' => 'test'];

        $this->assertSame('test', $legacyContainer->getService('test-service'));
    }
}
