<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;


/**
 * Reads and writes newsletter channels
 *
 * @property integer $id
 * @property integer $tstamp
 * @property string  $title
 * @property integer $jumpTo
 * @property boolean $useSMTP
 * @property string  $smtpHost
 * @property string  $smtpUser
 * @property string  $smtpPass
 * @property string  $smtpEnc
 * @property integer $smtpPort
 *
 * @method static $this findById()
 * @method static $this findOneByTstamp()
 * @method static $this findOneByTitle()
 * @method static $this findOneByJumpTo()
 * @method static $this findOneByUseSMTP()
 * @method static $this findOneBySmtpHost()
 * @method static $this findOneBySmtpUser()
 * @method static $this findOneBySmtpPass()
 * @method static $this findOneBySmtpEnc()
 * @method static $this findOneBySmtpPort()
 * @method static \NewsletterChannelModel[]|\Model\Collection findByTstamp()
 * @method static \NewsletterChannelModel[]|\Model\Collection findByTitle()
 * @method static \NewsletterChannelModel[]|\Model\Collection findByJumpTo()
 * @method static \NewsletterChannelModel[]|\Model\Collection findByUseSMTP()
 * @method static \NewsletterChannelModel[]|\Model\Collection findBySmtpHost()
 * @method static \NewsletterChannelModel[]|\Model\Collection findBySmtpUser()
 * @method static \NewsletterChannelModel[]|\Model\Collection findBySmtpPass()
 * @method static \NewsletterChannelModel[]|\Model\Collection findBySmtpEnc()
 * @method static \NewsletterChannelModel[]|\Model\Collection findBySmtpPort()
 * @method static integer countById()
 * @method static integer countByTstamp()
 * @method static integer countByTitle()
 * @method static integer countByJumpTo()
 * @method static integer countByUseSMTP()
 * @method static integer countBySmtpHost()
 * @method static integer countBySmtpUser()
 * @method static integer countBySmtpPass()
 * @method static integer countBySmtpEnc()
 * @method static integer countBySmtpPort()
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class NewsletterChannelModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_newsletter_channel';


	/**
	 * Find multiple newsletter channels by their IDs
	 *
	 * @param array $arrIds     An array of newsletter channel IDs
	 * @param array $arrOptions An optional options array
	 *
	 * @return static[]|\Model\Collection|null A collection of models or null if there are no newsletter channels
	 */
	public static function findByIds($arrIds, array $arrOptions=array())
	{
		if (!is_array($arrIds) || empty($arrIds))
		{
			return null;
		}

		$t = static::$strTable;

		if (!isset($arrOptions['order']))
		{
			$arrOptions['order'] = "$t.title";
		}

		return static::findBy(array("$t.id IN(" . implode(',', array_map('intval', $arrIds)) . ")"), null, $arrOptions);
	}
}
