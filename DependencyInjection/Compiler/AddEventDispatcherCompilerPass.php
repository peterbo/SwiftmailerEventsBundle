<?php

namespace TDM\SwiftMailerEventBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of AddEventDispatcherCompilerPass
 *
 * @author wpigott
 */
class AddEventDispatcherCompilerPass implements CompilerPassInterface
{

	public function process(ContainerBuilder $container)
	{
		//add the event dispatcher onto the classes
		$def = $container->getDefinition('swiftmailer.mailer.default');
		$def->addMethodCall('setEventDispatcher', array(new Reference('event_dispatcher')));
		unset($def);

		if ($container->hasDefinition('swiftmailer.mailer.default.transport.smtp')) {
			$def = $container->getDefinition('swiftmailer.mailer.default.transport.smtp');
			$def->addMethodCall('setEventDispatcher', array(new Reference('event_dispatcher')));
			unset($def);
		}
	}

}

?>
