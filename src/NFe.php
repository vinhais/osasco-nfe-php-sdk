<?php

namespace Vinhais\OsascoNfePhpSdk;

use Vinhais\OsascoNfePhpSdk\Exceptions\InvalidSettingsException;
use Vinhais\OsascoNfePhpSdk\XML;
use RuntimeException;

class NFe
{
	/**
	 * URL base do webservice fodido
	 *
	 * @var string BASE_URL
	 */
	protected const BASE_URL = 'https://nfe.osasco.sp.gov.br/EISSNFEWebServices/NotaFiscalEletronica.svc?wsdl';

	/**
	 * Construtor da classe "NFe"
	 *
	 * @param array $settings
	 * @return void
	 */
	public function __construct(
		protected array $settings,
	) {
		$this->validateSettings();
	}

	/**
	 * Valida as configurações
	 *
	 * @return null
	 * @throw \Vinhais\OsascoNfePhpSdk\Exceptions\InvalidSettingsException
	 */
	protected function validateSettings()
	{
		if (! extension_loaded('soap')) {
			throw new RuntimeException('SOAP não ativado.');
		}

		if (
			(! isset($this->settings['env'])) ||
			$this->settings['env'] !== 'testing' && 
			$this->settings['env'] !== 'prod'
		) {
			throw new InvalidSettingsException('Ambiente não definido corretamente. ("testing" ou "prod")');
		}

		if (! isset($this->settings['key'])) {
			throw new InvalidSettingsException('Chave não definida.');
		}
	}
}