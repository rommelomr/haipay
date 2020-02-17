<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HaiCriptomoneda;
use App\Moneda;
use App\Transaccion;
use App\ComprasCriptomoneda;

class CriptomonedasController extends Controller
{
/*
	public function acquireCripto(Request $req){
		dd($req->all());
		$error= $this->validate($req,[
			'payWith' =>	'required|in:USD,EUR,GBP,INR,AUD,CAD,SGD,AED,AFN,ALL,AMD,ANG,AOA,ARS,AUD,AWG,AZN,BAM,BBD,BDT,BGN,BHD,BIF,BMD,BND,BOB,BRL,BSD,BTN,BWP,BYN,BZD,CAD,CDF,CHF,CLP,CNY,COP,CRC,CUC,CUP,CVE,CZK,DJF,DKK,DOP,DZD,EGP,ERN,ETB,EUR,FJD,GGP,GHS,GIP,GMD,GNF,GTQ,GYD,HKD,HNL,HRK,HTG,HUF,IDR,ILS,IMP,INR,IQD,IRR,ISK,JEP,JMD,JOD,JPY,KES,KGS,KHR,KMF,KPW,KRW,KWD,KYD,KZT,LAK,LBP,LKR,LRD,LSL,LYD,MAD,MDL,MGA,MKD,MMK,MNT,MOP,MRU,MUR,MVR,MWK,MXN,MYR,MZN,NAD,NGN,NIO,NOK,NPR,NZD,OMR,PAB,PEN,PGK,PHP,PKR,PLN,PYG,QAR,RON,RSD,RUB,RWF,SAR,SBD,SCR,SDG,SEK,SGD,SHP,SLL,SOS,SPL,SRD,STN,SVC,SYP,SZL,THB,TJS,TMT,TND,TOP,TRY,TTD,TVD,TWD,TZS,UAH,UGX,USD,UYU,UZS,VEF,VES,VND,VUV,WST,XAF,XAG,XAU,XBT,XCD,XDR,XOF,XPD,XPF,XPT,YER,ZAR,ZMW,ZWD',
			'cantBuy' =>	'required|numeric',
			'type_operation' =>	'required|in:Deposit,Change',
			'base' =>	'required|in:XRP,BTC,ETH,LTC,BCH,TRX,NANO,DASH,XLM,DAI,USDS,TUSD,BSV,ZEC,EOS,ETC,DOGE,BAT,SRN,TEL,BTT,REP,GNT,DGD,WINGS,RLC,DCR,ANT,BNT,CVC,PAY,OMG,MCO,ZRX,QTUM,STORJ,FUN,SALT,BTG,DGB,DNT,POWR,PPT,BRD,NOAH,BNB,POLY,KNC,MITH,LINK'
		]);
		$base=$req->base;
		$currency=$req->payWith;
		$tipo='buy';
		$datos = json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$base.'-'.$currency.'/'.$tipo), true );

		Transaccion::create([
    		'id_metodo_pago' => 1,
			'id_tipo_transaccion' => 1,
			'id_cliente' => Auth::user()->id,
    	]);

		return redirect()->back();
	}
*/
	public function acquireCripto(Request $req){
		$error= $this->validate($req,[
			'payWith' =>	'required|exists:monedas,siglas',
			'base' =>	'required|exists:hai_criptomonedas,id',
			'cuant_buy' =>	'required|numeric',
			'type_operation' =>	'required|exists:metodos_pago,id',
		]);

		//Si la moneda que se quiere comprar es el Doge (id 5)
		if($req->base == 5){
			dd('otro procedimiento para el doge');
		}else{

			$base=HaiCriptomoneda::with('moneda')->find($req->base);
			$currency=$req->payWith;
			$tipo='buy';
			$crip_to_buy = json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$base->moneda->siglas.'-USD'.'/'.$tipo), true );
			$crip_to_pay = json_decode( file_get_contents('https://api.coinbase.com/v2/prices/'.$req->payWith.'-USD'.'/'.$tipo), true );
			//dd($req->cuant_buy * $crip_to_buy['data']['amount'] * (1 / $crip_to_pay['data']['amount']));
			$transaccion = Transaccion::create([
	    		'id_cliente' => \Auth::user()->cliente->id,
	    		'id_tipo_transaccion'=>1
	    	]);



	    	$compra = ComprasCriptomoneda::create([
				'id_hai_criptomoneda' => $req->base,
				'id_moneda' => Moneda::where('siglas',$req->payWith)->first()->id,
				'monto' => $req->cuant_buy,
				'precio' => $crip_to_buy['data']['amount'],
				'id_metodo_pago' => $req->type_operation,
				'id_transaccion' => $transaccion->id
	    	]);
		}


		return redirect()->back();
	}	
}
