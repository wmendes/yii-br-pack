<?php
namespace BrPack\Field;

class Phone extends \CMaskedTextField {

	/**
	 * One of "landline", "mobile", "both" or "area". Defaults to 'both'.
	 * @var string
	 */
	public $type = 'both';

	/**
	 * If it should show a placeholder. Defaults to true.
	 * @var
	 */
	public $showPlaceholder = true;

	public function run() {
		if (!$this->type)
			throw new \CException(\Yii::t('yii', 'Property PhoneField.type cannot be empty.'));

		switch ($this->type) {
			case 'area':
				$this->mask        = '99';
				$this->placeholder = ' ';
			break;

			case 'landline':
				$this->mask        = '(99) 9999-9999';
				$this->placeholder = '_';
			break;

			case 'both':
			case 'mobile':
				$this->mask        = '(99) 9999-9999?9';
				$this->placeholder = '_';
			break;

			default:
				throw new \CException(\Yii::t('yii',
					'Property PhoneField.type should be one of "landline", "mobile", "both" or "area".'));
		}

		if ($this->showPlaceholder)
			$this->htmlOptions['placeholder'] = str_replace([9,'?'], [$this->placeholder, ''], $this->mask);

		parent::run();
	}

}
