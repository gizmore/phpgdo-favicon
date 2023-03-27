<?php
namespace GDO\Favicon\Method;

use GDO\Core\GDT;
use GDO\Core\GDT_Select;
use GDO\Core\Method;
use GDO\Favicon\Module_Favicon;
use GDO\File\Method\GetFile;

/**
 * Render a favicon image.
 *
 * @author gizmore
 */
final class Image extends Method
{

	public function getMethodTitle(): string
	{
		return 'Favicon';
	}

	public function gdoParameters(): array
	{
		$choices = ['favicon', 'appletouch'];
		$choices = array_combine($choices, $choices);
		return [
			GDT_Select::make('variant')->choices($choices),
		];
	}

	public function execute(): GDT
	{
		$image = Module_Favicon::instance()->cfgFavicon();
		$variant = $this->gdoParameterVar('variant');
		return GetFile::make()->executeWithId($image->getID(), $variant, true);
	}

}
