<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tpv extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$numero = time();
		$config = array(
		    'Environment' 		=> 'test', // Puedes indicar test o real
    		'MerchantID' 		=> '1234567890',
    		'AcquirerBIN'	 	=> '1234567890',
    		'TerminalID' 		=> '1',
    		'ClaveCifrado' 		=> '1234567890qwerty',
		    'TipoMoneda' 		=> '978',
		    'Exponente' 		=> '2',
		    'Cifrado' 			=> 'SHA1',
		    'Idioma' 			=> '1',
		    'Pago_soportado' 	=> 'SSL'
		);
		$this->load->helper('ceca');
		$TPV = new Ceca\Tpv\Tpv($config);
		# Indicamos los campos para el pedido
		$TPV->setFormHiddens(array(
		    'Num_operacion' 	=> $numero,
		    'Descripcion' 		=> 'Factura N'.$numero,
		    'Importe' 			=> '5,66',
		    'URL_OK' 			=> 'http://luiscordero29.com/url_ok/',
		    'URL_NOK' 			=> 'http://luiscordero29.com/url_nok/'
		));
		echo '<form action="'.$TPV->getPath().'" method="post">'.$TPV->getFormHiddens().'</form>';
		die('<script>document.forms[0].submit();</script>');
	}
}
