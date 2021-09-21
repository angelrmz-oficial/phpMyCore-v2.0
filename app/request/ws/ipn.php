<?php

class ipn
{
  public $myssql, $user, $post, $get;
  function __construct(){
    global $_POST, $get;
    $this->post=$_POST;
    $this->get=$get;
    $this->myssql=new myssql;
    $this->myssql->fetch("SELECT id FROM galaxycms_userscfg WHERE account_hash='{$get['hash']}' LIMIT 1");
    if($this->myssql->rows > 0):
      $this->user=new userData($this->myssql->fetch['id']);
    endif;
    $this->myssql->clean();
  }
  function notify(){
    $req = 'cmd=_notify-validate';
    foreach($this->post as $clave => $valor):
      $req .= "&$clave=". urlencode(stripslashes($valor));
    endforeach;

    //Enviar un POST de vuelta a Paypal para verificación
    $header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    $header .= "Host: www.".paypal_ws."\r\n";
    $header .= "Connection: Close\r\n";
    $errno ='';
    $errstr='';

    // $fp = fsockopen (paypal_ws, 80, $errno, $errstr, 30);
    $fp =fsockopen ('ssl://www.'. paypal_ws, 443, $errno, $errstr, 30);

    if(!$fp):
      if($this->post['payment_status'] == 'Completed'):
        file_put_contents("paypal.log4", "completed");
        $coins=$this->get['purchase'];
        $multiple=$coins/100;
        $credits=300*$multiple;
        $diamonds=10*$multiple;
        $item_name = $this->post['item_name']; //recarga de saldo
        $payment_date = $this->post['payment_date'];
        $txn_id = $this->post['txn_id']; // transacción ID
        $payment_amount = $this->post['mc_gross']; // 10.00
        // $comision=($payment_amount*5.4)/100;
        // $comision += 0.9;
        // $recibe=$payment_amount-$comision;
        // $recibe=round($recibe,2);
        $payment_currency = $this->post['mc_currency'];
        $payer_email=$this->post['payer_email'];
        // using $this->post['invoice'],$this->post['txn_id'],$this->post['payer_id'], ['auth_id'] ['mc_gross'] ['payment_status']
        $this->myssql->table="paypal_transactions";
        $this->myssql->params['transactionId']=$txn_id;
        $this->myssql->params['date_purchase']=$payment_date;
        $this->myssql->params['date_confirm']=date("d-m-Y H:i:s");
        $this->myssql->params['amount']=$payment_amount;
        $this->myssql->params['currency']=$payment_currency;
        $this->myssql->params['paypal_payer']=$payer_email;
        $this->myssql->params['description']="{$this->user->data['username']} compro {$coins} fichas";
        $this->myssql->params['user_id']=$this->user->data['id'];
        $this->myssql->FilterParams();
        $this->myssql->insert();
        $this->myssql->clean();
        $this->myssql->table="centralbank";
        $this->myssql->params['credits']="credits-{$credits}";
        $this->myssql->params['diamonds']="diamonds-{$diamonds}";
        $this->myssql->where['bank_name']="centralbank";
        $this->myssql->FilterParams();
        $this->myssql->update(true);
        $this->myssql->clean();
        $this->myssql->table="centralbank_logs";
        $this->myssql->params['userid']=$this->user->data['id'];
        $this->myssql->params['description']="{$this->user->data['username']} obtuvo un bono de {$credits} creditos y {$diamonds} diamantes";
        $this->myssql->params['date']=date("d/M/Y H:i");
        $this->myssql->params['credits']=$credits;
        $this->myssql->params['diamonds']=$diamonds;
        $this->myssql->FilterParams();
        $this->myssql->insert();
        $this->myssql->clean();
        $this->myssql->table="centralbank_u"; // REDUCIR DEL BANCO???
        $this->myssql->params['credits']="credits+{$credits}";
        $this->myssql->params['diamonds']="diamonds+{$diamonds}";
        $this->myssql->params['coins']="coins+{$coins}";
        $this->myssql->where['uid']=$this->user->bankData['uid'];
        $this->myssql->FilterParams();
        $this->myssql->update(true);
        $this->myssql->clean();
        $this->myssql->table="centralbank_ulogs";
        $this->myssql->params['centralbank_uid']=$this->user->bankData['uid'];
        $this->myssql->params['credits']=$credits;
        $this->myssql->params['diamonds']=$diamonds;
        $this->myssql->params['coins']=$coins;
        $this->myssql->params['logdate']=date("d/M/Y H:i");
        $this->myssql->params['type']="+";
        $this->myssql->params['description']="Compra realizada ({$payment_amount} {$payment_currency})";
        $this->myssql->FilterParams();
        $this->myssql->insert();
        //mandar email
      elseif ($this->post['payment_status'] == 'Failed' || $this->post['payment_status'] == 'Expired' || $this->post['payment_status'] == 'Voided'):
        // El pago no se ha realizado, eliminar la suscripción
      endif;
      // file_put_contents("paypal.log4", error_get_last());
    else:
      fputs ($fp, $header . $req);
      while (!feof($fp)):
        $res = fgets ($fp, 1024);
        if (strcmp (trim($res), "VERIFIED") == 0):
          if($this->post['payment_status'] == 'Completed'):
            file_put_contents("paypal.log4", "completed");
            $coins=$this->get['purchase'];
            $multiple=$coins/100;
            $credits=300*$multiple;
            $diamonds=10*$multiple;
            $item_name = $this->post['item_name']; //recarga de saldo
            $payment_date = $this->post['payment_date'];
            $txn_id = $this->post['txn_id']; // transacción ID
            $payment_amount = $this->post['mc_gross']; // 10.00
            // $comision=($payment_amount*5.4)/100;
            // $comision += 0.9;
            // $recibe=$payment_amount-$comision;
            // $recibe=round($recibe,2);
            $payment_currency = $this->post['mc_currency'];
            $payer_email=$this->post['payer_email'];
            // using $this->post['invoice'],$this->post['txn_id'],$this->post['payer_id'], ['auth_id'] ['mc_gross'] ['payment_status']
            $this->myssql->table="paypal_transactions";
            $this->myssql->params['transactionId']=$txn_id;
            $this->myssql->params['date_purchase']=$payment_date;
            $this->myssql->params['date_confirm']=date("d-m-Y H:i:s");
            $this->myssql->params['amount']=$payment_amount;
            $this->myssql->params['currency']=$payment_currency;
            $this->myssql->params['paypal_payer']=$payer_email;
            $this->myssql->params['description']="{$this->user->data['username']} compro {$coins} fichas";
            $this->myssql->params['user_id']=$this->user->data['id'];
            $this->myssql->FilterParams();
            $this->myssql->insert();
            $this->myssql->clean();
            $this->myssql->table="centralbank";
            $this->myssql->params['credits']="credits-{$credits}";
            $this->myssql->params['diamonds']="diamonds-{$diamonds}";
            $this->myssql->where['bank_name']="centralbank";
            $this->myssql->FilterParams();
            $this->myssql->update(true);
            $this->myssql->clean();
            $this->myssql->table="centralbank_logs";
            $this->myssql->params['userid']=$this->user->data['id'];
            $this->myssql->params['description']="{$this->user->data['username']} obtuvo un bono de {$credits} creditos y {$diamonds} diamantes";
            $this->myssql->params['date']=date("d/M/Y H:i");
            $this->myssql->params['credits']=$credits;
            $this->myssql->params['diamonds']=$diamonds;
            $this->myssql->FilterParams();
            $this->myssql->insert();
            $this->myssql->clean();
            $this->myssql->table="centralbank_u";
            $this->myssql->params['credits']="credits+{$credits}";
            $this->myssql->params['diamonds']="diamonds+{$diamonds}";
            $this->myssql->params['coins']="coins+{$coins}";
            $this->myssql->where['uid']=$this->user->bankData['uid'];
            $this->myssql->FilterParams();
            $this->myssql->update(true);
            $this->myssql->clean();
            $this->myssql->table="centralbank_ulogs";
            $this->myssql->params['centralbnk_uid']=$this->user->bankData['uid'];
            $this->myssql->params['credits']=$credits;
            $this->myssql->params['diamonds']=$diamonds;
            $this->myssql->params['coins']=$coins;
            $this->myssql->params['logdate']=date("d/M/Y H:i");
            $this->myssql->params['type']="+";
            $this->myssql->params['description']="Compra realizada ({$payment_amount} {$payment_currency})";
            $this->myssql->FilterParams();
            $this->myssql->insert();
            //mandar email
          elseif ($this->post['payment_status'] == 'Failed' || $this->post['payment_status'] == 'Expired' || $this->post['payment_status'] == 'Voided'):
            // El pago no se ha realizado, eliminar la suscripción
          endif;
        elseif (strcmp (trim($res), "INVALID") == 0):
          // INVALID - EMAIL FOR INVESTIGATION
        endif;
     endwhile;
     fclose ($fp);
   endif;
  }
}

?>
