<?php
class sfDecoratedDecoratorView extends sfPHPView
{
	public function decorate($content)
	{
		$backupDecoratorDir = $this->decoratorDirectory;
		$backupDecoratorTemplate = $this->decoratorTemplate;
		
		if(!$this->hasParameter('decorator_decorator_dir'))
		{
			$dir = sfConfig::get($var = 'app_decoratedDecorator_dir');
			if(!$dir)
			{
				throw new RuntimeException('You must define ' . $var . ' in order to use sfDecoratedDecoratorView (or give it a parameter)');
			}
			$this->setParameter('decorator_decorator_dir', $dir);
		}
		
		if(!$this->hasParameter('decorator_decorator_template'))
		{
			$template = sfConfig::get($var = 'app_decoratedDecorator_template');
			if(!$template)
			{
				throw new RuntimeException('You must define ' . $var . ' in order to use sfDecoratedDecoratorView (or give it a parameter)');
			}
			$this->setParameter('decorator_decorator_template', $template);
		}
		
		
		$this->decoratorDirectory = $this->getParameter('decorator_decorator_dir');
		$this->decoratorTemplate  = $this->getParameter('decorator_decorator_template');
			
		$decoration = parent::decorate($content);

		$this->decoratorDirectory = $backupDecoratorDir;
		$this->decoratorTemplate  = $backupDecoratorTemplate;

		return parent::decorate($decoration);

	}

}